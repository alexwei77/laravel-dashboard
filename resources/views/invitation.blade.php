@extends('admin/layouts/defaultx')

{{-- Page title --}}
@section('title')
    Add Admin
@stop

{{-- page level styles --}}
@section('header_styles')

     <link href="{{ asset('assets/vendors/jasny-bootstrap/css/jasny-bootstrap.css') }}" rel="stylesheet"/>
    <link href="{{ asset('assets/vendors/x-editable/css/bootstrap-editable.css') }}" rel="stylesheet"/>
    <link href="{{ asset('assets/css/pages/user_profile.css') }}" rel="stylesheet"/>

    <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendors/jasny-bootstrap/css/jasny-bootstrap.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendors/iCheck/css/minimal/blue.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendors/select2/css/select2.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendors/select2/css/select2-bootstrap.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendors/datetimepicker/css/bootstrap-datetimepicker.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/frontend/user_account.css') }}">

@stop

{{-- Page content --}}
@section('content')

<section class="content-header">
                <!--section starts-->
                <h1>Add admin</h1>
                <ol class="breadcrumb">
                    <li>
                        <a href="{{ route('dashboard') }}">
                            <i class="livicon" data-name="barchart" data-size="14" data-loop="true"></i>
                            Dashboard
                        </a>
                    </li>
                    <li>Admins</li>
                    <li class="active">Add admin</li>
                </ol>
            </section>
     
    <div class="container">
    
    <section class="content">
        <div class="row">
            <div class="col-lg-12">
                <ul class="nav  nav-tabs ">
                    <!--<li class="active">
                        <a href="#tab1" data-toggle="tab">
                            Generate Contract</a>
                    </li>-->
                    <!--<li>
                        <a href="#tab2" data-toggle="tab">
                            <i class="livicon" data-name="key" data-size="16" data-loop="true" data-c="#000" data-hc="#000"></i>
                            Change Password</a>
                    </li>-->
                    <!--<li>
                        <a href="{{ URL::to('admin/user_profile') }}" >
                            <i class="livicon" data-name="gift" data-size="16" data-loop="true" data-c="#000" data-hc="#000"></i>
                            Advanced User Profile</a>
                    </li>-->

                </ul>
                <div  class="tab-content mar-top">
                    <div id="tab1" class="tab-pane fade active in">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="panel">
                                    <div class="panel-heading">
                                        
                                    </div>
                                    <div class="panel-body">
                                        <div class="col-md-8">
                                            <div class="panel-body">
                                                 <form role="form" id="tryitForm" class="form-horizontal" enctype="multipart/form-data"
                              action="{{ route('invite') }}" method="POST">
                            <input type="hidden" name="_method" value="PUT">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            
                        
                        <div class="form-group {{ $errors->first('first_name', 'has-error') }}">
                        
                           <input type="text" class="form-control" id="first_name" name="first_name" placeholder="First Name" required>
                            {!! $errors->first('first_name', '<span class="help-block">:message</span>') !!}
                        </div>

                        <div class="form-group {{ $errors->first('last_name', 'has-error') }}">
                        
                           <input type="text" class="form-control" id="last_name" name="last_name" placeholder="Last Name" required>
                            {!! $errors->first('last_name', '<span class="help-block">:message</span>') !!}
                        </div>
                            
                       <div class="form-group {{ $errors->first('first_name', 'has-error') }}">
                        
                           <input type="email" class="form-control" id="email" name="email" placeholder="Email Address" required>
                            {!! $errors->first('email', '<span class="help-block">:message</span>') !!}
                        </div>
               

                            <div class="form-group">
                                <div class="col-lg-offset-2 col-lg-10">
                                    <button class="btn btn-primary" type="submit">Send Invitation</button>
                                </div>
                            </div>

                        </form>{{--{!!  Form::close()  !!}--}}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="tab2" class="tab-pane fade">
                        <div class="row">
                            <div class="col-md-12 pd-top">
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    </div>
@stop

{{-- page level scripts --}}
@section('footer_scripts')

    <script type="text/javascript" src="{{ asset('assets/vendors/moment/js/moment.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/vendors/jasny-bootstrap/js/jasny-bootstrap.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/vendors/iCheck/js/icheck.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/vendors/select2/js/select2.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/vendors/datetimepicker/js/bootstrap-datetimepicker.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/frontend/user_account.js') }}"></script>
   
    <script type="text/javascript">
       //$("#admins").addClass("active");
    </script>

@stop
