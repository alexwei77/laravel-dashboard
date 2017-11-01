<!DOCTYPE html>
<html>

<head>
    <title>Email Verification | StaffLife</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    @if (App::environment('prod'))
        <meta http-equiv="Content-Security-Policy" content="default-src 'self'; script-src 'self' 'unsafe-inline' www.google-analytics.com www.googletagmanager.com; connect-src 'self'; img-src 'self' 'unsafe-inline' * data:; style-src 'self' 'unsafe-inline' fonts.googleapis.com; font-src 'self' 'unsafe-inline' fonts.gstatic.com fonts.googleapis.com data:; frame-src 'self' 'unsafe-inline' dmmdev.com;">
        <script>(function(b,m,h,a,g){b[a]=b[a]||[];b[a].push({"gtm.start":new Date().getTime(),event:"gtm.js"});var k=m.getElementsByTagName(h)[0],e=m.createElement(h),c=a!="dataLayer"?"&l="+a:"";e.async=true;e.src="https://www.googletagmanager.com/gtm.js?id="+g+c;k.parentNode.insertBefore(e,k)})(window,document,"script","dataLayer","GTM-K6GM83G");</script>
    @endif
    <!-- global level css-->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/bootstrap.min.css') }}">
    <!-- end of globallevel css-->
    <!-- page level styles-->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/frontend/404.css') }}" />
    <!-- end of page level styles-->
    <!--page level css starts-->
<link rel="shortcut icon" href="{{ asset('assets/images/favicon.png') }}" type="image/x-icon">
<link rel="icon" href="{{ asset('assets/images/favicon.png') }}" type="image/x-icon">
<!--end of page level css-->
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/frontend/price.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/frontend/indexboth.css') }}">

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
    /*margin-top:-20px !important;*/
}
</style>

</head>

<body>
@if (App::environment('prod'))
    <!-- Google Tag Manager (noscript) -->
    <noscript>
        <iframe src="https://www.googletagmanager.com/ns.html?id=GTM-K6GM83G" height="0" width="0" style="display:none;visibility:hidden"></iframe>
    </noscript>
    <!-- End Google Tag Manager (noscript) -->
@endif
<div class="bgbighome">
<div class="caption">
   <h1 class="splashdesk" style="font-weight:400;">Email verification</h1>
   <h1 class="splashmob" style="font-weight:400; color:#666666;">Email verification</h1>
   <p style="color:#666666;">Please check your inbox/spam folder and click on the link before logging in.</p>
   <div class="text-center">
      <a class="btn info" href="{{ route('home') }}">Login</a>
      <a class="btn success" href="{{ route('token-regenerate') }}">Resend verification email</a>
   </div>
</div>
</div>
</body>
</html>