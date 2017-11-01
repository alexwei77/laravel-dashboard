@extends('admin/layouts/default')

{{-- Page title --}}
@section('title')
    Settings @parent
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
                                        <li><a href="{{ route('admin.members.view.company', $user->id) }}">Company</a></li>
                                        <li><a href="{{ route('admin.members.edit.admins', $user->id) }}">Admins</a></li>
                                        <li><a href="{{ route('admin.members.edit.billing', $user->id) }}">Billing</a></li>
                                        <li><a href="{{ route('admin.members.edit.users', $user->id) }}">Users</a></li>
                                        <li><a href="{{ route('admin.members.view.stats', $user->id) }}">Stats</a></li>
                                        <li class="active"><a href="{{ route('admin.members.view.settings', $user->id) }}" data-toggle="tab">Settings</a></li>

                                        <!--
                                        <li><a href="#tab_user" data-toggle="tab">deprecated: User Profile</a></li>
                                        <li><a href="#tab_bio" data-toggle="tab">deprecated: Bio</a></li>
                                        <li><a href="#tab_address" data-toggle="tab">deprecated: Address</a></li>
                                        <li><a href="#tab_user_group" data-toggle="tab">deprecated: User Group</a></li>
                                        -->
                                    </ul>
                                    <div class="row padding-30">
                                        <div class="tab-content">
                                            <div class="tab-pane active" id="tab_settings">
                                                <h2 class="hidden">&nbsp;</h2>
                                                <form class="form-horizontal" role="form" method="post"
                                                      action="{{ route('admin.members.edit.settings', $user->id) }}">
                                                    <fieldset>
                                                        <input type="hidden" name="_token" value="{{ csrf_token() }}"/>
                                                        {{--<legend>Company</legend>--}}
                                                        <div class="form-group">
                                                            <label class="col-md-4 control-label" for="acc">Billing currency</label>
                                                            <div class="col-md-4">
                                                                <input id="acc"
                                                                       name="sub_currencycode"
                                                                       type="text"
                                                                       placeholder="" class="form-control input-md"
                                                                       value="{!! old('sub_currencycode', $paySubscription->sub_currencycode) !!}"
                                                                       disabled
                                                                />
                                                            </div>
                                                        </div>

                                                        <div class="form-group">
                                                            <label class="col-md-4 control-label" for="acc">Reporting currency</label>
                                                            <div class="col-md-4">
                                                                <input id="acc"
                                                                       name="reportingCurrency"
                                                                       type="text"
                                                                       placeholder="" class="form-control input-md"
                                                                       value="{!! old('reportingCurrency', $reportingCurrency) !!}"
                                                                       disabled
                                                                />
                                                            </div>
                                                        </div>

                                                        <div class="form-group">
                                                            <label class="col-md-4 control-label" for="acc">Timezone</label>
                                                            <div class="col-md-4">
                                                                <select name="timezone" id="timezone" class="form-control">
                                                                    @foreach (timezone_identifiers_list() as $timezone)
                                                                        <option value="{{ $timezone }}"{{ $timezone == old('timezone') ? ' selected' : '' }}>{{ $timezone }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>

                                                        <div class="form-group">
                                                            <label class="col-md-4 control-label" for="acc">Superadmin email</label>
                                                            <div class="col-md-4">
                                                                <input id="acc"
                                                                       name="user.email"
                                                                       type="text"
                                                                       placeholder="" class="form-control input-md"
                                                                       value="{!! old('user.email', $user->email) !!}"
                                                                />
                                                            </div>
                                                        </div>

                                                        <div class="form-group">
                                                            <label class="col-md-4 control-label" for="superadmin_password">Superadmin password</label>
                                                            <div class="col-md-4">
                                                                <input id="superadmin_password"
                                                                       name="superadmin_password"
                                                                       type="password"
                                                                       placeholder="Superadmin Password" class="form-control input-md"
                                                                       value=""
                                                                />
                                                                <!--<a href="#" onClick="$('#superadmin_password').attr('type', 'text'); return false;">show password</a>-->
                                                            </div>
                                                        </div>

                                                        <div class="form-group">
                                                            <label class="col-md-4 control-label" for="acc">Company verified</label>
                                                            <div class="col-md-4">
                                                                @if($verify_status)<i class="fa fa-check"></i> Yes @else <i class="fa fa-times"></i> No @endif
                                                            </div>
                                                        </div>

                                                        <div class="form-group">
                                                            <label class="col-md-4 control-label" for="acc">Account manager</label>
                                                            <div class="col-md-4">
                                                                <input id="acc"
                                                                       name="account_manager"
                                                                       type="text"
                                                                       placeholder="" class="form-control input-md"
                                                                       value="{{ $account_manager }}"
                                                                />
                                                            </div>
                                                        </div>

                                                        <div class="form-group">
                                                            <label class="col-md-4 control-label" for="acc">Status</label>
                                                            <div class="col-md-4">
                                                                <select name="user_status" class="form-control">
                                                                    @if(isset($check_delete))
                                                                    <option value="1">Allowed</option>
                                                                    <option value="2" selected="selected">deleted</option>
                                                                    @else 
                                                                    <option value="1" selected="selected">Allowed</option>
                                                                    <option value="2">Deleted</option>
                                                                    @endif
                                                                </select>
                                                            </div>
                                                        </div>

                                                        <div class="form-group">
                                                            <label class="col-md-4 control-label" for="bio">Notes</label>
                                                            <div class="col-md-4">
                <textarea class="form-control"
                          id="bio"
                          name="notes"
                >{{ $notes }}</textarea>
                                                            </div>
                                                        </div>

                                                        <!-- Button (Double) -->
                                                        <div class="form-group">
                                                            <label class="col-md-4 control-label" for="button1id">
                                                                {{--Action--}}
                                                            </label>
                                                            <div class="col-md-8 btn-group">
                                                                <button id="company_save" name="save" class="btn btn-success">Save</button>
                                                                <button id="company_cancel" name="cancel" class="btn btn-default">Cancel</button>
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
@stop
