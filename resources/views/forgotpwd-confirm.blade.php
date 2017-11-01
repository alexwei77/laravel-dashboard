<!DOCTYPE html>
<html>
<head>
    {{--<meta charset="utf-8">--}}
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @if (App::environment('prod'))
        <meta http-equiv="Content-Security-Policy" content="default-src 'self'; script-src 'self' 'unsafe-inline' www.google-analytics.com www.googletagmanager.com; connect-src 'self'; img-src 'self' 'unsafe-inline' * data:; style-src 'self' 'unsafe-inline' fonts.googleapis.com; font-src 'self' 'unsafe-inline' fonts.gstatic.com fonts.googleapis.com data:; frame-src 'self' 'unsafe-inline' dmmdev.com;">
        <script>(function(b,m,h,a,g){b[a]=b[a]||[];b[a].push({"gtm.start":new Date().getTime(),event:"gtm.js"});var k=m.getElementsByTagName(h)[0],e=m.createElement(h),c=a!="dataLayer"?"&l="+a:"";e.async=true;e.src="https://www.googletagmanager.com/gtm.js?id="+g+c;k.parentNode.insertBefore(e,k)})(window,document,"script","dataLayer","GTM-K6GM83G");</script>    @endif
    <title>Forgot password | StaffLife</title>
    <!--global css starts-->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/bootstrap.min.css') }}">
    <link rel="shortcut icon" href="{{ asset('assets/images/favicon.png') }}" type="image/x-icon">
    <link rel="icon" href="{{ asset('assets/images/favicon.png') }}" type="image/x-icon">
    <!--end of global css-->
    <!--page level css starts-->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/frontend/forgot.css') }}">
    <link rel="shortcut icon" href="{{ asset('assets/images/favicon.png') }}" type="image/x-icon">
    <link rel="icon" href="{{ asset('assets/images/favicon.png') }}" type="image/x-icon">
    <!--end of page level css-->
</head>
<body>
@if (App::environment('prod'))
    <!-- Google Tag Manager (noscript) -->
    <noscript>
        <iframe src="https://www.googletagmanager.com/ns.html?id=GTM-K6GM83G" height="0" width="0" style="display:none;visibility:hidden"></iframe>
    </noscript>
    <!-- End Google Tag Manager (noscript) -->
@endif
<div class="container">
    <div class="row">
        <div class="box animation flipInX">
            <a href="{{ route('home', session('custom_lang')) }}">
            <img src="{{ asset('assets/images/logostaff.png') }}" alt="logo" class="img-responsive mar">
            </a>
            <h3 class="text-primary">Reset your Password</h3>
            <p>Enter your new password details</p>
            @include('notifications')
            <form action="{{ route('forgot-password-confirm',compact(['userId','passwordResetCode'])) }}" class="omb_loginForm"  autocomplete="off" method="POST">
                {!! Form::token() !!}
                <input type="password" class="form-control" name="password" placeholder="New Password">
                <span class="help-block">{{ $errors->first('password', ':message') }}</span>
                <input type="password" class="form-control" name="password_confirm" placeholder="Confirm New Password">
                <span class="help-block">{{ $errors->first('password_confirm', ':message') }}</span>

                <input type="submit" class="btn btn-block btn-primary" value="Submit to Reset Password" style="margin-top:10px; max-width: 356px">
            </form>
        </div>
    </div>
</div>
<!--global js starts-->
<script type="text/javascript" src="{{ asset('assets/js/jquery.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
<!--global js end-->
</body>
</html>
