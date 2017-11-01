<?php $og = new OpenGraph(); 
$og->title('Contacts - StaffLife.com')
        ->image("")
        ->description("If you have further questions or would like to find out more about StaffLife, please send us an email, or get in touch by contacting one of our offices.")
        ->url();
?>
<!DOCTYPE html>
<html lang="en">
<head>
{!! $og->renderTags() !!}
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description"
          content="If you have further questions or would like to find out more about StaffLife, please send us an email, or get in touch by contacting one of our offices.">
    <link rel="shortcut icon" href="{{ asset('assets/images/favicon.png') }}" type="image/x-icon">
    <link rel="icon" href="{{ asset('assets/images/favicon.png') }}" type="image/x-icon">
    @if(env('APP_ENV') === 'prod')
        <script src='https://www.google.com/recaptcha/api.js'></script>
    @endif
</head>

@extends('layouts/defaultsecure')
{{-- Page title --}}
@section('title')
    Support
    @parent
@stop
{{-- page level styles --}}
@section('header_styles')
    <!--start of page level css-->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/frontend/faq.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/frontend/indexboth.css') }}">
    <!--end of page level css-->
    <style>
        body {
            margin-top: -20px !important;
            background-color: #ffffff;
        }
        .hometextbiga{text-align:center;font-size: 20px;font-weight: 400;line-height: 28px;color: #404040;margin-top:8px;}
        .hometextbigb{text-align:center;font-size: 20px;font-weight: 400;line-height: 28px;text-decoration:underline;}
        .makeorange{color: #ee6f00 !important;}

@media screen and (min-width:992px) {
    .form-group {
        max-width:302px;
        margin: 0 auto;
        margin-bottom: 15px;
    }
}

.input-lg {border-radius:0;}
    </style>
@stop

{{-- Page content --}}
@section('content')
    <!-- Container Section Start -->
    <div class="font-open-sans">
        <div class="jumbotext text-center">
            <h1>Contact</h1>
        </div>

        <!-- Form Section Start -->
        <section id="form">
            <div class="container marbottom" id="contact">
                <div class="row">

                    <!-- Address Section Start -->
                    <div class="col-md-4" id="joinStaffLife" style="margin-top:50px; padding-bottom:30px;">
                        <div class="onlybig">
                            @include('notifications')
                            <h4 class="text-center">Get in touch to see how your business can benefit from StaffLife.</h4>
                            <form class="contact" action="{{ route('thank-you', session('custom_lang')) }}" method="POST">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}"/>
                                <div class="form-group">
                                    <input type="text" name="contact-name" value="{{ old('contact-name') }}" class="form-control input-lg" placeholder="Name"
                                        required>
                                </div>
                                <div class="form-group">
                                    <input type="email" name="contact-email" value="{{ old('contact-email') }}" class="form-control input-lg"
                                        placeholder="Email" required>
                                </div>
                                <div class="form-group">
                                    <input type="tel" name="contact-tel" value="{{ old('contact-tel') }}" class="form-control input-lg"
                                        placeholder="Telephone (Optional)">
                                </div>
                                <div class="form-group">
                                    <textarea name="contact-msg" value="{{ old('contact-msg') }}" class="form-control input-lg no-resize resize_vertical"
                                            rows="6" placeholder="Comment" required></textarea>
                                </div>
                                <div style="text-align: center; width: 304px; margin: 0 auto; margin-bottom: 15px;">
                                @if(env('APP_ENV') === 'prod')
                                    <div class="g-recaptcha" data-sitekey="6Lc7HysUAAAAAOlCcl-i3O61eYztD9cMwxtEPkz4"></div>
                                @endif
                                </div>
                                <div class="input-group" style="width:100%;">
                                    <p style="text-align:center;">
                                        <button class="btn info text-center" type="submit" style="width:100%; max-width:302px;">Send message</button>
                                    </p>
                                    <!--<button class="btn btn-danger" type="reset">cancel</button>-->
                                </div>
                            </form>
                            <hr class="homehrb" style="width:302px !important;">
                            <!--<table width="100%">
                                <tr>
                                    <td colspan="2">
                                        <div class="text-center">
                                            <a class="btn successb" href="{{ route('/business/subscribe', [session('custom_lang'),'package' => 'standard', 'yearly' => 'monthly']) }}" style="color:#ffffff; margin-top:20px; margin-bottom:8px;">START MY FREE TRIAL</a>
                                            <p class="hometextbiga">14-day free trial. No credit card required.</p>
                                            <p class="hometextbigb" ><a class="makeorange" href="{{ route('pricing', session('custom_lang')) }}">See Plans and Pricing</a></p>
                                        </div>
                                    </td>
                                </tr>
                            </table>-->
                        </div>
                    </div>
                    <!-- //Address Section End -->


                    <!-- Contact form Section Start -->
                    <div class="col-md-8" style="padding-top:50px; padding-left:30px; padding-right:30px;">
                        <!-- NEW ROW -->
                        <div class="row">

                            <!-- South Africa -->
                            <div class="col-sm-6" style="margin-bottom:10px;">
                                <div style="background-color:#f4f4f4; background-size:cover; padding-top:20px; padding-bottom:20px; text-align:center;">
                                    <h4 style="text-align:center;">Johannesburg | South Africa</h4>
                                    <p style="line-height:20px; font-size:11px; margin-top:10px; text-align:center;">The
                                        Place, 1 Sandton Drive, Sandton <br/>
                                        <img class="alignnone wp-image-5305 size-full"
                                            src="{{ asset('assets/images/Very-Small-Pin.png') }}" height="12px"> <a
                                                href="https://www.google.co.za/maps/@-26.1093869,28.0492649,3a,75y,176.77h,96.32t/data=!3m6!1e1!3m4!1soRANW3baJv2_vRLE3XGMVA!2e0!7i13312!8i6656?hl=en"
                                                style="color:#666666; text-decoration:underline; font-size:12px;"
                                                target="_blank">View Map</a>
                                    </p>
                                    <!-- <p style="line-height:20px; text-align:center;">0861 476 984 </p> -->
                                    <a style="line-height:20px; text-align:center;" href="tel:0861-476-984">0861 476 984</a>
                                </div>
                            </div>

                            <!-- USA -->
                            <div class="col-sm-6" style="margin-bottom:10px;">
                                <div style="background-color:#f4f4f4; padding-top:20px; padding-bottom:20px; text-align:center;">
                                    <h4 style="text-align:center;">New York | USA</h4>
                                    <p style="line-height:20px; font-size:11px; margin-top:10px; text-align:center;">230
                                        Park Avenue, Manhattan<br/>
                                        <img class="alignnone wp-image-5305 size-full"
                                            src="{{ asset('assets/images/Very-Small-Pin.png') }}" height="12px">
                                        <a href="https://www.google.co.za/maps/@40.7550586,-73.9757107,3a,75y,201.6h,115.36t/data=!3m6!1e1!3m4!1stYKK00eEXFy2II53nE4pcw!2e0!7i13312!8i6656?hl=en"
                                        style="color:#666666; text-decoration:underline; font-size:12px;"
                                        target="_blank">View Map</a>
                                    </p>
                                    <!-- <p style="line-height:20px; text-align:center;">+1 716 222 0941</p> -->
                                    <a style="line-height:20px; text-align:center;" href="tel:+1-716-222-0941">+1 716 222 0941</a>
                                </div>
                            </div>

                        </div>


                        <!-- NEW ROW -->
                        <div class="row">
                            <!-- Canada -->
                            <div class="col-sm-6" style="margin-bottom:10px;">
                                <div style="background-color:#f4f4f4; padding-top:20px; padding-bottom:20px; text-align:center;">
                                    <h4 style="text-align:center;">Toronto | Canada</h4>
                                    <p style="line-height:20px; font-size:11px; margin-top:10px; text-align:center;">TD
                                        Canada Trust Tower, 161 Bay Street, 27th Floor <br/>
                                        <img class="alignnone wp-image-5305 size-full"
                                            src="{{ asset('assets/images/Very-Small-Pin.png') }}" height="12px"/>
                                        <a href="https://www.google.co.za/maps/@43.6455313,-79.3789353,3a,75y,8.02h,121.16t/data=!3m6!1e1!3m4!1sJO5C2WJljV6O4rF13kbjsw!2e0!7i13312!8i6656?hl=en"
                                        style="color:#666666; text-decoration:underline; font-size:12px;"
                                        target="_blank">View Map</a><br/></p>
                                    <!-- <p style="line-height:20px; text-align:center; text-align:center;">+1 778 806 1738</p> -->
                                    <a style="line-height:20px; text-align:center;" href="tel:+1-778-806-1738">+1 778 806 1738</a>
                                </div>
                            </div>

                            <!-- London -->
                            <div class="col-sm-6" style="margin-bottom:10px;">
                                <div style="background-color:#f4f4f4; padding-top:20px; padding-bottom:20px; text-align:center;">
                                    <h4 style="text-align:center;">London | UK</h4>
                                    <p style="line-height:20px; font-size:11px; margin-top:10px; text-align:center;">48
                                        Warwick Street, Soho <br/>
                                        <img class="alignnone wp-image-5305 size-full"
                                            src="{{ asset('assets/images/Very-Small-Pin.png') }}" height="12px">
                                        <a href="https://www.google.co.za/maps/@51.5105947,-0.1375157,3a,75y,307.09h,102.05t/data=!3m6!1e1!3m4!1ssFe3lDDjzBO4ESfe23svxw!2e0!7i13312!8i6656?hl=en"
                                        style="color:#666666; text-decoration:underline; font-size:12px;"
                                        target="_blank">View Map</a>
                                    </p>
                                    <!-- <p style="line-height:20px; text-align:center; text-align:center;">+44 203 514 8772</p> -->
                                    <a style="line-height:20px; text-align:center;" href="tel:+44-203-514-8772">+44 203 514 8772</a>
                                </div>
                            </div>

                        </div>


                        <!-- NEW ROW -->
                        <div class="row">

                            <!--Ireland -->
                            <div class="col-sm-6" style="margin-bottom:10px;">
                                <div style="background-color:#f4f4f4; padding-top:20px; padding-bottom:20px; text-align:center;">
                                    <h4 style="text-align:center;">Ireland</h4>
                                    <p style="line-height:20px; font-size:11px; margin-top:10px; text-align:center;">
                                        Circular Quay Centre, AMP Tower, 50 Bridge Street<br/>
                                        <img class="alignnone wp-image-5305 size-full"
                                            src="{{ asset('assets/images/Very-Small-Pin.png') }}" height="12px">
                                        <a href="https://www.google.co.za/maps/@-33.8633615,151.2120271,3a,75y,313.23h,110.25t/data=!3m6!1e1!3m4!1sJz4guTEjL8qPyKiJBG-yFw!2e0!7i13312!8i6656?hl=en"
                                        style="color:#666666; text-decoration:underline; font-size:12px;"
                                        target="_blank">View Map</a>
                                    </p>
                                    <!-- <p style="line-height:20px; text-align:center; text-align:center;">+353 1 526 6574 </p> -->
                                    <a style="line-height:20px; text-align:center;" href="tel:+353-1-526-6574">+353 1 526 6574</a>
                                </div>
                            </div>

                            <!--Australia -->
                            <div class="col-sm-6" style="margin-bottom:10px;">
                                <div style="background-color:#f4f4f4; padding-top:20px; padding-bottom:20px; text-align:center;">
                                    <h4 style="text-align:center;">Sydney | Australia</h4>
                                    <p style="line-height:20px; font-size:11px; margin-top:10px; text-align:center;">
                                        Circular Quay Centre, AMP Tower, 50 Bridge Street<br/>
                                        <img class="alignnone wp-image-5305 size-full"
                                            src="{{ asset('assets/images/Very-Small-Pin.png') }}" height="12px">
                                        <a href="https://www.google.co.za/maps/@-33.8633615,151.2120271,3a,75y,313.23h,110.25t/data=!3m6!1e1!3m4!1sJz4guTEjL8qPyKiJBG-yFw!2e0!7i13312!8i6656?hl=en"
                                        style="color:#666666; text-decoration:underline; font-size:12px;"
                                        target="_blank">View Map</a>
                                    </p>
                                    <!-- <p style="line-height:20px; text-align:center; text-align:center;">+61 2 8216 0848</p> -->
                                    <a style="line-height:20px; text-align:center;" href="tel:+61-2-8216-0848">+61 2 8216 0848</a>
                                </div>
                            </div>

                        </div>

                        <!-- NEW ROW -->
                        <div class="row">

                            <!-- International -->
                            <div class="col-sm-6" style="margin-bottom:10px;">
                                <div style="background-color:#f4f4f4; padding-top:20px; padding-bottom:20px; text-align:center;">
                                    <h4 style="text-align:center;">New Zealand</h4>
                                    <p style="line-height:20px; font-size:11px; margin-top:10px; text-align:center;">
                                        Circular Quay Centre, AMP Tower, 50 Bridge Street<br/>
                                        <img class="alignnone wp-image-5305 size-full"
                                            src="{{ asset('assets/images/Very-Small-Pin.png') }}" height="12px">
                                        <a href="https://www.google.co.za/maps/@-33.8633615,151.2120271,3a,75y,313.23h,110.25t/data=!3m6!1e1!3m4!1sJz4guTEjL8qPyKiJBG-yFw!2e0!7i13312!8i6656?hl=en"
                                        style="color:#666666; text-decoration:underline; font-size:12px;"
                                        target="_blank">View Map</a>
                                    </p>
                                    <!-- <p style="line-height:20px; text-align:center; text-align:center;">+64 9801 0730</p> -->
                                    <a style="line-height:20px; text-align:center;" href="tel:+64-9801-0730">+64 9801 0730</a>
                                </div>
                            </div>

                            <!-- New Zealand -->
                            <div class="col-sm-6" style="margin-bottom:10px;">
                                <div style="background-color:#f4f4f4; padding-top:20px; padding-bottom:20px; text-align:center;">
                                    <h4 style="text-align:center;">International</h4>
                                    <p style="line-height:20px; font-size:11px; margin-top:10px; text-align:center;">
                                        <br><br>
                                    </p>
                                    <!-- <p style="line-height:20px; text-align:center; text-align:center;">+27 10 590 3110</p> -->
                                    <a style="line-height:20px; text-align:center;" href="tel:+27-10-590-3110">+27 10 590 3110</a>
                                </div>
                            </div>

                        </div>
                    </div>
                    <!-- //Contact Form Section End -->
                </div>
            </div>
        </section>
    </div>
@stop

{{-- page level scripts --}}
@section('footer_scripts')
    @if (App::environment('prod'))
    <script type="text/javascript" src="{{ secure_asset('assets/js/frontend/faq.js') }}"></script>
    <script type="text/javascript" src="{{ secure_asset('assets/vendors/mixitup/jquery.mixitup.js') }}"></script>
    @else
        <script type="text/javascript" src="{{ asset('assets/js/frontend/faq.js') }}"></script>
        <script type="text/javascript" src="{{ asset('assets/vendors/mixitup/jquery.mixitup.js') }}"></script>
    @endif
    <script>
        $(document).ready(function () {
            $("#choose-country2").show();
            $(".hide-home").show();

            @if($nav_section == 'employer')
            $('#home').addClass("in active");
            $('#menu1').removeClass("in active");
            $('#employee_tab').removeClass('active');
            $('#employer_tab').addClass('active');
            @else
            $('#home').removeClass("in active");
            $('#menu1').addClass("in active");
            $('#employer_tab').removeClass('active');
            $('#employee_tab').addClass('active');
            @endif
        });

        $(document).ready(function () {
            $('.awesome-tooltip').tooltip({
                placement: 'left'
            });

            $(window).bind('scroll', function (e) {
                dotnavigation();
            });

            function dotnavigation() {

                var numSections = $('section').length;

                $('#dot-nav li a').removeClass('active').parent('li').removeClass('active');
                $('section').each(function (i, item) {
                    var ele = $(item), nextTop;

                    // console.log(ele.next().html());

                    if (typeof ele.next().offset() != "undefined") {
                        nextTop = ele.next().offset().top;
                    }
                    else {
                        nextTop = $(document).height();
                    }

                    if (ele.offset() !== null) {
                        thisTop = ele.offset().top - ((nextTop - ele.offset().top) / numSections);
                    }
                    else {
                        thisTop = 0;
                    }

                    var docTop = $(document).scrollTop();

                    if (docTop >= thisTop && (docTop < nextTop)) {
                        $('#dot-nav li').eq(i).addClass('active');
                    }
                });
            }

            /* get clicks working */
            $('#dot-nav li').click(function () {

                var id = $(this).find('a').attr("href"),
                    posi,
                    ele,
                    padding = 0;

                ele = $(id);
                posi = ($(ele).offset() || 0).top - padding;

                $('html, body').animate({scrollTop: posi}, 'slow');

                return false;
            });
            /* end dot nav */
        });
    </script>
@stop