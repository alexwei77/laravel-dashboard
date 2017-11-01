@extends('admin/layouts/default')

{{-- Page title --}}
@section('title')
    View Stats
@stop

{{-- page level styles --}}
@section('header_styles')
    <!--page level css -->
    <link href="{{ asset('assets/vendors/jasny-bootstrap/css/jasny-bootstrap.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendors/select2/css/select2.min.css') }}" type="text/css" rel="stylesheet">
    <link href="{{ asset('assets/vendors/select2/css/select2-bootstrap.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendors/datetimepicker/css/bootstrap-datetimepicker.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendors/iCheck/css/all.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('assets/css/pages/wizard.css') }}" rel="stylesheet">
    <!--end of page level css-->
    <style>
        {{-- @todo oto css --}}
        .padding-20 {
            padding: 20px;
        }

        .padding-30 {
            padding: 30px;
        }

        .padding-40 {
            padding: 40px;
        }

        .padding-50 {
            padding: 50px;
        }

        .input_datetime {
            width: 140px;
        }

        .row {
            padding: 2px 15px;
        }
    </style>
@stop

{{-- Page content --}}
@section('content')
    <section class="content-header">
        <h1>View Stats</h1>
        <ol class="breadcrumb">
            <li>
                <a href="{{ route('admin.dashboard') }}">
                    <i class="livicon" data-name="home" data-size="14" data-color="#000"></i>
                    Dashboard
                </a>
            </li>
            <li>Users</li>
            <li class="active">Edit Company</li>
        </ol>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="col-md-12">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            {{--<h3 class="panel-title">--}}
                            {{--<i class="livicon" data-name="users" data-size="16" data-c="#fff" data-hc="#fff"--}}
                            {{--data-loop="true"></i>--}}
                            {{--Editing user :--}}
                            {{--<p class="user_name_max">{!! $user->first_name!!} {!! $user->last_name!!}</p>--}}
                            {{--</h3>--}}
                            <span class="pull-right clickable">
                            <i class="glyphicon glyphicon-chevron-up"></i>
                        </span>
                        </div>
                        <div class="panel-body">
                            <!--main content-->
                            <div class="row">
                                <div class="tabbable">
                                    <ul class="nav nav-tabs" id="formtabs">
                                        <li><a href="{{ route('admin.members.view.company', $userid) }}">Company</a></li>
                                        <li><a href="{{ route('admin.members.edit.admins', $userid) }}">Admins</a></li>
                                        <li><a href="{{ route('admin.members.edit.billing', $userid) }}">Billing</a></li>
                                        <li><a href="{{ route('admin.members.edit.users', $userid) }}">Users</a></li>
                                        <li class="active"><a href="{{ route('admin.members.view.stats', $userid) }}">Stats</a>
                                        </li>
                                        <li><a href="{{ route('admin.members.view.settings', $userid) }}">Settings</a></li>

                                        <!--
                                        <li><a href="#tab_user" data-toggle="tab">deprecated: User Profile</a></li>
                                        <li><a href="#tab_bio" data-toggle="tab">deprecated: Bio</a></li>
                                        <li><a href="#tab_address" data-toggle="tab">deprecated: Address</a></li>
                                        <li><a href="#tab_user_group" data-toggle="tab">deprecated: User Group</a></li>
                                        -->
                                    </ul>
                                    <div class="row padding-30">
                                        <div class="tab-content">
                                            <div class="tab-pane active" id="tab_company">
                                                <h2 class="hidden">&nbsp;</h2>
                                                <fieldset>
                                                    {{--<legend>Stats</legend>--}}
                                                    @if  ($paySubscription->isActual())
                                                        <h3>Without Subscribe</h3>
                                                    @endif

                                                    @if  ($paySubscription->isActual() || env('APP_DEBUG'))
                                                        <div class="form-group">
                                                            <div class="row">
                                                            <label class="col-md-3 control-label" for="acc">Active
                                                                    users</label>
                                                                <div class="col-md-4" style="text-align: left">
                                                                    <input id="acc"
                                                                           name="paysubscription.employees_avail"
                                                                           type="number"
                                                                           placeholder="" class="form-control input-md"
                                                                           value="{{ $active_users }}"
                                                                           disabled
                                                                    />
                                                                </div>
                                                                <div class="col-md-9">&nbsp;</div>
                                                            </div>
                                                            <div class="row">
                                                            <label class="col-md-3 control-label" for="acc">Total
                                                                users</label>
                                                            <div class="col-md-4" style="text-align: left">
                                                                <input id="acc"
                                                                       name="paysubscription.employees"
                                                                       type="number"
                                                                       placeholder="" class="form-control input-md"
                                                                       value="{{ $total_users }}"
                                                                       disabled
                                                                />
                                                            </div>
                                                                <div class="col-md-9">&nbsp;</div>
                                                            </div>
                                                            <div class="row">
                                                            <label class="col-md-3 control-label" for="acc">Active
                                                                Admins</label>
                                                            <div class="col-md-4">
                                                                <input id="acc"
                                                                       name="paysubscription.quantity_admins"
                                                                       type="number"
                                                                       placeholder="" class="form-control input-md"
                                                                       value="{{ $active_admins }}"
                                                                       disabled
                                                                />
                                                            </div>
                                                            <div class="col-md-9">&nbsp;</div>
                                                            </div>
                                                            <div class="row">
                                                            <label class="col-md-3 control-label" for="companyname">Data
                                                                submitted users</label>
                                                            <div class="col-md-4">
                                                                <input id="Name #"
                                                                       name="paysubscription."
                                                                       type="text"
                                                                       placeholder="CompanyName"
                                                                       class="form-control input-md"
                                                                       value="{{ $scored_user_count }}"
                                                                       disabled
                                                                />
                                                                {{--<span class="help-block">Company name</span>--}}
                                                            </div>
                                                                <div class="col-md-9">&nbsp;</div>
                                                            </div>
                                                            <div class="row">
                                                            <label class="col-md-3 control-label" for="country">Total
                                                                items of data</label>
                                                            <div class="col-md-4">
                                                                <input id="Name #"
                                                                       name="paysubscription."
                                                                       type="text"
                                                                       placeholder="CompanyName"
                                                                       class="form-control input-md"
                                                                       value="{{ $total_items_of_data_captured }}"
                                                                       disabled
                                                                />
                                                                {{--<span class="help-block">Company name</span>--}}
                                                            </div>
                                                                <div class="col-md-9">&nbsp;</div>
                                                            </div>
                                                            <div class="row">
                                                            <label class="col-md-3 control-label" for="contact_number">Challenges</label>
                                                            <div class="col-md-4">
                                                                <input id="Name #"
                                                                       name="paysubscription."
                                                                       type="text"
                                                                       placeholder="CompanyName"
                                                                       class="form-control input-md"
                                                                       value="???"
                                                                       disabled
                                                                />
                                                                {{--<span class="help-block">Company name</span>--}}
                                                            </div>
                                                                <div class="col-md-9">&nbsp;</div>
                                                            </div>
                                                            <div class="row">
                                                            <label class="col-md-3 control-label" for="contact_number">Items
                                                                / Challenge ratio</label>
                                                            <div class="col-md-4">
                                                                <input id="Name #"
                                                                       name="paysubscription."
                                                                       type="text"
                                                                       placeholder="CompanyName"
                                                                       class="form-control input-md"
                                                                       value="???"
                                                                       disabled
                                                                />
                                                                {{--<span class="help-block">Company name</span>--}}
                                                            </div>
                                                                <div class="col-md-9">&nbsp;</div>
                                                            </div>
                                                            <div class="row">
                                                            <label class="col-md-3 control-label" for="contact_number">Users
                                                                / Challenge ratio</label>
                                                            <div class="col-md-4">
                                                                <input id="Name #"
                                                                       name="paysubscription."
                                                                       type="text"
                                                                       placeholder="CompanyName"
                                                                       class="form-control input-md"
                                                                       value="???"
                                                                       disabled
                                                                />
                                                                {{--<span class="help-block">Company name</span>--}}
                                                            </div>
                                                                <div class="col-md-9">&nbsp;</div>
                                                            </div>
                                                            <div class="row">
                                                            <label class="col-md-3 control-label" for="contact_number">Queries
                                                                to revenue ratio</label>
                                                            <div class="col-md-4">
                                                                <input id="Name #"
                                                                       name="paysubscription."
                                                                       type="text"
                                                                       placeholder="CompanyName"
                                                                       class="form-control input-md"
                                                                       value="???"
                                                                       disabled
                                                                />
                                                                {{--<span class="help-block">Company name</span>--}}
                                                            </div>
                                                            </div>
                                                            <div class="row">
                                                            <label class="col-md-3 control-label" for="contact_number">SLIPS
                                                                to active ratio</label>
                                                            <div class="col-md-4">
                                                                <input id="Name #"
                                                                       name="paysubscription."
                                                                       type="text"
                                                                       placeholder="CompanyName"
                                                                       class="form-control input-md"
                                                                       value="{{ $slips_to_active_ratio }}"
                                                                       disabled
                                                                />
                                                                {{--<span class="help-block">Company name</span>--}}
                                                            </div>
                                                                <div class="col-md-9">&nbsp;</div>
                                                            </div>
                                                        </div>
                                                    @endif
                                                </fieldset>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@stop

{{-- page level scripts --}}
@section('footer_scripts')

    <script src="{{ asset('assets/vendors/moment/js/moment.min.js') }}"></script>
    <script src="{{ asset('assets/vendors/iCheck/js/icheck.js') }}"></script>
    <script src="{{ asset('assets/vendors/jasny-bootstrap/js/jasny-bootstrap.js') }}"></script>
    <script src="{{ asset('assets/vendors/select2/js/select2.js') }}"></script>
    <script src="{{ asset('assets/vendors/bootstrapwizard/jquery.bootstrap.wizard.js') }}"></script>
    <script src="{{ asset('assets/vendors/bootstrapvalidator/js/bootstrapValidator.min.js') }}"></script>
    <script src="{{ asset('assets/vendors/datetimepicker/js/bootstrap-datetimepicker.min.js') }}"></script>
    <script src="{{ asset('assets/js/pages/edituser.js') }}"></script>
@stop
