<?php 
//Check if the user has bought any package 
    use Illuminate\Support\Facades\DB;
    use Illuminate\Support\Facades\Storage as Storage;
    use App\Repositories\UserRepository;

    $user = Sentinel::getUser();
    $subscriptionCheck = DB::table('dmmx_paysubscriptions')->where('userid', $user->id)->get();

     $checkIfAdmin = DB::table('dmmx_admins_table')->where([['email', $user->email],['status', 'Active']])->get();

     //if the user is supporting admin, grab the subscriptionPackageDAta from the super admin account
        if(count($checkIfAdmin) > 0){
            $adminRow = DB::table('dmmx_admins_table')->where('email', $user->email)->first();
            $subscriptionCheck = DB::table('dmmx_paysubscriptions')->where('userid',$adminRow->userid )->get();
        }

    $package_id = $subscriptionCheck->first()->packageid;

    $minimum_package_type_for_support_access = 'Business';

    $minimum_package_id_for_support_access = DB::table('packages')->where('name', $minimum_package_type_for_support_access)->first()->id;

    $disk = Storage::disk('gcs');

    $url = $disk->url('/users/'.$user->pic);

?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>
        @section('title')
            | StaffLife
        @show
    </title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
    <!-- global css -->

    <link href="{{ asset('assets/css/app.css') }}" rel="stylesheet" type="text/css"/>
    <link rel="shortcut icon" href="{{ asset('assets/images/favicon.png') }}" type="image/x-icon">
    <link rel="icon" href="{{ asset('assets/images/favicon.png') }}" type="image/x-icon">
    <!-- font Awesome -->

    <!-- end of global css -->
    <!--page level css-->
    @yield('header_styles')
            <!--end of page level css-->
    <style>
       .choose-country{
         margin-top: 5px;
       }

       .trial-text{
           color:#EF6F6C !important;
       }

       .tooltip {
   width: 100%;
  min-width: 75px;
  max-width: 255px;
}

.tooltip .tool-content {
  margin:0;
  padding:0;
  opacity: 0;
  visibility: hidden;
  position: absolute;
  width:100%;
  height:100%;
}
    </style>

<body class="skin-josh">
<header class="header">
    <a href="{{ route('dashboard') }}" class="logo">
        <img src="{{ asset('assets/img/logostaff.png') }}" alt="logo">
    </a>
    <nav class="navbar navbar-static-top" role="navigation">
        <!-- Sidebar toggle button-->
        <div>
            <a href="#" class="navbar-btn sidebar-toggle" data-toggle="offcanvas" role="button">
                <div class="responsive_nav"></div>
            </a>
        </div>
        <div class="navbar-right">
            <ul class="nav navbar-nav">
                <?php //@include('admin.layouts._messages')
                //@include('admin.layouts._notifications')
                ?>
                <li>
                 @if($user->onGenericTrial() && count($user->subscriptions)==0 && !(UserRepository::reachedCritical()) && count($checkIfAdmin) == 0)
                  <a class="trial-text" href="#"> You are currently on a FREE TRIAL. </a>
                  @endif
                  @if($user->onGenericTrial() && count($user->subscriptions)==0 && (UserRepository::reachedCritical()) && count($checkIfAdmin) == 0)
                  <a class="trial-text" href="{{ route('pay-package') }}"> Your trial is expiring, would you like to SUBSCRIBE NOW?</a>
                  @endif
                  @if(!$user->onGenericTrial() && count($user->subscriptions)==0 && count($checkIfAdmin) == 0)
                  <a class="trial-text" href="#"> Your trial has expired. Subscribe today for many additional features.</a>
                  @endif
                 </li>
                <li class="dropdown user user-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        @if(Sentinel::getUser()->pic)
                            <img src="{{ $url }}" alt="img" height="35px" width="35px"
                                 class="img-circle img-responsive pull-left"/>
                        @else
                            <img src="{!! asset('assets/img/authors/avatar3.jpg') !!} " width="35"
                                 class="img-circle img-responsive pull-left" height="35" alt="riot">
                        @endif
                        <div class="riot">
                            <div>
                                <p class="user_name_max">{{ Sentinel::getUser()->first_name }} {{ Sentinel::getUser()->last_name }}</p>
                                <span>
                                        <i class="caret"></i>
                                    </span>
                            </div>
                        </div>
                    </a>
                    <ul class="dropdown-menu">
                        <!-- User image -->
                        <li class="user-header bg-light-blue">
                            @if(Sentinel::getUser()->pic)
                                <img src="{!! $url !!}" alt="img"
                                     class="img-circle img-bor"/>
                            @else
                                <img src="{!! asset('assets/img/authors/avatar3.jpg') !!}"
                                     class="img-responsive img-circle" alt="User Image">
                            @endif
                            <p class="topprofiletext">{{ Sentinel::getUser()->first_name }} {{ Sentinel::getUser()->last_name }}</p>
                        </li>
                        <!-- Menu Body -->
                        <li>
                            <a href="{{ URL::to('my-account') }}">
                                <i class="livicon" data-name="user" data-s="18"></i>
                                My Profile
                            </a>
                        </li>
                        <li role="presentation"></li>
                        <!--<li>
                            <a href="{{ route('admin.users.edit', Sentinel::getUser()->id) }}">
                                <i class="livicon" data-name="gears" data-s="18"></i>
                                Account Settings
                            </a>
                        </li>-->
                        <!-- Menu Footer-->
                        <li class="user-footer">
                            <!--<div class="pull-left">
                                <a href="{{ URL::route('lockscreen',Sentinel::getUser()->id) }}">
                                    <i class="livicon" data-name="lock" data-size="16" data-c="#555555" data-hc="#555555" data-loop="true"></i>
                                    Lock
                                </a>
                            </div>-->
                            <div class="pull-left">
                                <a href="{{ URL::to('logout') }}">
                                    <i class="livicon" data-name="sign-out" data-s="18"></i>
                                    Logout
                                </a>
                            </div>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>
</header>
<div class="wrapper row-offcanvas row-offcanvas-left">
    <!-- Left side column. contains the logo and sidebar -->
    <aside class="left-side sidebar-offcanvas">
        <section class="sidebar ">
            <div class="page-sidebar  sidebar-nav">
                <div class="nav_icons">
                    <ul class="sidebar_threeicons">
                        <!--<li>
                            <a href="{{ URL::to('my-account') }}">
                                <i class="livicon" data-name="user" title="My Account" data-loop="true"
                                   data-color="#e9573f" data-hc="#00A663" data-s="25"></i>
                            </a>
                        </li>
                        <li>
                            <a href="{{ URL::to('employees') }}">
                                <i class="livicon" data-name="users" title="Employees" data-loop="true"
                                   data-color="#e9573f" data-hc="#00A663" data-s="25"></i>
                            </a>
                        </li>-->
                        @if(count($checkIfAdmin) == 0)
                        <!--<li>
                            <a href="{{ URL::to('loademployees') }}">
                                <i class="livicon" data-name="users-add" title="Load prospects" data-loop="true"
                                   data-color="#e9573f" data-hc="#00A663" data-s="25"></i>
                            </a>
                        </li>
                        <li>
                            <a href="{{ URL::to('upgrade-downgrade') }}">
                                <i class="livicon" data-name="arrow-circle-up" title="Upgrade Downgrade" data-loop="true"
                                   data-color="#e9573f" data-hc="#00A663" data-s="25"></i>
                            </a>
                        </li>-->
                        @endif
                    </ul>
                </div>
                <div class="clearfix"></div>
                <!-- BEGIN SIDEBAR MENU -->
                @include('admin.layouts._left_menux')
                <!-- END SIDEBAR MENU -->
            </div>
        </section>
    </aside>
    <aside class="right-side">

        <!-- Notifications -->
        @include('notifications')

                <!-- Content -->
        @yield('content')

    </aside>
    <!-- right-side -->
</div>

 <!--start date modal starts here-->
      <div class="modal fade" id="select_country" tabindex="-1" role="dialog" aria-labelledby="edit" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden=true>×</button>
                <h4 class="modal-title custom_align" id="Heading">
                    Current Country: {{ __('general.region') }} @if(__('general.flag')!== "")<img class=flag height=20px width=30px src="https://lipis.github.io/flag-icon-css/flags/4x3/{{ __('general.flag') }}.svg" alt="French Southern Territories Flag">
                    @else
                        <i class="fa fa-fw fa-globe"></i>
                    @endif
                </h4>
            </div>
            <div class="modal-body">
                @foreach( config( 'LLS.locales' ) AS $locale => $title )
                    @if(isset($currentRouteName))
                        <a href="{{ route($currentRouteName,  $locale) }}">
                            <button type="submit" class="btn btn-link">{{ $title }}</button>
                        </a><br>
                    @else
                        <a href="{{ route(Route::currentRouteName(),  $locale) }}">
                            <button type="submit" class="btn btn-link">{{ $title }}</button>
                        </a><br>
                    @endif
                @endforeach
                <button type="button" class="btn btn-warning" data-dismiss="modal">
                    <span class="glyphicon glyphicon-remove"></span>
                    Back
                </button>
            </div>
        </div>
    </div>
</div>
 <!-- /.modal ends here -->
<!-- global js -->
<script src="{{ asset('assets/js/app.js') }}" type="text/javascript"></script>
@if($package_id >= $minimum_package_id_for_support_access)
    <script type="text/javascript">
        var LHCChatOptions = {};
        LHCChatOptions.opt = {widget_height:340,widget_width:300,popup_height:520,popup_width:500,domain:'stafflife.com'};
        (function() {
            var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
            var referrer = (document.referrer) ? encodeURIComponent(document.referrer.substr(document.referrer.indexOf('://')+1)) : '';
            var location  = (document.location) ? encodeURIComponent(window.location.href.substring(window.location.protocol.length)) : '';
            po.src = '//dmmdev.com/lhctest/index.php/chat/getstatus/(click)/internal/(position)/bottom_right/(ma)/br/(hide_offline)/true/(top)/350/(units)/pixels/(leaveamessage)/true/(theme)/1?r='+referrer+'&l='+location;
            var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
        })();
    </script>
@endif
<!-- end of global js -->
<!-- begin page level js -->
@yield('footer_scripts')
      
        <!-- end page level js -->
</body>
</html>
