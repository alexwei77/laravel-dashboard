﻿<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @if (App::environment('prod'))
        <script>(function (b, m, h, a, g) {
                b[a] = b[a] || [];
                b[a].push({"gtm.start": new Date().getTime(), event: "gtm.js"});
                var k = m.getElementsByTagName(h)[0], e = m.createElement(h), c = a != "dataLayer" ? "&l=" + a : "";
                e.async = true;
                e.src = "https://www.googletagmanager.com/gtm.js?id=" + g + c;
                k.parentNode.insertBefore(e, k)
            })(window, document, "script", "dataLayer", "GTM-K6GM83G");</script>
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
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/fonts.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/defaultboth.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/frontend/jquery-eu-cookie-law-popup.css') }}">
    <link href="https://fonts.googleapis.com/css?family=Montserrat|Roboto" rel="stylesheet">
    <style>
        @media screen and (min-width: 768px) {
            .mobilepr {
                display: none;
            }
        }

        @media screen and (max-width: 767px) {
            .desktpr {
                display: none;
            }
        }

        @media (min-width: 768px) {
            .modal-dialog {
                width: 760px !important;                
            }
        }
    </style>
    <!--end of global css-->
    <!--page level css-->
    @yield('header_styles')

</head>
<?php

use Jaybizzle\CrawlerDetect\CrawlerDetect;
use App\MyLibrary\GetLocaleDefualt;

$ip2location = new GetLocaleDefualt();

$locale = $ip2location->get_locale();

$nav_section = Session::has('nav_section') ? Session::get('nav_section') : 'business';

$locale_update_url = null;
if (isset($locale)) {
    $locale_update_url = url(config('LLS.route_prefix') . '/' . $locale);
}
?>
@if(!Sentinel::guest())
    <?php
    $user = Sentinel::getUser();
    $employeeCheck = DB::table('dmmx_employees')->where('email', '=', $user->email)->count();
    ?>
@else
    <?php
    URL::forcescheme('http');

    //check if the user is a crawler or normal user
    $CrawlerDetect = new CrawlerDetect;
    $crawlerCheck = $CrawlerDetect->isCrawler();
    ?>
@endif
<body>
@if (App::environment('prod'))
    <!-- Google Tag Manager (noscript) -->
    <noscript>
        <iframe src="https://www.googletagmanager.com/ns.html?id=GTM-K6GM83G" height="0" width="0"
                style="display:none;visibility:hidden"></iframe>
    </noscript>
    <!-- End Google Tag Manager (noscript) -->
@endif
<!-- Header Start -->
<header>

<div class="icon-section eupopup eupopup-bottom">
        <div class="container">
            <ul class="list-inline" style="max-width:1110px;">
                <li>
                    <a data-toggle="modal" id="choose-country" href="#" data-target="#add_start_date"
                       class="btn1 btn-primary btn-sm text-white">@if(__('general.flag')!== "")<img class="flag"
                                                                                                    height="10px"
                                                                                                    width="20px"
                                                                                                    src="https://lipis.github.io/flag-icon-css/flags/4x3/{{ __('general.flag') }}.svg"
                                                                                                    alt="French Southern Territories Flag"> {{ __('general.region') }} @else
                            <i class="fa fa-fw fa-globe"></i>{{ __('general.region') }} @endif
                    </a>
                </li>
                <li>
                    <a href="#" style="color:#fff">
                    </a>
                </li>
                <li class="pull-right">
                    <ul class="list-inline icon-position" style="padding-top:0 !important;">
                        <li>
                            <a href="https://www.linkedin.com/company/StaffLife" style="color:#fff" target="_blank"> <i
                                        class="livicon" data-name="linkedin" data-size="14" data-loop="true"
                                        data-c="#fff" data-hc="#757b87"></i>
                            </a>
                        </li>
                        <li>
                            <a href="https://www.facebook.com/StaffLifeGlobal/" style="color:#fff" target="_blank"> <i
                                        class="livicon" data-name="facebook" data-size="14" data-loop="true"
                                        data-c="#fff" data-hc="#757b87"></i>
                            </a>
                        </li>
                        {{-- <li><a href="{{ route('news', session('custom_lang')) }}" style="color:#fff; font-size:14px;">News</a></li> --}}
                    </ul>
                </li>
            </ul>
        </div>
    </div>
    <nav id="navbar-main" class="navbar navbar-default">
    <div class="header container">
        <div class="navbar-header">
        <a  class="navbar-brand" href="{{ route('home', session('custom_lang')) }}"><img src="{{ asset('assets/images/logostaff.png') }}" alt="logo" class="logo_position"></a>
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#collapse">
            <span><a href="#"> <i class="livicon" data-name="responsive-menu" data-size="25" data-loop="true" data-c="#757b87"
                                data-hc="#ccc"></i>
            </a></span>
                            </button>
                
        </div>
        <div class="collapse navbar-collapse" id="collapse">
            <ul id="navbar" class="nav navbar-nav">
                <li {!! (Request::is(session('custom_lang') .'/business' ) || Request::is(session('custom_lang')) || Request::is('/business') || Request::is('/') ? 'class="active"' : '') !!}>
                    <a href="{{ route('home', session('custom_lang')) }}"> {{ __('home.employer') }}</a>
                </li>
                <li {!! (Request::is(session('custom_lang') .'/staff' ) || Request::is(session('custom_lang')) || Request::is('staff') || Request::is('/') ? 'class="employee active"' : 'class="employee"') !!}>
                    <a href="{{ route('staff', session('custom_lang')) }}"> {{ __('home.employee') }}</a>
                </li>
                @if(session('custom_lang') !== '')
                    <li {!! (Request::is(session('custom_lang') .'/business/pricing') ? 'class="active"' : '') !!}>
                        <a href="{{ route('pricing', session('custom_lang')) }}"> {{ __('home.pricing') }}</a>
                    </li>
                @else
                    <li {!! (Request::is('business/pricing') ? 'class="active"' : '') !!}><a
                      href="{{ route('pricing', session('custom_lang')) }}"> {{ __('home.pricing') }}</a>
                    </li>
                @endif
                @if(session('custom_lang') !== '')
                    <li >
                        <div class="dropdown">
                        <a href="#" data-toggle="dropdown" class="dropdown-toggle ddfontcolor"
                            aria-expanded="false">Support</a>
                        <div class="dropdown-content">
                            @if(env('APP_ENV') === 'prod')
                                <a href="{{ secure_url(session('custom_lang') . '/' . session('nav_section').'/contacts') }}">{{ __('home.contact') }}</a>
                            @else
                                <a href="{{ route(session('nav_section').'.contacts', session('custom_lang')) }}">{{ __('home.contact') }}</a>
                            @endif
                            <a href="{{ route('aboutus', session('custom_lang')) }}">About</a>
                            <a href="{{ route(session('nav_section').'.faq', session('custom_lang')) }}"> FAQ</a>
                            <a href="{{ route(session('nav_section').'.help', session('custom_lang')) }}">Help</a>
                        </div>
                        </div>
                    </li>
                @else
                    <li>
                        <a href="#" data-toggle="dropdown" class="dropdown-toggle ddfontcolor"
                            aria-expanded="false"
                            >Support</a>
                        <div class="dropdown">
                        <div class="dropdown-content">
                            <a href="{{ route('aboutus', session('custom_lang')) }}">About</a>
                            @if(env('APP_ENV') === 'prod')
                                <a href="{{ secure_url(session('custom_lang') . '/' . session('nav_section').'/contacts') }}">{{ __('home.contact') }}</a>
                            @else
                                <a href="{{ route(session('nav_section').'.contacts', session('custom_lang')) }}">{{ __('home.contact') }}</a>
                            @endif
                            <a href="{{ route(session('nav_section').'.faq', session('custom_lang')) }}"> FAQ</a>
                            <a href="{{ route(session('nav_section').'.help', session('custom_lang')) }}">Help</a>
                        </div>
                        </div>
                    </li>
                @endif
                @if(Sentinel::guest())
                    <li><a href="{{ URL::to('login') }}">{{ __('home.login') }}</a></li>
                @else
                    <li><a href="{{ URL::to('dashboard') }}">Dashboard</a></li>
                @endif
                    <li><a class="button" href="{{ route('/business/subscribe', [session('custom_lang'),'package' => 'standard', 'yearly' => 'yearly']) }}">TRY IT FREE</a></li>
            </ul>
        </div>
    </nav>
    
</header>

@include('notifications')

@yield('top')

@yield('content')


<div class="modal fade font-open-sans" id="add_start_date" tabindex="-1" role="dialog" aria-labelledby="edit" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden=true>×</button>
                <h4 class="modal-title custom_align" id="Heading">
                    Current Country: {{ __('general.region') }} @if(__('general.flag')!== "")<img class=flag height=20px
                                                                                                  width=30px
                                                                                                  src="https://lipis.github.io/flag-icon-css/flags/4x3/{{ __('general.flag') }}.svg"
                                                                                                  alt="Country Flag">
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
                        @if(isset($slug))
                            <a href="{{ URL::to($locale .'/newsitem/' .$slug) }}">
                                <button type="submit" class="btn btn-link">{{ $title }}</button>
                            </a><br>
                        @else
                            <a href="{{ route(Route::currentRouteName(),  $locale) }}">
                                <button type="submit" class="btn btn-link">{{ $title }}</button>
                            </a><br>
                        @endif
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



<footer>
    <div class="font-open-sans">
        <div>
            <div class="container text-center">
                <div class="try-btn col-sm-6">
                    <p class="footleftxt foottop15"><a class="btn success" href="{{ route('/business/subscribe', [session('custom_lang'),'package' => 'standard', 'yearly' => 'yearly']) }}">TRY IT FREE</a></p>
                </div>
                <div class="trial col-sm-6">   
                    <p class="footcentertxt" style="color:#757B87;">14-day free trial. No credit card required.</p>                 
                    <p class="footcentertxt"><a class="makeorange"  style="color:#ee6f00;text-decoration:underline;font-size:15px;" href="{{ route('pricing', session('custom_lang')) }}">See Plans and Pricing</a></p>
                </div>
            </div>            
            <hr id="hr_border2" style="margin:0;"> 
        </div>          
        <div>
            <div class="container" style="padding:25px 0;">
                <div class="col-sm-3">
                    <h4>Employers</h4>
                    <hr id="hr_border2">
                    <ul class="list">
                        <li><a class="business" href="{{ route('home', session('custom_lang')) }}">Home</a></li>
                        <li><a class="business" href="{{ route('business.faq', session('custom_lang')) }}">FAQ</a></li>
                        <li><a class="business" href="{{ route('business.help', session('custom_lang')) }}">How to</a></li>
                        <li><a class="business" href="{{ route('pricing', session('custom_lang')) }}">Pricing</a></li>
                        <li><a class="business" href="{{ route('business.terms-and-conditions', session('custom_lang')) }}">Terms
                                & Conditions</a></li>
                    </ul>
                </div>
                <div class="col-sm-3">
                    <h4>Employees</h4> 
                    <hr id="hr_border2">                   
                    <ul class="list">
                        <li><a class="staff" href="{{ route('staff', session('custom_lang')) }}">Home</a></li>
                        <li><a class="staff" href="{{ route('staff.faq', session('custom_lang')) }}">FAQ</a></li>
                        <li><a class="staff" href="{{ route('staff.help', session('custom_lang')) }}">How to</a></li>
                        <li><a class="staff" href="{{ route('staff.terms-and-conditions', session('custom_lang')) }}">Terms
                                & Conditions</a></li>
                    </ul>
                </div>
                <div class="col-sm-3">
                    <h4>Get In Touch</h4>   
                    <hr id="hr_border2">                 
                    <ul class="list">
                        @if(env('APP_ENV') === 'prod')
                            <li>
                                <a href="{{ secure_url(session('custom_lang') . '/' . session('nav_section').'/contacts') }}">Contact us</a>
                            </li>
                        @else
                            <li>
                                <a href="{{ route(session('nav_section').'.contacts', session('custom_lang')) }}">Contact us</a>
                            </li>
                        @endif
                        <li><a href="https://www.facebook.com/StaffLifeGlobal/">Facebook</a></li>
                        <li><a href="https://www.linkedin.com/company/StaffLife">LinkedIn</a></li>
                        <li><a href="{{ route('partner-with-us', session('custom_lang')) }}">Partner with us</a></li>
                    </ul>
                </div>
                <div class="col-sm-3">
                    <div class="news menu">
                        <h4>About</h4>  
                        <hr id="hr_border2">                      
                        <ul class="list">
                            <li><a href="{{ URL::to('login') }}">Log in</a></li>
                            <li><a href="{{ route('/business/subscribe', [session('custom_lang'),'package' => 'standard', 'yearly' => 'yearly']) }}">Free trial</a></li>
                            <li><a href="{{ route('aboutus', session('custom_lang')) }}">About us</a></li>
                            {{--<li><a href="{{ route('news', session('custom_lang')) }}">News & media</a></li>--}}
                            <li><a href="{{ route('privacy', session('custom_lang')) }}">Privacy policy</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>
<div class="copyright font-open-sans">
    <div class="container" style="padding:5px;">        
        <p style="line-height:10px;">{{ __('home.copyright') }} &copy; stafflife 2017</p>
    </div>
</div>
<a id="back-to-top" href="#" class="btn-primary btn-lg back-to-top" role="button" data-placement="left">
    <i class="livicon" data-name="arrow-circle-up" data-size="18" data-loop="true" data-c="#fff" data-hc="white"></i>
</a>
<script type="text/javascript" src="{{ asset('assets/js/frontend/lib.js') }}"></script>
@yield('footer_scripts')
<script type="text/javascript">jQuery(document).ready(function () {
        var locale_update_url = "<?php echo $locale_update_url; ?>";
        @if(strlen($locale_update_url)>0||!Session::has('autodetected_locale'))
        $.ajax({method: "POST", url: locale_update_url, data: {_token: '{{ csrf_token() }}'}}).done(function (msg) {
            location.reload();
            console.log("Locale was updated");
        });@endif});</script>
<script type="text/javascript" src="{{ asset('assets/js/frontend/jquery.appear.js') }}"></script>
<script>jQuery(document).ready(function () {
        if ($(".icon-section").is(":appeared")) {
            $("#choose-country2").hide();
            // $(".hide-home").hide()
        }
        $(window).bind("scroll", function () {
            if ($(".icon-section").is(":appeared")) {
                $("#choose-country2").hide();
                // $(".hide-home").hide()
            } else {
                $("#choose-country2").show();
                // $(".hide-home").show()
            }
        })
    });</script>
<script>var LHCChatOptions = {};
    LHCChatOptions.opt = {widget_height: 340, widget_width: 300, popup_height: 520, popup_width: 500};
    (function () {
        var b = document.createElement("script");
        b.type = "text/javascript";
        b.async = true;
        var c = (document.referrer) ? encodeURIComponent(document.referrer.substr(document.referrer.indexOf("://") + 1)) : "";
        var a = (document.location) ? encodeURIComponent(window.location.href.substring(window.location.protocol.length)) : "";
        b.src = "//dmmdev.com/lhctest/index.php/chat/getstatus/(click)/internal/(position)/bottom_right/(ma)/br/(hide_offline)/true/(top)/350/(units)/pixels/(leaveamessage)/true/(department)/2/(theme)/1?r=" + c + "&l=" + a;
        var d = document.getElementsByTagName("script")[0];
        d.parentNode.insertBefore(b, d)
    })();</script>
<script src="{{ asset('assets/js/frontend/jquery.sticky.js') }}"></script>
<script>$(document).ready(function () {
        $("#navbar-main").sticky({topSpacing: 0})
    });</script>

<script type="text/javascript" src="{{ asset('assets/js/frontend/jquery-eu-cookie-law-popup.js') }}"></script>

<script>
    $(document).ready(function () {
        $(window).scroll(function () {

            // console.log($(window).scrollTop());

            if ($(window).scrollTop() > 30) {
                $('#navbar-main').addClass('colorbgnav');
            }

            if ($(window).scrollTop() < 31) {
                $('#navbar-main').removeClass('colorbgnav');
            }
        });
    });
</script>
</body>
</html>