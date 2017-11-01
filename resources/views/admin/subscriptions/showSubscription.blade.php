@extends('admin/layouts/default')

{{-- Page title --}}
@section('title')
    View User Details
    @parent
@stop

{{-- page level styles --}}
@section('header_styles')
    <link href="{{ asset('assets/vendors/jasny-bootstrap/css/jasny-bootstrap.css') }}" rel="stylesheet"/>
    <link href="{{ asset('assets/vendors/x-editable/css/bootstrap-editable.css') }}" rel="stylesheet"/>
    <link href="{{ asset('assets/css/pages/user_profile.css') }}" rel="stylesheet"/>
@stop


{{-- Page content --}}
@section('content')
    <section class="content-header">
        <!--section starts-->
        <h1>Country Details</h1>
        <ol class="breadcrumb">
            <li>
                <a href="{{ route('admin.dashboard') }}">
                    <i class="livicon" data-name="home" data-size="14" data-loop="true"></i>
                    Dashboard
                </a>
            </li>
            <li>
                <a href="#">Memberships</a>
            </li>
            <li class="active">Country Details</li>
        </ol>
    </section>
    <!--section ends-->
    <section class="content">
        <div class="row">
            <div class="col-lg-12">
                <ul class="nav  nav-tabs ">
                    <li class="active">
                        <a href="#tab1" data-toggle="tab">
                            <i class="livicon" data-name="user" data-size="16" data-c="#000" data-hc="#000" data-loop="true"></i>
                            Country Details</a>
                    </li>
                    <!--<li>
                        <a href="#tab2" data-toggle="tab">
                            <i class="livicon" data-name="key" data-size="16" data-loop="true" data-c="#000" data-hc="#000"></i>
                            Change Country Details</a>
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
                                        <h3 class="panel-title">

                                        </h3>

                                    </div>
                                    <div class="panel-body">
                                      
                                        <div class="col-md-8">
                                            <div class="panel-body">
                                                <div class="table-responsive">
                                                    <table class="table table-bordered table-striped" id="users">

                                                        <tr>
                                                            <td>Account Holder</td>
                                                            <td>
                                                                <p class="user_name_max">{{ $singleSubscription->account_name }}</p>
                                                            </td>

                                                        </tr>
                                                        <tr>
                                                            <td>Account Type</td>
                                                            <td>
                                                                <p class="user_name_max">{{ $singleSubscription->account_type }}</p>
                                                            </td>

                                                        </tr>
                                                        <tr>
                                                            <td>Email</td>
                                                            <td>
                                                                {{ $singleSubscription->account_email }}
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                Account Users
                                                            </td>
                                                            <td>
                                                                {{ $singleSubscription->account_users }}
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>Subscribed Category</td>
                                                            <td>
                                                                {{ $singleSubscription->subscribed_category }}
                                                            </td
                                                        </tr>
                                                        <tr>
                                                            <td>Membership Country</td>
                                                            <td>
                                                                {{ $singleSubscription->subscription_country }}
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>Account Balance</td>
                                                            <td>
                                                                {{ $singleSubscription->account_balance }}
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>Contracts Quantity</td>
                                                            <td>
                                                                {{ $singleSubscription->contracts_quantity }}
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>Reference</td>
                                                            <td>
                                                                {{ $singleSubscription->REFERENCE }}
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>Account Status</td>
                                                            <td>
                                                                {{ $singleSubscription->account_status }}
                                                            </td>
                                                        </tr>
                                                         <tr>
                                                            <td>Created on</td>
                                                            <td>
                                                                {{ $singleSubscription->created_at }}
                                                            </td>
                                                        </tr>
                                                    </table>

                                                   <a href="{{ URL::to('admin/subscriptions/allsubscriptions') }}"><button type="submit" class="btn btn-primary add_button">Back to All Memberships</button></a>

                                                </div>
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
                                <form class="form-horizontal">
                                    <div class="form-body">
                                        <div class="form-group">
                                            {{ csrf_field() }}
                                            <label for="inputpassword" class="col-md-3 control-label">
                                                Password
                                                <span class='require'>*</span>
                                            </label>
                                            <div class="col-md-9">
                                                <div class="input-group">
                                                            <span class="input-group-addon">
                                                                <i class="livicon" data-name="key" data-size="16" data-loop="true" data-c="#000" data-hc="#000"></i>
                                                            </span>
                                                    <input type="password" id="password" placeholder="Password"
                                                           class="form-control"/>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="inputnumber" class="col-md-3 control-label">
                                                Confirm Password
                                                <span class='require'>*</span>
                                            </label>
                                            <div class="col-md-9">
                                                <div class="input-group">
                                                            <span class="input-group-addon">
                                                                <i class="livicon" data-name="key" data-size="16" data-loop="true" data-c="#000" data-hc="#000"></i>
                                                            </span>
                                                    <input type="password" id="password-confirm" placeholder="Confirm Password"
                                                           class="form-control"/>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-actions">
                                        <div class="col-md-offset-3 col-md-9">
                                            <button type="submit" class="btn btn-primary" id="change-password">Submit
                                            </button>
                                            &nbsp;
                                            <input type="reset" class="btn btn-default hidden-xs" value="Reset"></div>
                                    </div>
                                </form>
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
    <!-- Bootstrap WYSIHTML5 -->
    <script  src="{{ asset('assets/vendors/jasny-bootstrap/js/jasny-bootstrap.js') }}" type="text/javascript"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            $('#change-password').click(function (e) {
                e.preventDefault();
                var check = false;
                var sendData = '_token=' + $("input[name='_token']").val() + '&password=' + $('#password').val() + '&password-confirm=' + $('#password-confirm').val();
                if ($('#password').val() === $('#password-confirm').val()) {
                    check = true;
                }
                if (check) {
                    $.ajax({
                        url: '{{ route('admin.passwordreset', $singleSubscription->id) }}',
                        type: "post",
                        data: sendData,
                        success: function (data) {
                            alert('password reset successful');
                        },
                        error: function (xhr, ajaxOptions, thrownError) {
                            alert('error in password reset');
                        }
                    });
                } else {
                    alert('password and password confirm does not match');
                }
            });
        });
    </script>
@stop
