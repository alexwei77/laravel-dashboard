@extends('admin/layouts/default')

{{-- Page title --}}
@section('title')
    Add Metric
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
            <li><a href="#">Metrics</a></li>
            <li class="active">Add new metric</li>
        </ol>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h3 class="panel-title">
                            <i class="livicon" data-name="user-add" data-size="18" data-c="#fff" data-hc="#fff" data-loop="true"></i>
                            Add new metric
                        </h3>
                                <span class="pull-right clickable">
                                    <i class="glyphicon glyphicon-chevron-up"></i>
                                </span>
                    </div>
                    <div class="panel-body">
                        <!--main content-->
                        <form id="addCountryPrice" action="{{ action('EmployeesController@metricstore') }}"
                              method="POST" enctype="multipart/form-data" class="form-horizontal">
                            <!-- CSRF Token -->
                            <input type="hidden" name="_token" value="{{ csrf_token() }}" />

                            <div id="rootwizard">
                                <ul>
                                    
                                </ul>
                                <div class="tab-content">
                                    
                                        <h2 class="hidden">&nbsp;</h2>
                                        <div class="form-group {{ $errors->first('name', 'has-error') }}">
                                            <label for="name" class="col-sm-2 control-label">Metric name*</label>
                                            <div class="col-sm-6">
                                                <input id="name" name="name" type="text"
                                                       placeholder="Metric name" class="form-control required"
                                                       value=""/>

                                                {!! $errors->first('name', '<span class="help-block">:message</span>') !!}
                                            </div>

                                        </div>

                                       <div class="form-group {{ $errors->first('metric_section', 'has-error') }}">
                                            <label for="metric_section" class="col-sm-2 control-label">Metric section*</label>
                                            <div class="col-sm-6">
                                                <input id="name" name="metric_section" type="text"
                                                       placeholder="Metric name" class="form-control required"
                                                       value=""/>

                                                {!! $errors->first('metric_section', '<span class="help-block">:message</span>') !!}
                                            </div>

                                        </div>

                                        <div class="form-group {{ $errors->first('fact_opinion', 'has-error') }}">
                                            <label for="fact_opinion" class="col-sm-2 control-label">Fact/Opinion*</label>
                                            <div class="col-sm-6">
                                                <input id="fact_opinion" name="fact_opinion" type="text"
                                                       placeholder="Metric name" class="form-control required"
                                                       value=""/>

                                                {!! $errors->first('fact_opinion', '<span class="help-block">:message</span>') !!}
                                            </div>

                                        </div>

                                        <div class="form-group {{ $errors->first('req_as_proof', 'has-error') }}">
                                            <label for="req_as_proof" class="col-sm-2 control-label">Docs required as proof*</label>
                                            <div class="col-sm-6">
                                                <input id="req_as_proof" name="req_as_proof" type="text"
                                                       placeholder="Metric name" class="form-control required"
                                                       value=""/>

                                                {!! $errors->first('req_as_proof', '<span class="help-block">:message</span>') !!}
                                            </div>

                                        </div>

                                        <div class="form-group {{ $errors->first('re_by', 'has-error') }}">
                                            <label for="name" class="col-sm-2 control-label">Docs provided by*</label>
                                            <div class="col-sm-6">
                                                <input id="re_by" name="re_by" type="text"
                                                       placeholder="Metric name" class="form-control required"
                                                       value=""/>

                                                {!! $errors->first('re_by', '<span class="help-block">:message</span>') !!}
                                            </div>

                                        </div>

                                        <div class="form-group {{ $errors->first('internal', 'has-error') }}">
                                            <label for="internal" class="col-sm-2 control-label">Internal*</label>
                                            <div class="col-sm-6">
                                                <input id="internal" name="internal" type="text"
                                                       placeholder="Metric name" class="form-control required"
                                                       value=""/>

                                                {!! $errors->first('internal', '<span class="help-block">:message</span>') !!}
                                            </div>

                                        </div>

                                        <div class="form-group {{ $errors->first('item', 'has-error') }}">
                                            <label for="item" class="col-sm-2 control-label">Item(cehckbox/radio/etc)*</label>
                                            <div class="col-sm-6">
                                                <input id="item" name="item" type="text"
                                                       placeholder="Metric name" class="form-control required"
                                                       value=""/>

                                                {!! $errors->first('item', '<span class="help-block">:message</span>') !!}
                                            </div>

                                        </div>

                                        <div class="form-group {{ $errors->first('description', 'has-error') }}">
                                            <label for="description" class="col-sm-2 control-label">Describe your experience*</label>
                                            <div class="col-sm-6">
                                                 <textarea id="description" placeholder="Describe your experience" name="description" rows="4" class="form-control required"></textarea>
                                                {!! $errors->first('description', '<span class="help-block">:message</span>') !!}
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
