<?php

namespace App\Http\Controllers;

use Activation;
use App\Http\Requests;
use App\Http\Requests\UserRequest;
use App\User;
use Cartalyst\Sentinel\Checkpoints\NotActivatedException;
use Cartalyst\Sentinel\Checkpoints\ThrottlingException;
use File;
use Hash;
use Illuminate\Http\Request;
use Lang;
use Mail;
use Redirect;
use Reminder;
use Validator;
use Sentinel;
use URL;
use View;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Datatables;

use App\Blog;
use App\BlogCategory;
use App\BlogComment;
use App\Http\Requests\BlogCommentRequest;
use App\Http\Requests\BlogRequest;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Response;

//Ratings model
//use App\Models\Ratings;


class RatingsController extends JoshController
{
    //Subscriptions data
    private $tags;

    public function __construct()
    {
        parent::__construct();
        $this->tags = Blog::allTags();
    }
    public function ratings()
    {
        // Grab all the blogs
        /*$blogs = Blog::latest()->simplePaginate(5);
        $blogs->setPath('blog');
        $tags = $this->tags;*/
        // Show the page
        ///////|||||||||THIS NEEDS TO BE REMOVED||||||||/////
        /*$ratingsFromModel = Ratings::all();
        if(isset($_GET['search'])){
             //echo $_GET['search'];
             $searchResult = Ratings::search($_GET['search'])->paginate(4);
             //echo $searchResult ;
             $allRatingss = $searchResult;
             return view('allratings', compact('allRatingss', 'ratingsFromModel'));
        }else{
          $allRatingss = DB::table('dmmx_ratings')->simplePaginate(4);
          return view('allratings', compact('allRatingss', 'ratingsFromModel'));
        }*/
        ///////|||||||||END OF THIS NEEDS TO BE REMOVED||||||||/////
        $ratingsCounter = DB::table('dmmx_ratings')->count();
        return view('allratings', compact('ratingsCounter'));

    }

    public function singleRating($employeeID)
    {
        //get the employee data
        $employeeData = DB::table('dmmx_employees')->where('id', $employeeID)->first();
        //echo $ratingID;
        $ratings2Plot = DB::table('dmmx_ratings')->where('rater_id', $employeeData->idnumber)->take(30)->get();
        $allRatingsData = DB::table('dmmx_ratings')->where('rater_id', $employeeData->idnumber)->simplePaginate(5);

        // $singleRatingData = DB::table('dmmx_ratings')->where('id', $employeeID)->first();
        //calculate the avarage rating
        $sumRatings = DB::table('dmmx_ratings')->sum('stars');
        $countRatings = DB::table('dmmx_ratings')->count('stars');
        $avgRating = round(DB::table('dmmx_ratings')->where('rater_id', $employeeData->idnumber)->avg('stars')); //rounded to the nearest integer
        //echo $avgRatings;
        return view('singlerating' , compact('employeeData', 'allRatingsData', 'ratings2Plot', 'avgRating'));
    }

    //Subscriptions data
    public function data()
    {
        $user = Sentinel::getUser();
        //$users = User::get(['id', 'first_name', 'last_name', 'email','created_at']);
        //get watched ID Numbers 
        $idsWatched = DB::table('dmmx_employees_watch')->where('companyid', $user->id)->get();
        $idsWatchedArray = array();
        foreach($idsWatched as $singleid){
            array_push($idsWatchedArray ,$singleid->employeeid);
        }

        $employeesWatchedList = DB::table('dmmx_employees')->whereIn('idnumber', $idsWatchedArray)->get(['id', 'idnumber', 'email', 'permissions2','last_login','first_name','last_name','bio','gender','dob','pic', 'country', 'state', 'city', 'address', 'postal', 'authoritiesverified', 'lastknownaddresses', 'lastknowncontactnumbers', 'lastknownemployers', 'watchingcompanies', 'created_at', 'updated_at'])->take(5);

        $allRatingsData = DB::table('dmmx_ratings')->get(['id', 'rated_fullname', 'rated_type', 'rated_title','experience_description','stars','company','rater_id','contact_confirm','incident_time','rated_email', 'created_at', 'updated_at']);

        return Datatables::of($employeesWatchedList)
            ->add_column('stars',function($employee) {
                //get the emloyee's avarage rating 
                $user = Sentinel::getUser();
                $getStatus = DB::table('dmmx_employees_watch')->where([['companyid','=',$user->id],['employeeid','=',$employee->idnumber]])->first();
                $watchStatus = $getStatus->watchstatus;
                $avgRating = round(DB::table('dmmx_ratings')->where('rater_id', $employee->idnumber)->avg('stars')); //rounded to the nearest integer
                if($watchStatus == "pending approval"){
                    $actions = "-";
                }else{
                    if($avgRating == 0){
                        $actions = "no rating yet";
                    }else{
                        $actions = $avgRating;
                    }
                }
                //}
                return $actions;
            })
            ->add_column('verified',function($employee) {
                //check the authorities veried status 

                $actions = $employee->authoritiesverified;
                //}
                return $actions;
            })
            ->add_column('watchstatus',function($employee) {
                //get the watch status
                $user = Sentinel::getUser();
                $getStatus = DB::table('dmmx_employees_watch')->where([['companyid','=',$user->id],['employeeid','=',$employee->idnumber]])->first();
                $watchStatus = $getStatus->watchstatus;
                //}
                return $watchStatus;
            })
            ->add_column('actions',function($employee) {
                $user = Sentinel::getUser();
                $getStatus = DB::table('dmmx_employees_watch')->where([['companyid','=',$user->id],['employeeid','=',$employee->idnumber]])->first();
                $watchStatus = $getStatus->watchstatus;

                if($watchStatus == 'active'){
                    $actions = '<a href='. route('allratings.rating.show', $employee->id) .'><i class="livicon" data-name="info" data-size="18" data-loop="true" data-c="#428BCA" data-hc="#428BCA" title="view employee">view</i></a>';
                }else{
                    $actions = '<a href='. route('allratings.rating.cancel', $employee->id) .'><i class="livicon" data-name="info" data-size="18" data-loop="true" data-c="#428BCA" data-hc="#428BCA" title="cancel request">Cancel</i></a>';
                }
                return $actions;
            })
            ->rawColumns(['actions'])
            ->make(true);
    }

    //Cancel Request 
    public function cancelWatchRequest($employeeID){
        //return "cancelation request recieved";
        $employeeData = DB::table('dmmx_employees')->where('id', $employeeID)->first();
        $user = Sentinel::getUser();
        $deleteRequest = DB::table('dmmx_employees_watch')->where([['companyid', $user->id],['employeeid', $employeeData->idnumber]])->delete();
        if($deleteRequest){
            return Redirect::back()->with('success', 'Employee watch request cancellation was successful');
        }else{
            return Redirect::back()->with('error', 'Something went wrong, please try again');
        }
    }

    //general page for private profile
    public function generalPrivateRatings(){
        $user = Sentinel::getUser();
        $ratingsCounter = DB::table('dmmx_self_ratings')->where('userid', $user->id)->count();
        return view('privateprofile', compact('ratingsCounter'));
    }

    public function privateData(){
        $user = Sentinel::getUser();

        $allSelfRatings = DB::table('dmmx_self_ratings')->where('userid', $user->id)->get();

        return Datatables::of($allSelfRatings)
            ->add_column('actions',function($selfRating) {
                $actions = '<a href='. route('allratings.rating.show', $selfRating->id) .'><i class="livicon" data-name="info" data-size="18" data-loop="true" data-c="#428BCA" data-hc="#428BCA" title="view employee">view</i></a>';
                return $actions;
            })
            ->rawColumns(['actions'])
            ->make(true);
    }
}
