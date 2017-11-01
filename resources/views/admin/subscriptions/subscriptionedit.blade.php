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
    <link href="{{ asset('assets/vendors/iCheck/css/all.css') }}"  rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/pages/wizard.css') }}" rel="stylesheet">
    <!--end of page level css-->
@stop


{{-- Page content --}}
@section('content')
    <section class="content-header">
        <h1>Edit Membership</h1>
        <ol class="breadcrumb">
            <li>
                <a href="{{ route('admin.dashboard') }}">
                    <i class="livicon" data-name="home" data-size="14" data-color="#000"></i>
                    Dashboard
                </a>
            </li>
            <li>Memberships</li>
            <li class="active">Edit Membership</li>
        </ol>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h3 class="panel-title"> <i class="livicon" data-name="users" data-size="16" data-c="#fff" data-hc="#fff" data-loop="true"></i>
                            Editing Membership :
                        </h3>
                    <span class="pull-right clickable">
                        <i class="glyphicon glyphicon-chevron-up"></i>
                    </span>
                    </div>
                    <div class="panel-body">
                        <!--main content-->
                        <div class="row">

                            <div class="col-md-12">
                                <form id="subscriptionEdit" action="{{ action('SubscriptionsController@submitSubscriptionEdit', $id) }}"
                                      method="POST" id="wizard-validation" enctype="multipart/form-data" class="form-horizontal">
                                    <!-- CSRF Token -->
                                    <!--<input type="hidden" name="_method" value="PATCH"/>--><!--this is what has been causing problems!-->
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                                    <input type="hidden" name="id" value="<?php echo $id; ?>" />

                                    <div id="rootwizard">
                                        <ul>
                                            <li><a href="#tab1" data-toggle="tab">Page 1</a></li>
                                            <li><a href="#tab4" data-toggle="tab">Page 2</a></li>
                                        </ul>
                                        <div class="tab-content">
                                            <div class="tab-pane" id="tab1">
                                                <h2 class="hidden">&nbsp;</h2>

                                                <div class="form-group {{ $errors->first('account_name', 'has-error') }}">
                                                    <label for="first_name" class="col-sm-2 control-label">Account Holder</label>
                                                    <div class="col-sm-10">
                                                        <input id="account_name" name="account_name" type="text"
                                                               placeholder="Account Holder" class="form-control required"
                                                               value="{!! old('account_name', $singlesubscriptionedit->account_name) !!}"/>
                                                    </div>
                                                    {!! $errors->first('first_name', '<span class="help-block">:message</span>') !!}
                                                </div>

                                                <div class="form-group {{ $errors->first('account_type', 'has-error') }}">
                                                    <label for="account_type" class="col-sm-2 control-label">Account Type</label>
                                                    <div class="col-sm-10">
                                                        <input id="account_type" name="account_type" type="text" placeholder="Account Type"
                                                               class="form-control required"
                                                               value="{!! old('account_type', $singlesubscriptionedit->account_type) !!}"/>
                                                    </div>
                                                    {!! $errors->first('last_name', '<span class="help-block">:message</span>') !!}
                                                </div>

                                                <div class="form-group {{ $errors->first('account_email', 'has-error') }}">
                                                    <label for="account_email" class="col-sm-2 control-label">Account Email</label>
                                                    <div class="col-sm-10">
                                                        <input id="account_email" name="account_email" placeholder="Account Email" type="text"
                                                               class="form-control required email"
                                                               value="{!! old('account_email', $singlesubscriptionedit->account_email) !!}"/>
                                                    </div>
                                                    {!! $errors->first('email', '<span class="help-block">:message</span>') !!}
                                                </div>

                                                <div class="form-group {{ $errors->first('subscribed_category', 'has-error') }}">
                                                    <label for="subscribed_category" class="col-sm-2 control-label">Subscribed Category</label>
                                                    <div class="col-sm-10">
                                                        <input id="subscribed_category" name="subscribed_category" type="text" placeholder="Subscribed Category"
                                                               class="form-control" value="{!! old('subscribed_category', $singlesubscriptionedit->subscribed_category) !!}"/>
                                                    </div>
                                                    {!! $errors->first('password', '<span class="help-block">:message</span>') !!}
                                                </div>

                                                <div class="form-group {{ $errors->first('account_users', 'has-error') }}">
                                                    <label for="account_users" class="col-sm-2 control-label">Account Users</label>
                                                    <div class="col-sm-10">
                                                        <input id="account_users" name="account_users" type="text" placeholder="Currency Code"
                                                               class="form-control" value="{!! old('account_users', $singlesubscriptionedit->account_users) !!}"/>
                                                    </div>
                                                    {!! $errors->first('password', '<span class="help-block">:message</span>') !!}
                                                </div>

                                                <!--<div class="form-group {{ $errors->first('status', 'has-error') }}">
                                                    <label for="status" class="col-sm-2 control-label">Status </label>
                                                    <?php //$status = $singlecountryedit->country_name; ?>
                                                    <div class="col-sm-10">
                                                       <select id="status" class="form-control" title="" name="status">
                                                        <option value="" >
                                                             Select Status
                                                          </option>
                                                         <option value="active" >
                                                             active
                                                          </option>
                                                        <option value="inactive" >inactive
                                                        </option>

                                                     </select>
                                                    </div>
                                                    {!! $errors->first('password', '<span class="help-block">:message</span>') !!}
                                                </div>-->


                                            </div>
                                           
                                           
                                            <div class="tab-pane" id="tab4" disabled="disabled">
                                                <div class="form-group {{ $errors->first('contracts_quantity', 'has-error') }}">
                                                    <label for="contracts_quantity" class="col-sm-2 control-label">Contracts Quantity</label>
                                                    <div class="col-sm-10">
                                                        <input id="contracts_quantity" name="contracts_quantity" type="text" class="form-control"
                                                               value="{!! old('contracts_quantity', $singlesubscriptionedit->contracts_quantity) !!}"/>
                                                    </div>
                                                            {!! $errors->first('contracts_quantity', '<span class="help-block">:message</span>') !!}
                                                </div>

                                                <div class="form-group {{ $errors->first('subscription_country', 'has-error') }}">
                                                    <label for="subscription_country" class="col-sm-2 control-label">Membership Country</label>
                                                    <div class="col-sm-10">
                                                        <input id="subscription_country" name="subscription_country" type="text" class="form-control"
                                                               value="{!! old('subscription_country', $singlesubscriptionedit->subscription_country) !!}"/>
                                                    </div>
                                                            {!! $errors->first('subscription_country', '<span class="help-block">:message</span>') !!}
                                                </div>

                                                <div class="form-group {{ $errors->first('account_balance', 'has-error') }}">
                                                    <label for="account_balance" class="col-sm-2 control-label">Account Balance</label>
                                                    <div class="col-sm-10">
                                                        <input id="account_balance" name="account_balance" type="text" class="form-control"
                                                               value="{!! old('account_balance', $singlesubscriptionedit->account_balance) !!}"/>
                                                    </div>
                                                            {!! $errors->first('account_balance', '<span class="help-block">:message</span>') !!}
                                                </div>

                                                <div class="form-group {{ $errors->first('contracts_quantity', 'has-error') }}">
                                                    <label for="contracts_quantity" class="col-sm-2 control-label">Contracts</label>
                                                    <div class="col-sm-10">
                                                        <input id="contracts_quantity" name="contracts_quantity" type="text" class="form-control"
                                                               value="{!! old('contracts_quantity', $singlesubscriptionedit->contracts_quantity) !!}"/>
                                                    </div>
                                                            {!! $errors->first('contracts_quantity', '<span class="help-block">:message</span>') !!}
                                                </div>

                                                <div class="form-group {{ $errors->first('REFERENCE', 'has-error') }}">
                                                    <label for="REFERENCE" class="col-sm-2 control-label">Reference</label>
                                                    <div class="col-sm-10">
                                                        <input id="REFERENCE" name="REFERENCE" type="text" class="form-control"
                                                               value="{!! old('REFERENCE', $singlesubscriptionedit->REFERENCE) !!}"/>
                                                    </div>
                                                            {!! $errors->first('REFERENCE', '<span class="help-block">:message</span>') !!}
                                                </div>

                                                <div class="form-group {{ $errors->first('account_status', 'has-error') }}">
                                                    <label for="account_status" class="col-sm-2 control-label">Account Status</label>
                                                    <div class="col-sm-10">
                                                        <input id="account_status" name="account_status" type="text" class="form-control"
                                                               value="{!! old('account_status', $singlesubscriptionedit->account_status) !!}"/>
                                                    </div>
                                                            {!! $errors->first('account_status', '<span class="help-block">:message</span>') !!}
                                                </div>

                                                <div class="form-group {{ $errors->first('account_payment_status', 'has-error') }}">
                                                    <label for="account_payment_status" class="col-sm-2 control-label">Payment Status</label>
                                                    <div class="col-sm-10">
                                                        <input id="account_payment_status" name="account_payment_status" type="text" class="form-control"
                                                               value="{!! old('account_payment_status', $singlesubscriptionedit->account_payment_status) !!}"/>
                                                    </div>
                                                            {!! $errors->first('group', '<span class="help-block">:message</span>') !!}
                                                </div>

                                            </div>
                                          
                                            <ul class="pager wizard">
                                                <li class="previous"><a href="#">Previous</a></li>
                                                <li class="next"><a href="#">Next</a></li>
                                                <li class="next finish" style="display:none;"><a href="javascript:;">Finish</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <!--main content end-->
                    </div>
                </div>
            </div>
        </div>
        <!--row end-->
    </section>
@stop

{{-- page level scripts --}}
@section('footer_scripts')
    <script src="{{ asset('assets/vendors/moment/js/moment.min.js') }}" ></script>
    <script src="{{ asset('assets/vendors/iCheck/js/icheck.js') }}"></script>
    <script src="{{ asset('assets/vendors/jasny-bootstrap/js/jasny-bootstrap.js') }}"  type="text/javascript"></script>
    <script src="{{ asset('assets/vendors/select2/js/select2.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/vendors/bootstrapwizard/jquery.bootstrap.wizard.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/vendors/bootstrapvalidator/js/bootstrapValidator.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/vendors/datetimepicker/js/bootstrap-datetimepicker.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/js/pages/editsubscription.js') }}"></script>
@stop
