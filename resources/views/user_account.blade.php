@extends('admin/layouts/defaultx')
{{-- Page title --}}
@section('title')
    My Account
    @parent
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
    <link rel="stylesheet" type="text/css"
          href="{{ asset('assets/vendors/datetimepicker/css/bootstrap-datetimepicker.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/frontend/user_account.css') }}">
@stop
{{-- Page content --}}
@section('content')
    <style>
        h3.text-primary {
            color: #4caf50;
        }

        h5, h3 {
            font-weight: bold;
        }

        h5{
             padding-left: 0px !important;
          }

          .form-horizontal .form-group {
                  margin-left: 0px;
          }
    </style>
    <section class="content-header">
        <!--section starts-->
        <h1>My account</h1>
        <ol class="breadcrumb">
            <li>
                <a href="{{ route('dashboard') }}">
                    <i class="livicon" data-name="barchart" data-size="14" data-loop="true"></i>
                    Dashboard
                </a>
            </li>
            <li class="active">My Account</li>
        </ol>
    </section>
    <!--section ends-->
    <section class="content">
        <div class="row">
            <div class="col-lg-12">
                <ul class="nav  nav-tabs ">
                    <li class="active">
                        <a href="#tab1" data-toggle="tab">
                            <i class="livicon"
                               data-name="user"
                               data-size="16"
                               data-c="#000"
                               data-hc="#000"
                               data-loop="true"></i>
                            User profile
                        </a>
                    </li>
                <!--<li>
               <a href="{{ URL::to('admin/user_profile') }}" >
                   <i class="livicon"
                        data-name="gift"
                        data-size="16"
                        data-loop="true"
                        data-c="#000" data-hc="#000"
                        ></i>
                   Advanced User Profile</a>
               </li>-->
                </ul>
                <div class="tab-content mar-top">
                    <div id="tab1" class="tab-pane fade active in">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="panel">
                                    <div class="panel-heading">
                                        <h3 class="text-primary" id="title">Subscription details</h3>
                                    </div>
                                </div>
                                <div class="panel-body">
                                    <div class="col-md-12 text-warning">
                                        <div class="col-md-12">
                                        <h5>
                                            {{$package->name}}
                                            - {{$subscriptionPackageData->sub_type ? 'Annual' : 'Monthly'}}
                                            <a href="{{ route('upgrade-downgrade') }}"
                                               class="btn btn-success"
                                            >Upgrade</a>
                                        </h5>
                                        </div>
                                        <div class="col-md-6">
                                            <h5>Employees</h5>
                                            <div>
                                                <b>{{$package->terms_forms - $subscriptionPackageData->employees_avail}}</b>
                                                used of <b>{{$package->terms_forms}}</b>
                                                available employees or candidates
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <h5>Admins</h5>
                                            <div>
                                                <b>{{$package->admins - $subscriptionPackageData->admins_avail}}</b>
                                                used of <b>{{$package->admins}}</b>
                                                available account admins
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <form role="form" id="tryitForm" class="form-horizontal"
                                  enctype="multipart/form-data"
                                  action="{{ route('my-account') }}" method="POST">
                                <input type="hidden" name="_method" value="PUT">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">

                                <div class="col-lg-12">
                                    <div class="panel">
                                        <div class="panel-heading">
                                            <h3 class="text-primary" id="title">Account Information</h3>
                                        </div>
                                    </div>
                                    <div class="panel-body">
                                        <div class="col-md-8">
                                            <div class="form-group {{ $errors->first('pic', 'has-error') }}">
                                                <label class="col-md-4 control-label">Logo:</label>
                                                <div class="col-md-8">
                                                    <div class="fileinput fileinput-new" data-provides="fileinput">
                                                        <div class="fileinput-new thumbnail"
                                                             style="max-width: 200px; max-height: 150px;">
                                                            @if($user->pic)
                                                                <img src="{{ $url }}"
                                                                     alt="img"
                                                                     class="img-responsive"/>
                                                            @else
                                                                <img src="{{ asset('assets/img/authors/avatar8.jpg') }}"
                                                                     alt="..."
                                                                     class="img-responsive"/>
                                                            @endif
                                                        </div>
                                                        <div class="fileinput-preview fileinput-exists thumbnail"
                                                             style="max-width: 200px; max-height: 150px;"></div>
                                                        <div>
                                                              <span class="btn btn-primary btn-file">
                                                              <span class="fileinput-new">Select image</span>
                                                              <span class="fileinput-exists">Change</span>
                                                              <input type="file" name="pic" id="pic"/>
                                                              </span>
                                                            <span class="btn btn-primary fileinput-exists"
                                                                  data-dismiss="fileinput">Remove</span>
                                                        </div>
                                                    </div>
                                                    <span class="help-block">{{ $errors->first('pic', ':message') }}</span>
                                                </div>
                                            </div>
                                            <div class="form-group {{ $errors->first('companyname', 'has-error') }}">
                                                <label class="col-lg-4 control-label">
                                                    Company Name:
                                                    <span class='require'>*</span>
                                                </label>
                                                <div class="col-lg-6">
                                                    <div class="input-group">
                                                        @if($isAdmin)
                                                            {{ $mainCompany->companyname }}
                                                        @else
                                                            <span class="input-group-addon">
                                                               <i class="livicon" data-name="user" data-size="16"
                                                                  data-loop="true"
                                                                  data-c="#418bca" data-hc="#418bca"></i>
                                                           </span>
                                                            <input type="text" placeholder=" " name="companyname"
                                                                   id="u-name"
                                                                   class="form-control"
                                                                   value="{!! old('companyname',$user->companyname) !!}">
                                                        @endif
                                                    </div>
                                                    <span class="help-block">{{ $errors->first('first_name', ':message') }}</span>
                                                </div>
                                            </div>
                                            <div class="form-group {{ $errors->first('first_name', 'has-error') }}">
                                                <label class="col-lg-4 control-label">
                                                    First Name:
                                                    <span class='require'>*</span>
                                                </label>
                                                <div class="col-lg-6">
                                                    <div class="input-group">
                                                       <span class="input-group-addon">
                                                       <i class="livicon" data-name="user" data-size="16"
                                                          data-loop="true"
                                                          data-c="#418bca" data-hc="#418bca"></i>
                                                       </span>
                                                        <input type="text" placeholder=" " name="first_name" id="u-name"
                                                               class="form-control"
                                                               value="{!! old('first_name',$user->first_name) !!}">
                                                    </div>
                                                    <span class="help-block">{{ $errors->first('first_name', ':message') }}</span>
                                                </div>
                                            </div>
                                            <div class="form-group {{ $errors->first('last_name', 'has-error') }}">
                                                <label class="col-lg-4 control-label">
                                                    Last Name:
                                                    <span class='require'>*</span>
                                                </label>
                                                <div class="col-lg-6">
                                                    <div class="input-group">
                                                       <span class="input-group-addon">
                                                       <i class="livicon" data-name="user" data-size="16"
                                                          data-loop="true"
                                                          data-c="#418bca" data-hc="#418bca"></i>
                                                       </span>
                                                        <input type="text" placeholder=" " name="last_name" id="u-name"
                                                               class="form-control"
                                                               value="{!! old('last_name',$user->last_name) !!}">
                                                    </div>
                                                    <span class="help-block">{{ $errors->first('last_name', ':message') }}</span>
                                                </div>
                                            </div>

                                        <!--<div class="form-group">
                                                 <label class="col-lg-2 control-label">Gender: </label>
                                                 <div class="col-lg-6">
                                                    <div class="radio">
                                                       <label>
                                                       <input type="radio" name="gender" value="male" @if($user->gender === "male") checked="checked" @endif />
                                                       Male
                                                       </label>
                                                    </div>
                                                    <div class="radio">
                                                       <label>
                                                       <input type="radio" name="gender" value="female" @if($user->gender === "female") checked="checked" @endif />
                                                       Female
                                                       </label>
                                                    </div>
                                                    <div class="radio">
                                                       <label>
                                                       <input type="radio" name="gender" value="other" @if($user->gender === "other") checked="checked" @endif />
                                                       Other
                                                       </label>
                                                    </div>
                                                 </div>
                                              </div>-->
                                            <div>
                                                <h3 class="text-primary" id="title">Contact Details: </h3>
                                            </div>
                                            <div class="form-group {{ $errors->first('email', 'has-error') }}">
                                                <label class="col-lg-4 control-label">
                                                    Email:
                                                    <span class='require'>*</span>
                                                </label>
                                                <div class="col-lg-6">
                                                    <div class="input-group">
                                                        <span class="input-group-addon">
                                                        <i class="livicon" data-name="mail" data-size="16"
                                                           data-loop="true"
                                                           data-c="#418bca" data-hc="#418bca"></i>
                                                        </span>
                                                        <input type="text" placeholder=" " id="email" name="email"
                                                               class="form-control"
                                                               value="{!! old('email',$user->email) !!}">
                                                    </div>
                                                    <span class="help-block">{{ $errors->first('email', ':message') }}</span>
                                                </div>
                                            </div>

                                            <div class="form-group {{ $errors->first('contact_number', 'has-error') }}">
                                                <label class="col-lg-4 control-label" for="city">Contact number:</label>
                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <input type="text" placeholder=" " id="city"
                                                               class="form-control" name="contact_number"
                                                               value="{!! old('contact_number',$user->contact_number) !!}"/>
                                                    </div>
                                                </div>
                                                <span class="help-block">{{ $errors->first('contact_number', ':message') }}</span>
                                            </div>

                                            <div class="form-group {{ $errors->first('website', 'has-error') }}">
                                                <label class="col-lg-4 control-label" for="city">Website:</label>
                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <input type="text" placeholder=" " id="city"
                                                               class="form-control" name="website"
                                                               value="{!! old('website',$user->website) !!}"/>
                                                    </div>
                                                </div>
                                                <span class="help-block">{{ $errors->first('website', ':message') }}</span>
                                            </div>

                                            <div class="form-group {{ $errors->first('address', 'has-error') }}">
                                                <label class="col-lg-4 control-label">
                                                    Address:
                                                </label>
                                                <div class="col-lg-6">
                                                     <textarea rows="5" cols="30" class="form-control resize_vertical"
                                                               id="add1"
                                                               name="address">{!! old('address',$user->address) !!}</textarea>
                                                </div>
                                                <span class="help-block">{{ $errors->first('address', ':message') }}</span>
                                            </div>
                                            <div class="form-group {{ $errors->first('country', 'has-error') }}">
                                                <label class="control-label  col-md-4">Select Country: </label>
                                                <div class="col-md-6">
                                                    {!! Form::select('country', $countries, $user->country,['class' => 'form-control select2', 'id' => 'countries']) !!}
                                                    <span class="help-block">{{ $errors->first('country', ':message') }}</span>
                                                </div>
                                            </div>
                                            <div class="form-group {{ $errors->first('state', 'has-error') }}">
                                                <label class="col-lg-4 control-label" for="state">State:</label>
                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <input type="text" placeholder=" " id="state"
                                                               class="form-control" name="state"
                                                               value="{!! old('state',$user->state) !!}"/>
                                                    </div>
                                                </div>
                                                <span class="help-block">{{ $errors->first('state', ':message') }}</span>
                                            </div>
                                            <div class="form-group {{ $errors->first('city', 'has-error') }}">
                                                <label class="col-lg-4 control-label" for="city">City:</label>
                                                <div class="col-lg-6">
                                                    <div class="form-group">

                                                        <input type="text" placeholder=" " id="city"
                                                               class="form-control" name="city"
                                                               value="{!! old('city',$user->city) !!}"/>
                                                    </div>
                                                </div>
                                                <span class="help-block">{{ $errors->first('city', ':message') }}</span>
                                            </div>
                                            <div class="form-group {{ $errors->first('postal', 'has-error') }}">
                                                <label class="col-lg-4 control-label" for="postal">Postal:</label>
                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <input type="text" placeholder=" " id="postal"
                                                               class="form-control"
                                                               name="postal"
                                                               value="{!! old('postal',$user->postal) !!}"/>
                                                    </div>
                                                    <span class="help-block">{{ $errors->first('postal', ':message') }}</span>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-12">
                                    <div class="panel">
                                        <div class="panel-heading">
                                            <h3 class="text-primary" id="title">Reset Password</h3>
                                        </div>
                                    </div>
                                    <div class="panel-body">
                                        <div class="col-md-8">
                                            <div class="form-group {{ $errors->first('password', 'has-error') }}">
                                                <label class="col-lg-4 control-label">
                                                    Password:
                                                    <span class='require'>*</span>
                                                </label>
                                                <div class="col-lg-6">
                                                    <div class="input-group">
                                                       <span class="input-group-addon">
                                                       <i class="livicon" data-name="key" data-size="16"
                                                          data-loop="true"
                                                          data-c="#418bca" data-hc="#418bca"></i>
                                                       </span>
                                                        <input type="password" name="password" placeholder=" "
                                                               id="pwd"
                                                               class="form-control">
                                                    </div>
                                                    <span class="help-block">{{ $errors->first('password', ':message') }}</span>
                                                </div>
                                            </div>
                                            <div class="form-group {{ $errors->first('password_confirm', 'has-error') }}">
                                                <label class="col-lg-4 control-label">
                                                    Confirm Password:
                                                    <span class='require'>*</span>
                                                </label>
                                                <div class="col-lg-6">
                                                    <div class="input-group">
                                                       <span class="input-group-addon">
                                                       <i class="livicon" data-name="key" data-size="16"
                                                          data-loop="true"
                                                          data-c="#418bca" data-hc="#418bca"></i>
                                                       </span>
                                                        <input type="password" name="password_confirm"
                                                               placeholder=" "
                                                               id="cpwd" class="form-control">
                                                    </div>
                                                    <span class="help-block">{{ $errors->first('password_confirm', ':message') }}</span>
                                                </div>
                                            </div>
                                        </div>

                                    {{--<div class="form-group {{ $errors->first('email', 'has-error') }}">--}}
                                    {{--<label class="col-lg-4 control-label" for="city">Email:</label>--}}
                                    {{--<div class="col-lg-6">--}}
                                    {{--<div class="form-group">--}}
                                    {{--<input type="text" placeholder=" " id="city" class="form-control" name="email"--}}
                                    {{--value="{!! old('email',$user->email) !!}"/>--}}
                                    {{--</div>--}}
                                    {{--</div>--}}
                                    {{--<span class="help-block">{{ $errors->first('email', ':message') }}</span>--}}
                                    {{--</div>--}}

                                    <!--<div class="form-group {{ $errors->first('dob', 'has-error') }}">
                                 <label class="col-lg-2 control-label">
                                 DOB:
                                 </label>
                                 <div class="col-lg-6">
                                    <div class="input-group">
                                       <span class="input-group-addon">
                                       <i class="livicon" data-name="calendar" data-size="16" data-loop="true" data-c="#418bca" data-hc="#418bca"></i>
                                       </span>
                                       {{--                                        @if($user->dob === "0000-00-00")--}}
                                    {{--                                            {!!  Form::text('dob', '', array('id' => 'datepicker','class' => 'form-control'))  !!}--}}
                                    @if($user->dob === '')
                                        {!!  Form::text('dob', null, array('id' => 'datepicker','class' => 'form-control'))  !!}
                                    @else
                                        {!!  Form::text('dob', old('dob',$user->dob), array('id' => 'datepicker','class' => 'form-control', 'data-date-format'=> 'YYYY-MM-DD'))  !!}
                                    @endif
                                            </div>
                                            <span class="help-block">{{ $errors->first('dob', ':message') }}</span>
                                 </div>
                              </div>-->
                                        <div class="form-group">
                                            <div class="col-lg-offset-4 col-lg-10">
                                                <button class="btn btn-primary" type="submit">Save</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
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
                                    <i class="livicon" data-name="key" data-size="16" data-loop="true" data-c="#000"
                                       data-hc="#000"></i>
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
                                    <i class="livicon" data-name="key" data-size="16" data-loop="true" data-c="#000"
                                       data-hc="#000"></i>
                                    </span>
                                        <input type="password" id="password-confirm"
                                               placeholder="Confirm Password"
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
                                <input type="reset" class="btn btn-default hidden-xs" value="Reset">
                            </div>
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
    <script src="{{ asset('assets/vendors/jasny-bootstrap/js/jasny-bootstrap.js') }}" type="text/javascript"></script>
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
                        url: '{{ route('admin.passwordreset', $user->id) }}',
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

        $("#my-account").addClass("active");
    </script>
    <script type="text/javascript" src="{{ asset('assets/vendors/moment/js/moment.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/vendors/jasny-bootstrap/js/jasny-bootstrap.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/vendors/iCheck/js/icheck.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/vendors/select2/js/select2.js') }}"></script>
    <script type="text/javascript"
            src="{{ asset('assets/vendors/datetimepicker/js/bootstrap-datetimepicker.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/frontend/user_account.js') }}"></script>
@stop
