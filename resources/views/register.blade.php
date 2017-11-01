<!DOCTYPE html>
<html>
   <head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <title>{{ __('loginsignup.pagetitlelogin') }}</title>
      @if(env('APP_ENV') === 'prod')
      <meta http-equiv="Content-Security-Policy" content="default-src 'self'; script-src 'self' 'unsafe-inline' www.google-analytics.com www.googletagmanager.com; connect-src 'self'; img-src 'self' 'unsafe-inline' * data:; style-src 'self' 'unsafe-inline' fonts.googleapis.com; font-src 'self' 'unsafe-inline' fonts.gstatic.com fonts.googleapis.com data:; frame-src 'self' 'unsafe-inline' dmmdev.com;">
      <script>(function(b,m,h,a,g){b[a]=b[a]||[];b[a].push({"gtm.start":new Date().getTime(),event:"gtm.js"});var k=m.getElementsByTagName(h)[0],e=m.createElement(h),c=a!="dataLayer"?"&l="+a:"";e.async=true;e.src="https://www.googletagmanager.com/gtm.js?id="+g+c;k.parentNode.insertBefore(e,k)})(window,document,"script","dataLayer","GTM-K6GM83G");</script>
      @endif
      <!--global css starts-->
      @if (App::environment('prod'))
      <link rel="stylesheet" type="text/css" href="{{ secure_asset('assets/css/bootstrap.min.css') }}">
      <link rel="shortcut icon" href="{{ secure_asset('assets/images/favicon.png') }}" type="image/x-icon">
      <link rel="icon" href="{{ secure_asset('assets/images/favicon.png') }}" type="image/x-icon">
      @else
      <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/bootstrap.min.css') }}">
      <link rel="shortcut icon" href="{{ asset('assets/images/favicon.png') }}" type="image/x-icon">
      <link rel="icon" href="{{ asset('assets/images/favicon.png') }}" type="image/x-icon">
      @endif
      <!--end of global css-->
      <!--page level css starts-->
      @if (App::environment('prod'))
      <link type="text/css" rel="stylesheet" href="{{secure_asset('assets/vendors/iCheck/css/all.css')}}" />
      <link href="{{ secure_asset('assets/vendors/bootstrapvalidator/css/bootstrapValidator.min.css') }}" rel="stylesheet"/>
      <link rel="stylesheet" type="text/css" href="{{ secure_asset('assets/css/frontend/login.css') }}">
      @else
      <link type="text/css" rel="stylesheet" href="{{asset('assets/vendors/iCheck/css/all.css')}}" />
      <link href="{{ asset('assets/vendors/bootstrapvalidator/css/bootstrapValidator.min.css') }}" rel="stylesheet"/>
      <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/frontend/login.css') }}">
      @endif
      <!--end of page level css-->
   </head>
   <body>
      @if(env('APP_ENV') === 'prod')
      <!-- Google Tag Manager (noscript) -->
      <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-K6GM83G"
         height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
      <!-- End Google Tag Manager (noscript) -->
      @endif
      <div class="container">
         <!--Content Section Start -->
         <div class="row">
            <div class="box animation flipInX">
               <a href="{{ route('home', session('custom_lang')) }}">
               <img src="{{ asset('assets/images/logostaff.png') }}" alt="logo" class="img-responsive mar" style="margin-top:10px">
               </a>
               <h3 class="text-primary">Set Password</h3>
               <!-- Notifications -->
               @include('notifications')
               <form action="{{ route('register') }}" method="POST" id="reg_form">
                  <!-- CSRF Token -->
                  <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                  <div class="col-sm-12">
                     <div class="form-group {{ $errors->first('first_name', 'has-error') }}">
                        <label class="sr-only"> {{ __('loginsignup.accountadminfirstname') }}</label>
                        <input type="hidden" class="form-control" id="first_name" name="first_name" placeholder="{{ __('loginsignup.accountadminfirstname') }}"
                           value="{{ $firstname }}" >
                        {!! $errors->first('first_name', '<span class="help-block">:message</span>') !!}
                     </div>
                     <div class="form-group {{ $errors->first('last_name', 'has-error') }}">
                        <label class="sr-only"> {{ __('loginsignup.accountadminlastname') }}</label>
                        <input type="hidden" class="form-control" id="last_name" name="last_name" placeholder="{{ __('loginsignup.accountadminlastname') }}"
                           value="{{ $lastname }}" >
                        {!! $errors->first('last_name', '<span class="help-block">:message</span>') !!}
                     </div>
                     <div class="form-group {{ $errors->first('email', 'has-error') }}">
                        <label class="sr-only"> {{ __('loginsignup.signupemail') }}</label>
                        <input type="hidden" class="form-control" id="Email" name="email" placeholder="{{ __('loginsignup.signupemail') }}"
                           value="{{ $email }}" >
                        {!! $errors->first('email', '<span class="help-block">:message</span>') !!}
                     </div>
                     <div class="form-group {{ $errors->first('password', 'has-error') }}">
                        <label class="sr-only"> {{ __('loginsignup.password') }}</label>
                        <input type="password" class="form-control" id="Password1" name="password" placeholder="{{ __('loginsignup.password') }}">
                        {!! $errors->first('password', '<span class="help-block">:message</span>') !!}
                     </div>
                     <div class="form-group {{ $errors->first('password_confirm', 'has-error') }}">
                        <label class="sr-only"> {{ __('loginsignup.confirmpassword') }}</label>
                        <input type="password" class="form-control" id="Password2" name="password_confirm"
                           placeholder="{{ __('loginsignup.confirmpassword') }}">
                        {!! $errors->first('password_confirm', '<span class="help-block">:message</span>') !!}
                     </div>
                     <div class="checkbox">
                        <label>
                        <input type="checkbox" name="subscribed" >  {{ __('loginsignup.iaccept') }} <a href="{{ route('terms-and-conditions') }}"> {{ __('loginsignup.termsconditiontext') }}</a>
                        </label>
                     </div>
                  </div>
                  <button type="submit" class="btn btn-block btn-primary">Submit</button>
                  {{ __('loginsignup.alreadyhaveaccount') }} <a href="{{ route('login') }}"> {{ __('loginsignup.logintitle') }}</a>
               </form>
            </div>
         </div>
         <!-- //Content Section End -->
      </div>
      <!--global js starts-->
      <script type="text/javascript" src="{{ secure_asset('assets/js/jquery.min.js') }}"></script>
      <script type="text/javascript" src="{{ secure_asset('assets/js/bootstrap.min.js') }}"></script>
      <script src="{{ secure_asset('assets/vendors/bootstrapvalidator/js/bootstrapValidator.min.js') }}" type="text/javascript"></script>
      <script type="text/javascript" src="{{ secure_asset('assets/vendors/iCheck/js/icheck.js') }}"></script>
      <script type="text/javascript" src="{{ secure_asset('assets/js/frontend/register_custom.js') }}"></script>
      <!--global js end-->
   </body>
</html>