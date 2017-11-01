@extends('admin/layouts/default')

{{-- Page title --}}
@section('title')
    Edit company | StaffLife
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
    </style>
@stop

{{-- Page content --}}
@section('content')
    <section class="content-header">
        <h1>Edit company</h1>
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
                                        <li class="active"><a href="{{ route('admin.members.view.company', $userid) }}">Company</a></li>
                                        <li><a href="{{ route('admin.members.edit.admins', $user->id) }}">Admins</a></li>
                                        <li><a href="{{ route('admin.members.edit.billing', $user->id) }}">Billing</a></li>
                                        <li><a href="{{ route('admin.members.edit.users', $user->id) }}">Users</a></li>
                                        <li><a href="{{ route('admin.members.view.stats', $user->id) }}">Stats</a></li>
                                        <li><a href="{{ route('admin.members.view.settings', $user->id) }}">Settings</a></li>

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
                                                <?php
                                                if (isset($paySubscription)) {
                                                    $paysub_acc = $paySubscription->acc;
                                                    $paysub_amt = $paySubscription->AMOUNT;
                                                } else {
                                                    $paysub_acc = '';
                                                    $paysub_amt = '';
                                                }
                                                ?>

                                                <form class="form-horizontal" role="form" method="post"
                                                      action="{{ route('admin.members.edit.company', $user->id) }}">
                                                    <fieldset>
                                                        <input type="hidden" name="_token" value="{{ csrf_token() }}"/>
                                                        {{--<legend>Company</legend>--}}
                                                        <div class="form-group">
                                                            <label class="col-md-4 control-label" for="acc">Acc
                                                                #</label>
                                                            <div class="col-md-4">
                                                                <input id="acc"
                                                                       name="paysubscription.acc"
                                                                       type="text"
                                                                       placeholder="" class="form-control input-md"
                                                                       value="{!! $user->acc_no !!}"
                                                                       disabled
                                                                />
                                                            </div>
                                                        </div>

                                                        <div class="form-group">
                                                            <label class="col-md-4 control-label"
                                                                   for="companyname">Name</label>
                                                            <div class="col-md-4">
                                                                <div class="row">
                                                                    <div class="col-sm-6" style="padding-left: 0px">
                                                                <input id="Name #"
                                                                       name="paysubscription.companyname"
                                                                       type="text"
                                                                       placeholder="CompanyName"
                                                                       class="form-control input-md"
                                                                       value="{!! old('user.companyname', $user->companyname) !!}"
                                                                       disabled
                                                                />
                                                                    </div>
                                                                    <div class="col-sm-6">
                                                                        <div class="row">
                                                                            <div class="col-sm-10" style="font-weight: 700">
                                                                        Company Verified:
                                                                        </div>
                                                                            <div class="col-sm-1" style="vertical-align: middle"> {!! Form::checkbox('company_verified', $verification_docs_status, $verification_docs_status == 0 ? false : true) !!}</div>
                                                                        </div>
                                                                        </div>
                                                                </div>
                                                                {{--<span class="help-block">Company name</span>--}}
                                                            </div>
                                                        </div>

                                                        {{--<div class="form-group">--}}
                                                        {{--<label class="col-md-4 control-label" for="country">Country</label>--}}
                                                        {{--<div class="col-md-4">--}}
                                                        {{--@include('admin.layouts.components.input.select_country')--}}
                                                        {{--</div>--}}
                                                        {{--</div>--}}

                                                        <div class="form-group">
                                                            <label class="col-md-4 control-label" for="contact_number">Telephone</label>
                                                            <div class="col-md-4">
                                                                <input class="form-control input-md"
                                                                       id="contact_number"
                                                                       name="contact_number"
                                                                       type="text"
                                                                       placeholder="Telephone"
                                                                       value="{!! old('user.contact_number', $user->contact_number) !!}"
                                                                       disabled
                                                                />
                                                            </div>
                                                        </div>

                                                        <div class="form-group">
                                                            <label class="col-md-4 control-label"
                                                                   for="email">Email</label>
                                                            <div class="col-md-4">
                                                                <input class="form-control input-md"
                                                                       type="text"
                                                                       id="email"
                                                                       name="user.email"
                                                                       placeholder="Email"
                                                                       value="{!! old('user.email', $user->email) !!}"
                                                                       disabled
                                                                />
                                                            </div>
                                                        </div>

                                                        <div class="form-group">
                                                            <label class="col-md-4 control-label" for="registration">Registration
                                                                #</label>
                                                            <div class="col-md-4">
                                                                <input id="registration"
                                                                       name="user.registration"
                                                                       type="text"
                                                                       placeholder="Registration"
                                                                       class="form-control input-md"
                                                                       value="{!! Carbon\Carbon::parse($user->created_at)->format('d M Y h:i') !!}"
                                                                       disabled
                                                                />
                                                            </div>
                                                        </div>

                                                        <div class="form-group">
                                                            <label class="col-md-4 control-label" for="pay_status">Status</label>
                                                            <div class="col-md-4">
                                                                <div class="input-group">
                                                                    <span class="input-group-addon">$</span>
                                                                    <input id="pay_status"
                                                                           name="pay_status"
                                                                           class="form-control"
                                                                           placeholder="Status"
                                                                           value="{!! old('pay_status', isset($paysub_amt) ? $paysub_amt : '') !!}"
                                                                           disabled
                                                                    />
                                                                </div>

                                                            </div>
                                                        </div>

                                                        <div class="form-group">
                                                            <label class="col-md-4 control-label"
                                                                   for="bio">Notes</label>
                                                            <div class="col-md-4">
                <textarea class="form-control"
                          id="bio"
                          name="bio">{!! old('user.bio', $user->bio) !!}</textarea>
                                                            </div>
                                                        </div>

                                                        <div class="form-group">
                                                            <label class="col-md-4 control-label" for="button1id">
                                                                {{--Action--}}
                                                            </label>
                                                            <div class="col-md-8 btn-group">
                                                                <button id="company_save" name="save"
                                                                        class="btn btn-success">Save
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </fieldset>
                                                </form>
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
