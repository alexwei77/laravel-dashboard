@extends('admin/layouts/default')

{{-- Page title --}}
@section('title')
    Edit User
    @parent
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
        <h1>Edit user</h1>
        <ol class="breadcrumb">
            <li>
                <a href="{{ route('admin.dashboard') }}">
                    <i class="livicon" data-name="home" data-size="14" data-color="#000"></i>
                    Dashboard
                </a>
            </li>
            <li>Users</li>
            <li class="active">Add New User</li>
        </ol>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="col-md-12">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <h3 class="panel-title">
                                <i class="livicon" data-name="users" data-size="16" data-c="#fff" data-hc="#fff"
                                   data-loop="true"></i>
                                Editing user :
                                <p class="user_name_max">{!! $user->first_name!!} {!! $user->last_name!!}</p>
                            </h3>
                            <span class="pull-right clickable">
                            <i class="glyphicon glyphicon-chevron-up"></i>
                        </span>
                        </div>
                        <div class="panel-body">
                            <!--main content-->
                            <div class="row">
                                <div class="tabbable">
                                    <ul class="nav nav-tabs" id="formtabs">
                                        <li><a href="{{ route('admin.members.edit.users', $user->id) }}" data-toggle="tab">Company</a></li>
                                        <li><a href="#tab_admins" data-toggle="tab">Admins</a></li>
                                        <li><a href="#tab_billing" data-toggle="tab">Billing</a></li>
                                        <li><a href="#tab_users" data-toggle="tab">Users</a></li>
                                        <li><a href="{{ route('admin.members.view.stats', $user->id) }}">Stats</a></li>
                                        <li><a href="{{ route('admin.members.view.settings', $user->id) }}">Settings</a></li>

                                        <!--
                                        <li><a href="#tab_user" data-toggle="tab">deprecated: User Profile</a></li>
                                        <li><a href="#tab_bio" data-toggle="tab">deprecated: Bio</a></li>
                                        <li><a href="#tab_address" data-toggle="tab">deprecated: Address</a></li>
                                        <li><a href="#tab_user_group" data-toggle="tab">deprecated: User Group</a></li>
                                        -->
                                    </ul>
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
