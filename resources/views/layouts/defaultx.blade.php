<!DOCTYPE html>
<html>
<!--this default page is for logged in users only-->
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @if(env('APP_ENV') === 'prod')
        <link rel="stylesheet" type="text/css" href="{{ secure_asset('assets/css/bootstrap.min.css') }}">
        <!-- Google Tag Manager -->
        <meta http-equiv="Content-Security-Policy" content="default-src 'self'; script-src 'self' 'unsafe-inline' oss.maxcdn.com www.google-analytics.com www.googletagmanager.com; connect-src 'self'; img-src 'self' 'unsafe-inline' * data:; style-src 'self' 'unsafe-inline' fonts.googleapis.com; font-src 'self' 'unsafe-inline' fonts.gstatic.com fonts.googleapis.com data:; frame-src 'self' 'unsafe-inline' dmmdev.com;">
        <script>(function(b,m,h,a,g){b[a]=b[a]||[];b[a].push({"gtm.start":new Date().getTime(),event:"gtm.js"});var k=m.getElementsByTagName(h)[0],e=m.createElement(h),c=a!="dataLayer"?"&l="+a:"";e.async=true;e.src="https://www.googletagmanager.com/gtm.js?id="+g+c;k.parentNode.insertBefore(e,k)})(window,document,"script","dataLayer","GTM-K6GM83G");</script>
        <!-- End Google Tag Manager -->
        {{--<script>ga('create', 'UA-XXXXX-Y', 'auto');</script>--}}
        <script>ga('require', 'ecommerce');</script>
    @endif
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
    <title>
    	@section('title')
        | StaffLife
        @show
    </title>
    <!--global css starts-->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/lib.1.css') }}">
    <!--end of global css-->
    <!--page level css-->
    @yield('header_styles')
    <!--end of page level css-->
</head>

<body>
@if(env('APP_ENV') === 'prod')
    <!-- Google Tag Manager (noscript) -->
    <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-K6GM83G"
                      height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
    <!-- End Google Tag Manager (noscript) -->
@endif
@if(!Sentinel::guest())
<?php 
//This is a temporary solution to prevent the app frrom crashing
   $user = Sentinel::getUser();
   $employeeCheck = DB::table('dmmx_employees')->where('email','=',$user->email)->count();
?>
@else
   <?php
        URL::forcescheme('http');
   ?>
@endif

<?php 
//get the recent posts 
use Illuminate\Support\Facades\DB;
$recentPosts = DB::table('blogs')->orderBy('id', 'desc')->limit(4)->get();
?>
    <!-- Header Start -->
    <header>
        <!-- Icon Section Start -->
        <div class="icon-section">
            <div class="container">
                <ul class="list-inline">
                    <li>
                        <a href="#"> <i class="livicon" data-name="facebook" data-size="18" data-loop="true" data-c="#fff" data-hc="#757b87"></i>
                        </a>
                    </li>
                    <li>
                        <a href="#"> <i class="livicon" data-name="twitter" data-size="18" data-loop="true" data-c="#fff" data-hc="#757b87"></i>
                        </a>
                    </li>
                    <li>
                        <a href="#"> <i class="livicon" data-name="google-plus" data-size="18" data-loop="true" data-c="#fff" data-hc="#757b87"></i>
                        </a>
                    </li>
                    <li>
                        <a href="#"> <i class="livicon" data-name="linkedin" data-size="18" data-loop="true" data-c="#fff" data-hc="#757b87"></i>
                        </a>
                    </li>
                    <li>
                        <a href="#"> <i class="livicon" data-name="rss" data-size="18" data-loop="true" data-c="#fff" data-hc="#757b87"></i>
                        </a>
                    </li>
                    <li class="pull-right">
                        <ul class="list-inline icon-position">
                            <li>
                                <a href="mailto:"><i class="livicon" data-name="mail" data-size="18" data-loop="true" data-c="#fff" data-hc="#fff"></i></a>
                                <label class="hidden-xs"><a href="mailto:" class="text-white">info@stafflife.com</a></label>
                            </li>
                            @if(!Sentinel::guest())
                            <!--check if the user is normal employee-->
                            <?php //if(!empty($user->permissions2)){ ?>
                            <!--<li><label class="hidden-xs"><a href="{{ URL::to('dashboard') }}" class="text-white">Dashboard</a></label>
                            </li>-->
                            <?php //}?>
                            @endif
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
        <!-- //Icon Section End -->
        <!-- Nav bar Start -->
        <nav class="navbar navbar-default container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#collapse">
                    <span><a href="#">_<i class="livicon" data-name="responsive-menu" data-size="25" data-loop="true" data-c="#757b87" data-hc="#ccc"></i>
                    </a></span>
                </button>
                <a class="navbar-brand" href="{{ route('home') }}"><img src="{{ asset('assets/images/logodmmx.jpg') }}" alt="logo" class="logo_position">
                </a>
            </div>
            <div class="navbar-collapse collapse" id="collapse">
                <ul class="nav navbar-nav navbar-right">
                    <li {!! (Request::is('/') ? 'class="active"' : '') !!}><a href="{{ route('home') }}"> Home</a>
                    </li>
                    

                    {{--check if user is subscribed and is subscribed to a group--}}
                    <?php 
                       //Get the current user's email. (the check is based on email, we know only one email is master)
                       $user = Sentinel::getUser();
                       //check for the user's group subscription
                       if(!empty($user)){
                       $checkUserG = DB::table('dmmx_account_subscriptions')->where([['account_email', $user->email],['account_type','1']])->first();
                       }else{
                          $checkUserG = ''; 
                       }
                       //cehck for the user's individual subscription
                       if(!empty($user)){
                       $checkUserI = DB::table('dmmx_account_subscriptions')->where([['account_email', $user->email],['account_type','0']])->first();
                       }else{
                          $checkUserI = ''; 
                       }
                    ?>

                     @if(!empty($checkUserG))
                    <li><a href="{{ URL::to('invite') }}"> Send Invitation</a>  
                    </li>
                    @endif

                    
                    @if(!Sentinel::guest())
                    <?php if(empty($user->permissions2) && $employeeCheck !== 0){ //the user should be in the class of employees to see this?>
                    <li class="dropdown {!! (Request::is('news') || Request::is('news_item') ? 'active' : '') !!}"><a href="#" class="dropdown-toggle" data-toggle="dropdown"> Profile</a>
                        <ul class="dropdown-menu" role="menu">
                            <li><a href="{{ URL::to('all-ratings') }}">My Public Profile</a>
                            </li>
                            <!--<li><a href="{{ URL::to('news_item') }}">Most Viewed</a>
                            </li>-->
                            <li><a href="{{ URL::to('private-ratings') }}">My Private Profile</a></li>
                        </ul>
                    </li>
                    <?php };
                    if($employeeCheck == 0){?>
                        <li><a href="{{ URL::to('dashboard') }}">Dashboard</a>
                        </li>
                    <?php } ?>
                    @endif
                   
                    <!-- <li class="dropdown {!! (Request::is('news') || Request::is('news_item') ? 'active' : '') !!}"><a href="#" class="dropdown-toggle" data-toggle="dropdown"> News</a>
                        <ul class="dropdown-menu" role="menu">
                            <li><a href="{{ URL::to('news') }}">News</a>
                            </li>
                            <li><a href="{{ URL::to('news_item') }}">News Item</a>
                            </li>
                        </ul>
                    </li>-->
                    <li {!! (Request::is('blog') || Request::is('blogitem/*') ? 'class="active"' : '') !!}><a href="{{ URL::to('blog') }}"> Blog</a>
                    </li>
                    <li {!! (Request::is('contact') ? 'class="active"' : '') !!}><a href="{{ URL::to('contact') }}">Contact</a>
                    </li>
                    {{--based on anyone login or not display menu items--}}
                    @if(Sentinel::guest())
                        <li><a href="{{ URL::to('login') }}">Login</a>
                        </li>
                        <li><a href="{{ URL::to('register') }}">Sign up</a>
                        </li>
                    @else
                        <li><a href="{{ URL::to('logout') }}">Logout</a>
                        </li>
                    @endif
                </ul>
            </div>
        </nav>
        <!-- Nav bar End -->
    </header>
    <!-- //Header End -->
    
    <!-- slider / breadcrumbs section -->
    @yield('top')

    <!-- Content -->
    @yield('content')

    <!-- Footer Section Start -->
    <footer>
        <div class="container footer-text">
            <!-- About Us Section Start -->
            <div class="col-sm-4">
                <h4>About Us</h4>
                <p>
                    Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.
                </p>
                <hr id="hr_border2">
                <h4 class="menu">Follow Us</h4>
                <ul class="list-inline">
                    <li>
                        <a href="#"> <i class="livicon" data-name="facebook" data-size="18" data-loop="true" data-c="#ccc" data-hc="#ccc"></i>
                        </a>
                    </li>
                    <li>
                        <a href="#"> <i class="livicon" data-name="twitter" data-size="18" data-loop="true" data-c="#ccc" data-hc="#ccc"></i>
                        </a>
                    </li>
                    <li>
                        <a href="#"> <i class="livicon" data-name="google-plus" data-size="18" data-loop="true" data-c="#ccc" data-hc="#ccc"></i>
                        </a>
                    </li>
                    <li>
                        <a href="#"> <i class="livicon" data-name="linkedin" data-size="18" data-loop="true" data-c="#ccc" data-hc="#ccc"></i>
                        </a>
                    </li>
                    <li>
                        <a href="#"> <i class="livicon" data-name="rss" data-size="18" data-loop="true" data-c="#ccc" data-hc="#ccc"></i>
                        </a>
                    </li>
                </ul>
            </div>
            <!-- //About us Section End -->
            <!-- Contact Section Start -->
            <div class="col-sm-4">
                <h4>Contact Us</h4>
                <ul class="list-unstyled">
                    <li>35,Lorem Lis Street, Park Ave</li>
                    <li>Lis Street, India.</li>
                    <li><i class="livicon icon4 icon3" data-name="cellphone" data-size="18" data-loop="true" data-c="#ccc" data-hc="#ccc"></i>Phone:9140 123 4588</li>
                    <li><i class="livicon icon4 icon3" data-name="printer" data-size="18" data-loop="true" data-c="#ccc" data-hc="#ccc"></i> Fax:400 423 1456</li>
                    <li><i class="livicon icon3" data-name="mail-alt" data-size="20" data-loop="true" data-c="#ccc" data-hc="#ccc"></i> Email:<span class="text-success" style="cursor: pointer;">
                        info@joshadmin.com</span>
                    </li>
                    <li><i class="livicon icon4 icon3" data-name="skype" data-size="18" data-loop="true" data-c="#ccc" data-hc="#ccc"></i> Skype:
                        <span class="text-success"  style="cursor: pointer;">Joshadmin</span>
                    </li>
                </ul>
                <hr id="hr_border">
                <div class="news menu">
                    <h4>News letter</h4>
                    <p>subscribe to our newsletter and stay up to date with the latest news and deals</p>
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="yourmail@mail.com" aria-describedby="basic-addon2">
                        <a href="#" class="btn btn-primary text-white" role="button">Subscribe</a>
                    </div>
                </div>
            </div>
            <!-- //Contact Section End -->
            <!-- Recent post Section Start -->
            <div class="col-sm-4">
                <h4>Recent Posts</h4>
                <?php foreach($recentPosts as $onePost){ 
                //get the blog author 
                $authorDetails = DB::table('users')->where('id', $onePost->user_id)->first();
                //print_r($authorDetails);
                //echo $authorDetails->first_name;
                ?>
                <div class="media">
                    <div class="media-left media-top">
                        <a href="#">
                            <img width="35px" height="35px" class="img-circle img-bor" src="{!! url('/').'/uploads/users/'.$authorDetails->pic !!}" alt="image">
                        </a>
                    </div>
                    <div class="media-body">
                        <p class="media-heading"><?php echo $onePost->title;?>
                        </p>
                        <p class="pull-right"><i><?php echo $authorDetails->first_name ." " .$authorDetails->last_name;?></i></p>
                    </div>
                </div>
                <?php } ?>
            </div>
            <!-- //Recent Post Section End -->
        </div>
    </footer>
    <!-- //Footer Section End -->
    <div class="copyright">
        <div class="container">
        <p>Copyright &copy; dmmx, 2017</p>
        </div>
    </div>
    <a id="back-to-top" href="#" class="btn btn-primary btn-lg back-to-top" role="button" title="Return to top" data-toggle="tooltip" data-placement="left">
        <i class="livicon" data-name="plane-up" data-size="18" data-loop="true" data-c="#fff" data-hc="white"></i>
    </a>
    <!--global js starts-->
    <script type="text/javascript" src="{{ asset('assets/js/frontend/lib.js') }}"></script>
    <!--global js end-->
    <!-- begin page level js -->
    @yield('footer_scripts')
    <!-- end page level js -->
</body>

</html>
