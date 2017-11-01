@extends('layouts/defaultx')

{{-- Page title --}}
@section('title')
Register

@stop

{{-- page level styles --}}
@section('header_styles')
     <!--global css starts-->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/bootstrap.min.css') }}">
    <link rel="shortcut icon" href="{{ asset('assets/images/favicon.png') }}" type="image/x-icon">
    <link rel="icon" href="{{ asset('assets/images/favicon.png') }}" type="image/x-icon">
    <!--end of global css-->
    <!--page level css starts-->
    <link type="text/css" rel="stylesheet" href="{{asset('assets/vendors/iCheck/css/all.css')}}" />
    <link href="{{ asset('assets/vendors/bootstrapvalidator/css/bootstrapValidator.min.css') }}" rel="stylesheet"/>
    
    <!--end of page level css-->

    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/frontend/cart.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/font-awesome.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/frontend/tabbular.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendors/bootstrap-rating/bootstrap-rating.css') }}">

   <style>
     .navbar-default{
         background-color: #fff;
         border-color: #fff;
     }
     .breadcrumb{
         background-color: #DBD6D6;
     }
    </style>
@stop

{{-- breadcrumb --}}
@section('top')
<div class="breadcum">
        <div class="container">

            <ol class="breadcrumb">
                <li>
                    <a href="{{ route('home') }}"> <i class="livicon icon3 icon4" data-name="home" data-size="18" data-loop="true" data-c="#3d3d3d" data-hc="#3d3d3d"></i>Home
                    </a>
                </li>
                <li class="hidden-xs">
                    <i class="livicon icon3" data-name="angle-double-right" data-size="18" data-loop="true" data-c="#4caf50" data-hc="#4caf50"></i>
                    <a href="#">Forgot Password Confirm</a>
                </li>
            </ol>
            <div class="pull-right">
                <i class="livicon icon3" data-name="edit" data-size="20" data-loop="true" data-c="#3d3d3d" data-hc="#3d3d3d"></i> Forgot Password Confirm
            </div>
        </div>
    </div>
@stop
{{-- Page content --}}
@section('content')
    <div class="container">
      <div class="col-md-7">
        <div class="row vertical-offset-100">
            <div class=" col-xs-10 col-xs-offset-1 col-sm-6 col-sm-offset-3  col-md-5 col-md-offset-4 col-lg-4 col-lg-offset-4">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title text-center">Forgot Password</h3>
                    </div>
                    <div class="panel-body">
                        <form method="post" action="" class="form-horizontal">
                            <!-- CSRF Token -->
                            <input type="hidden" name="_token" value="{{ csrf_token() }}" />

                            <!-- New Password -->
                            <div class="form-group{{ $errors->first('password', ' has-error') }} col-sm-12">
                                <label for="password">@lang('auth/form.newpassword')</label>
                                <input type="password" name="password" id="password" value="{{ old('password') }}"
                                       class="form-control"/>
                                {{ $errors->first('password', '<span class="help-block">:message</span>') }}
                            </div>

                            <!-- Password Confirm -->
                            <div class="form-group{{ $errors->first('password_confirm', ' has-error') }} col-sm-12">
                                <label class="control-label" for="password_confirm">@lang('auth/form.confirmpassword')</label>
                                <input type="password" name="password_confirm" id="password_confirm"
                                       value="{{ old('password_confirm') }}" class="form-control"/>
                                {{ $errors->first('password_confirm', '<span class="help-block">:message</span>') }}
                            </div>

                            <!-- Form actions -->
                            <div class="form-group">
                                <div class="col-sm-12">
                                    <a class="btn" href="{{ route('admin.dashboard') }}">@lang('button.cancel')</a>

                                    <button type="submit" class="btn btn-info">@lang('button.submit')</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
          </div>
        </div>
      </div>
  @stop

{{-- page level scripts --}}
@section('footer_scripts')
<!--global js starts-->
<script type="text/javascript" src="{{ asset('assets/js/frontend/jquery.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/js/frontend/bootstrap.min.js') }}"></script>
<script src="{{ asset('assets/vendors/bootstrapvalidator/js/bootstrapValidator.min.js') }}" type="text/javascript"></script>
<script type="text/javascript" src="{{ asset('assets/vendors/iCheck/js/icheck.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/js/frontend/login_custom.js') }}"></script>
<!--global js end-->
@stop
