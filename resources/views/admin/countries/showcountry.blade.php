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
                                                            <td>Country Name</td>
                                                            <td>
                                                                <p class="user_name_max">{{ $singlecountry->country_name }}</p>
                                                            </td>

                                                        </tr>
                                                        <tr>
                                                            <td>Country Code</td>
                                                            <td>
                                                                <p class="user_name_max">{{ $singlecountry->country_code }}</p>
                                                            </td>

                                                        </tr>
                                                        <tr>
                                                            <td>Currency</td>
                                                            <td>
                                                                {{ $singlecountry->currency }}
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                Currency Code
                                                            </td>
                                                            <td>
                                                                {{ $singlecountry->currency_code }}
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>Standard Employees</td>
                                                            <td>
                                                                {{ $singlecountry->std_employees }}
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>Standard Base</td>
                                                            <td>
                                                                {{ $singlecountry->std_base }}
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>Standard Annual Payment Discount</td>
                                                            <td>
                                                                {{ $singlecountry->std_discount }}
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>Standard Terms Forms (Active & checks)</td>
                                                            <td>
                                                                {{ $singlecountry->std_terms }}
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>Standard Cost per employee or check</td>
                                                            <td>
                                                                {{ $singlecountry->std_cost_employee }}
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>Standard Support </td>
                                                            <td>
                                                                {{ $singlecountry->std_support }}
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>Standard Users(admins) </td>
                                                            <td>
                                                                {{ $singlecountry->std_users }}
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>Standard Price </td>
                                                            <td>
                                                                {{ $singlecountry->std_price }}
                                                            </td>
                                                        </tr>

                                                         <tr>
                                                            <td>Business Employees</td>
                                                            <td>
                                                                {{ $singlecountry->bn_employees }}
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>Business Base</td>
                                                            <td>
                                                                {{ $singlecountry->bn_base }}
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>Business Annual Payment Discount</td>
                                                            <td>
                                                                {{ $singlecountry->bn_discount }}
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>Business Terms Forms (Active & checks)</td>
                                                            <td>
                                                                {{ $singlecountry->bn_terms }}
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>Business Cost per employee or check</td>
                                                            <td>
                                                                {{ $singlecountry->bn_employee_cost }}
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>Business Support </td>
                                                            <td>
                                                                {{ $singlecountry->bn_support }}
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>Business Users(admins) </td>
                                                            <td>
                                                                {{ $singlecountry->bn_users }}
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>Business Price </td>
                                                            <td>
                                                                {{ $singlecountry->bn_price }}
                                                            </td>
                                                        </tr>

                                                         <tr>
                                                            <td>Professional Employees</td>
                                                            <td>
                                                                {{ $singlecountry->pro_employees }}
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>Professional Base</td>
                                                            <td>
                                                                {{ $singlecountry->pro_base }}
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>Professional Annual Payment Discount</td>
                                                            <td>
                                                                {{ $singlecountry->pro_discount }}
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>Professional Terms Forms (Active & checks)</td>
                                                            <td>
                                                                {{ $singlecountry->pro_terms }}
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>Professional Cost per employee or check</td>
                                                            <td>
                                                                {{ $singlecountry->pro_employee_cost }}
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>Professional Support </td>
                                                            <td>
                                                                {{ $singlecountry->pro_support }}
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>Professional Users(admins) </td>
                                                            <td>
                                                                {{ $singlecountry->pro_users }}
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>Professional Price </td>
                                                            <td>
                                                                {{ $singlecountry->pro_price }}
                                                            </td>
                                                        </tr>

                                                         <tr>
                                                            <td>Enterprise Employees</td>
                                                            <td>
                                                                {{ $singlecountry->ent_employees }}
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>Enterprise Base</td>
                                                            <td>
                                                                {{ $singlecountry->ent_base }}
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>Enterprise Annual Payment Discount</td>
                                                            <td>
                                                                {{ $singlecountry->ent_discount }}
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>Enterprise Terms Forms (Active & checks)</td>
                                                            <td>
                                                                {{ $singlecountry->ent_terms }}
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>Enterprise Cost per employee or check</td>
                                                            <td>
                                                                {{ $singlecountry->ent_employee_cost }}
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>Enterprise Support </td>
                                                            <td>
                                                                {{ $singlecountry->ent_support }}
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>Enterprise Users(admins) </td>
                                                            <td>
                                                                {{ $singlecountry->ent_users }}
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>Enterprise Price </td>
                                                            <td>
                                                                {{ $singlecountry->ent_price }}
                                                            </td>
                                                        </tr>

                                                         <tr>
                                                            <td>Elite Employees</td>
                                                            <td>
                                                                {{ $singlecountry->el_employees }}
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>Elite Base</td>
                                                            <td>
                                                                {{ $singlecountry->el_base }}
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>Elite Annual Payment Discount</td>
                                                            <td>
                                                                {{ $singlecountry->el_discount }}
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>Elite Terms Forms (Active & checks)</td>
                                                            <td>
                                                                {{ $singlecountry->el_terms }}
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>Elite Cost per employee or check</td>
                                                            <td>
                                                                {{ $singlecountry->el_employee_cost }}
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>Elite Support </td>
                                                            <td>
                                                                {{ $singlecountry->el_support }}
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>Elite Users(admins) </td>
                                                            <td>
                                                                {{ $singlecountry->el_users }}
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>Elite Price </td>
                                                            <td>
                                                                {{ $singlecountry->el_price }}
                                                            </td>
                                                        </tr>

                                                        <tr>
                                                            <td>Status </td>
                                                            <td>
                                                                {{ $singlecountry->status }}
                                                            </td>
                                                        </tr>
                                                    </table>

                                                   <a href="{{ URL::to('admin/subscriptions/allcountries') }}"><button type="submit" class="btn btn-primary add_button">Back to All Countries/Prices</button></a>

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
                        url: '{{ route('admin.passwordreset', $singlecountry->id) }}',
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
