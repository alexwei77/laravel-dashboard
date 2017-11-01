@extends('layouts/defaultboth')
{{-- Page title --}}
@section('title')
Thank you
@parent
@stop
{{-- page level styles --}}
@section('header_styles')
<!--page level css starts-->
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/frontend/tabbular.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/vendors/animate/animate.min.css') }}" />
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/frontend/jquery.circliful.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/vendors/owl_carousel/css/owl.carousel.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/vendors/owl_carousel/css/owl.theme.css') }}">
<!--end of page level css-->
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/frontend/shopping.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/font-awesome.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/frontend/price.css') }}">
<link href="{{ asset('assets/vendors/animate/animate.min.css') }}" rel="stylesheet" type="text/css"/>
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/frontend/indexboth.css') }}">
@stop
{{-- slider --}}
@section('top')
@stop
<link rel="shortcut icon" href="{{ asset('assets/images/favicon.png') }}" type="image/x-icon">
<link rel="icon" href="{{ asset('assets/images/favicon.png') }}" type="image/x-icon">
<style>
   .successb {
   background-color: #4CAF50;
   min-width: 200px;
   color: #ffffff;
   padding: 12px 28px 12px 28px !important;
   border-radius: 0 !important;
   border: 0px !important;
   font-size: 17px;
   }

body {
    margin-top:-20px !important;
}
</style>
{{-- content --}}
@section('content')
<div class="bgbighome">
<div class="caption">
   <h1 class="splashdesk">Thank You!</h1>
   <h1 class="splashmob">Thank You!</h1>
   <p>Thank you for getting in touch. We will get back to you as soon as possible.</p>
   <div class="text-center">
      <a class="btn success" href="{{ route('home') }}">Home</a>
   </div>
</div>
</div>
@stop
{{-- footer scripts --}}
@section('footer_scripts')
<!-- page level js starts-->
<script type="text/javascript" src="{{ asset('assets/js/frontend/jquery.circliful.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/vendors/wow/js/wow.min.js') }}" ></script>
<script type="text/javascript" src="{{ asset('assets/vendors/owl_carousel/js/owl.carousel.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/js/frontend/carousel.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/js/frontend/index.js') }}"></script>
<!--page level js ends-->
<script>
   $( document ).ready(function() {
     $("#choose-country2").show();
     $(".hide-home").show();
    });
   
</script>
@stop