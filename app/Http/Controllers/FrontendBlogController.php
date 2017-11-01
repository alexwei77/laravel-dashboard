<?php
namespace App\Http\Controllers;

use App\Blog;
use App\BlogCategory;
use App\BlogComment;
use App\Http\Requests;
use App\Http\Requests\BlogCommentRequest;
use App\Http\Requests\BlogRequest;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Response;
use Sentinel;
use Illuminate\Support\Facades\DB;
use Session;
use App\MyLibrary\GetIpLocale;
use App;
use Redirect;

class FrontendBlogController extends JoshController
{


    private $tags;

    public function __construct()
    {
        parent::__construct();
        $this->tags = Blog::allTags();
    }

    /**
     * @return \Illuminate\View\View
     */
    public function index($lang = null)
    {
        $ip_locale = $this->GetIpLocale();

        if ($lang) {
            session(['custom_lang' => $lang]);
            //set the locale
            App::setLocale($lang);
        } else {
            session(['custom_lang' => '']);
        }

        if (!Session::has('nav_section')) {
            Session::put('nav_section', 'business');
        }

        // Grab all the blogs
        $blogs = Blog::latest()->simplePaginate(5);
        $blogs->setPath('news');
        $tags = $this->tags;
        $popularBlogs = DB::table('blogs')->where('views', '>', 0)->orderBy('views', 'desc')->limit(2)->get();
        $recentComments = DB::table('blog_comments')->orderBy('id', 'desc')->limit(3)->get();
        // Show the page
        return view('blog', compact('blogs', 'tags','popularBlogs', 'recentComments'));
    }

    /**
     * @param string $slug
     * @return \Illuminate\View\View
     */
    public function getBlog($lang = null, $slug = '')
    {
         $ip_locale = $this->GetIpLocale();

        if ($lang) {
            session(['custom_lang' => $lang]);
            //set the locale
            App::setLocale($lang);
        } else {
            session(['custom_lang' => '']);
        }

        if (!Session::has('nav_section')) {
            Session::put('nav_section', 'business');
        }

        if ($slug == '') {
            $blog = Blog::first();
        }
        try {
            $blog = Blog::where('slug', $slug)->first() ?: Blog::findOrFail((int)$slug); //Post::findOrFail((int)$slug);
            $blog->increment('views');
        } catch (ModelNotFoundException $e) {
            return Response::view('404', array(), 404);
        }
        $popularBlogs = DB::table('blogs')->where('views', '>', 0)->orderBy('views', 'desc')->limit(2)->get();
        // Show the page
        return view('blogitem', compact('blog', 'popularBlogs', 'slug'));

    }

    /**
     * @param $tag
     * @return \Illuminate\View\View
     */
    public function getBlogTag($tag)
    {
        $blogs = Blog::withAnyTags($tag)->simplePaginate(5);
        $blogs->setPath('blog/' . $tag . '/tag');
        $tags = $this->tags;
        $popularBlogs = DB::table('blogs')->where('views', '>', 0)->orderBy('views', 'desc')->limit(2)->get();
        $recentComments = DB::table('blog_comments')->orderBy('id', 'desc')->limit(3)->get();
        return view('blog', compact('blogs', 'tags', 'popularBlogs', 'recentComments'));
    }

    /**
     * @param BlogCommentRequest $request
     * @param Blog $blog
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function storeComment(BlogCommentRequest $request, Blog $blog)
    {
        $blogcooment = new BlogComment($request->all());
        $blogcooment->blog_id = $blog->id;
        $blogcooment->save();

        return redirect('blogitem/' . $blog->slug);
    }

    public function GetIpLocale()
    {

        $ip2location = new GetIpLocale();

        $returned_locale = $ip2location->get_locale();

        return $returned_locale;

    }

}
