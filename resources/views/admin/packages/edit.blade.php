@extends('admin/layouts/default')

{{-- Page title --}}
@section('title')
    Edit Packages
    @parent
@stop

{{-- page level styles --}}
@section('header_styles')
    <!--page level css -->
    <link href="{{ asset('assets/vendors/jasny-bootstrap/css/jasny-bootstrap.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendors/select2/css/select2.min.css') }}" type="text/css" rel="stylesheet">
    <link href="{{ asset('assets/vendors/select2/css/select2-bootstrap.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendors/datetimepicker/css/bootstrap-datetimepicker.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendors/iCheck/css/all.css') }}"  rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/pages/wizard.css') }}" rel="stylesheet">
    <!--end of page level css-->
@stop


{{-- Page content --}}
@section('content')
    <section class="content-header">
        
        <ol class="breadcrumb">
            <li>
                <a href="{{ route('admin.dashboard') }}">
                    <i class="livicon" data-name="home" data-size="14" data-color="#000"></i>
                    Dashboard
                </a>
            </li>
            <li><a href="#">Packages</a></li>
            <li class="active">Edit Package</li>
        </ol>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h3 class="panel-title">
                            <i class="livicon" data-name="user-add" data-size="18" data-c="#fff" data-hc="#fff" data-loop="true"></i>
                            Edit Package
                        </h3>
                                <span class="pull-right clickable">
                                    <i class="glyphicon glyphicon-chevron-up"></i>
                                </span>
                    </div>
                    <div class="panel-body">
                        <!--main content-->
                        <form id="addCountryPrice" action="{{ action('VouchersController@postCreatedVoucher') }}"
                              method="POST" enctype="multipart/form-data" class="form-horizontal">
                            <!-- CSRF Token -->
                            <input type="hidden" name="_token" value="{{ csrf_token() }}" />

                            <div id="rootwizard">
                                <ul>
                                    
                                </ul>
                                <div class="tab-content">
                                    
                                        <h2 class="hidden">&nbsp;</h2>
                                        <div class="form-group {{ $errors->first('first_name', 'has-error') }}">
                                            <label for="first_name" class="col-sm-2 control-label">Name </label>
                                            <div class="col-sm-6">
                                                <input id="first_name" name="first_name" type="text"
                                                       placeholder="Receiver's First Name" class="form-control required"
                                                       value="" required/>

                                                {!! $errors->first('first_name', '<span class="help-block">:message</span>') !!}
                                            </div>

                                        </div>

                                       <div class="form-group {{ $errors->first('last_name', 'has-error') }}">
                                            <label for="metric_section" class="col-sm-2 control-label">Yearly Price </label>
                                            <div class="col-sm-6">
                                                <input id="last_name" name="last_name" type="text"
                                                       placeholder="Receiver's Last Name" class="form-control required"
                                                       value="" required/>

                                                {!! $errors->first('last_name', '<span class="help-block">:message</span>') !!}
                                            </div>

                                        </div>

                                        <div class="form-group {{ $errors->first('email', 'has-error') }}">
                                            <label for="fact_opinion" class="col-sm-2 control-label">Monthly Price </label>
                                            <div class="col-sm-6">
                                                <input id="email" name="email" type="text"
                                                       placeholder="Receiver's Email" class="form-control required"
                                                       value="" required/>

                                                {!! $errors->first('email', '<span class="help-block">:message</span>') !!}
                                            </div>

                                        </div>

                                        <div class="form-group {{ $errors->first('percentage_discount', 'has-error') }}">
                                            <label for="percentage_discount" class="col-sm-2 control-label">Support </label>
                                            <div class="col-sm-6">
                                                <input id="percentage_discount" name="percentage_discount" type="text"
                                                       placeholder="Percentage Discount" class="form-control required"
                                                       value="" required/>

                                                {!! $errors->first('percentage_discount', '<span class="help-block">:message</span>') !!}
                                            </div>

                                        </div>

                                        <div class="form-group {{ $errors->first('redeem_by', 'has-error') }}">
                                            <label for="redeem_by" class="col-sm-2 control-label">Admins </label>
                                            <div class="col-sm-6">
                                                <input id="redeem_by" name="redeem_by" type="date"
                                                       placeholder="Redeem by" class="form-control required"
                                                       value="" required/>

                                                {!! $errors->first('redeem_by', '<span class="help-block">:message</span>') !!}
                                            </div>

                                        </div>

                                        <div class="form-group {{ $errors->first('redeem_by', 'has-error') }}">
                                            <label for="redeem_by" class="col-sm-2 control-label">Staff </label>
                                            <div class="col-sm-6">
                                                <input id="redeem_by" name="redeem_by" type="date"
                                                       placeholder="Redeem by" class="form-control required"
                                                       value="" required/>

                                                {!! $errors->first('redeem_by', '<span class="help-block">:message</span>') !!}
                                            </div>

                                        </div>

                                        <div class="form-group {{ $errors->first('redeem_by', 'has-error') }}">
                                            <label for="redeem_by" class="col-sm-2 control-label">Acocount Managers </label>
                                            <div class="col-sm-6">
                                                <input id="redeem_by" name="redeem_by" type="date"
                                                       placeholder="Redeem by" class="form-control required"
                                                       value="" required/>

                                                {!! $errors->first('redeem_by', '<span class="help-block">:message</span>') !!}
                                            </div>

                                        </div>

                                        <div class="form-group {{ $errors->first('country_name', 'has-error') }}">
                                        <label for="country_name" class="col-sm-2 control-label"></label>
                                           <div class="col-sm-6">
                                             <button type="submit" class="btn btn-primary" id="change-password">Submit
                                             </button>
                                            </div>
                                        </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!--row end-->
    </section>
@stop

{{-- page level scripts --}}
@section('footer_scripts')
    <script src="{{ asset('assets/vendors/iCheck/js/icheck.js') }}"></script>
    <script src="{{ asset('assets/vendors/moment/js/moment.min.js') }}" ></script>
    <script src="{{ asset('assets/vendors/jasny-bootstrap/js/jasny-bootstrap.js') }}"  type="text/javascript"></script>
    <script src="{{ asset('assets/vendors/select2/js/select2.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/vendors/bootstrapwizard/jquery.bootstrap.wizard.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/vendors/bootstrapvalidator/js/bootstrapValidator.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/vendors/datetimepicker/js/bootstrap-datetimepicker.min.js') }}" type="text/javascript"></script>
    <!--<script src="{{ asset('assets/js/pages/adduser.js') }}"></script>-->
    <script src="{{ asset('assets/js/pages/addcountryprice.js') }}"></script>
@stop
