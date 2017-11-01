<?php $og = new OpenGraph(); 
$og->title('About-Us - StaffLife.com')
        ->image("")
        ->description("A world-first Employee Ethics & Performance Data Bureau, StaffLife prevents you from hiring the wrong people, and improves the efficiency of current employees.")
        ->url();
?>
<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/html">
<head>
{!! $og->renderTags() !!}
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="A world-first Employee Ethics & Performance Data Bureau, StaffLife prevents you from hiring the wrong people, and improves the efficiency of current employees.">
    <link rel="shortcut icon" href="{{ asset('assets/images/favicon.png') }}" type="image/x-icon">
    <link rel="icon" href="{{ asset('assets/images/favicon.png') }}" type="image/x-icon">
  @include('layouts/csp')
</head>

@extends('layouts/defaultboth')

{{-- Page title --}}
@section('title')
About us
@parent
@stop

{{-- page level styles --}}
@section('header_styles')
    <!--page level css starts-->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/frontend/indexboth.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/frontend/aboutus.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendors/animate/animate.min.css') }}"/>
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendors/owl_carousel/css/owl.carousel.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendors/owl_carousel/css/owl.theme.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendors/devicon/devicon.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendors/devicon/devicon-colors.css') }}">
    <!--end of page level css-->
@stop

<style>

p.faqtextsml {
    color: #000000;
}

body {
    margin-top:-20px !important;
}

@media screen and (min-width:768px) and (max-width:1024px) {
    .mobdesk {
        display:none;
    }
}

@media screen and (max-width:1024px) {
    .mobdesk2 {
        display:none;
    }
}

@media screen and (max-width:767px) {
    .ipd1 {
        display:none;
    }
}

@media screen and (min-width:1025px) {
    .ipd2 {
        display:none;
    }
}
</style>

{{-- Page content --}}
@section('content')
    <!-- Container Section Start -->
<div class="jumbotext text-center">
  <h1>Partner with us</h1>
</div>

<div>
    <div class="container mobdesk">
        <div class="row text-center" style="padding-top:20px;">
            
            <div class="col-sm-8" style="margin-left:15%">
                

                 <h4 style="padding-bottom:10px;" class="homeheadingb">StaffLife offers incredible value to HR companies and professionals across the globe.</h4>
                        
                                <p>Please complete the form below and our {{ strtolower(__("stafflife.authorized")) }} Partners team will get in touch with you.</p>

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
                                <input type="tel" name="contact-phone" value="{{ old('contact-phone') }}" class="form-control input-lg"
                                       placeholder="Phone" required>
                            </div>

                             <div class="radio">
                                        <label>
                                            <input type="radio" name="optionsRadiosInline" id="optionsRadiosInline1" value="company"><span class="check"></span>Company</label>
                                        <label>
                                            <input type="radio" name="optionsRadiosInline" id="optionsRadiosInline2" value="individual"><span class="check"></span>Individual</label>
                                    </div>
 
                            <div class="form-group">
                                <input type="text" name="contact-company-name" value="{{ old('contact-company-name') }}" class="form-control input-lg" placeholder="Company Name">
                            </div>

                            <div class="form-group">
                                <input type="text" name="contact-website" value="{{ old('contact-website') }}" class="form-control input-lg" placeholder="Website">
                            </div>

                             <div class="form-group">
                                <input type="text" name="contact-primary-service" value="{{ old('contact-primary-service') }}" class="form-control input-lg" placeholder="What is the primary service?" required>
                             </div>
                             
                             <div class="form-group">
                                <input type="text" name="contact-country" value="{{ old('contact-country') }}" class="form-control input-lg" placeholder="Country" required>
                              </div>

                             <div class="form-group">
                                <input type="text" name="contact-city" value="{{ old('contact-city') }}" class="form-control input-lg" placeholder="City" required>
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
                                    <button class="btn info text-center" type="submit" style="width:100%; max-width:302px;">Submit</button>
                                </p>
                                <!--<button class="btn btn-danger" type="reset">cancel</button>-->
                            </div>
                        </form>


            </div>
        </div>
    </div>


    <div class="container ipd1 ipd2">
        <div class="row">
            
           
        </div>
    </div>
</div>
</html>
@stop

{{-- page level scripts --}}
@section('footer_scripts')
    <!-- page level js starts-->
    <script type="text/javascript" src="{{ asset('assets/vendors/owl_carousel/js/owl.carousel.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/vendors/wow/js/wow.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/frontend/carousel.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/frontend/aboutus.js') }}"></script>
    <!--page level js ends-->
 
@stop
