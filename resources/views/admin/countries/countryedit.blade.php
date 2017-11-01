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
        <h1>Edit Country/Prices</h1>
        <ol class="breadcrumb">
            <li>
                <a href="{{ route('admin.dashboard') }}">
                    <i class="livicon" data-name="home" data-size="14" data-color="#000"></i>
                    Dashboard
                </a>
            </li>
            <li>All Countries/Prices</li>
            <li class="active">Edit Country/Prices</li>
        </ol>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h3 class="panel-title"> <i class="livicon" data-name="users" data-size="16" data-c="#fff" data-hc="#fff" data-loop="true"></i>
                            Editing Country/Prices : 
                        </h3>
                    <span class="pull-right clickable">
                        <i class="glyphicon glyphicon-chevron-up"></i>
                    </span>
                    </div>
                    <div class="panel-body">
                        <!--main content-->
                        <div class="row">

                            <div class="col-md-12">
                                <form id="countryEditForm" action="{{ action('SubscriptionsController@submitedit', $id) }}"
                                      method="POST" id="wizard-validation" enctype="multipart/form-data" class="form-horizontal">
                                    <!-- CSRF Token -->
                                    <!--<input type="hidden" name="_method" value="PATCH"/>--><!--this is what has been causing problems!-->
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                                    <input type="hidden" name="id" value="<?php echo $id; ?>" />

                                    <div id="rootwizard">
                                        <ul>
                                            <li><a href="#tab1" data-toggle="tab">Country Details</a></li>
                                            <li><a href="#tab2" data-toggle="tab">Standard Package</a></li>
                                            <li><a href="#tab3" data-toggle="tab">Business Package</a></li>
                                            <li><a href="#tab4" data-toggle="tab">Professional Package</a></li>
                                            <li><a href="#tab5" data-toggle="tab">Enterprise Package</a></li>
                                            <li><a href="#tab6" data-toggle="tab">Elite Package</a></li>
                                        </ul>
                                        <div class="tab-content">
                                            <div class="tab-pane" id="tab1">
                                                <h2 class="hidden">&nbsp;</h2>

                                                <div class="form-group {{ $errors->first('first_name', 'has-error') }}">
                                                    <label for="first_name" class="col-sm-2 control-label">Country Name *</label>
                                                    <div class="col-sm-10">
                                                        <input id="country_name" name="country_name" type="text"
                                                               placeholder="Country Name" class="form-control required"
                                                               value="{!! old('country_name', $singlecountryedit->country_name) !!}"/>
                                                    </div>
                                                    {!! $errors->first('first_name', '<span class="help-block">:message</span>') !!}
                                                </div>

                                                <div class="form-group {{ $errors->first('last_name', 'has-error') }}">
                                                    <label for="last_name" class="col-sm-2 control-label">Country Code *</label>
                                                    <div class="col-sm-10">
                                                        <input id="country_code" name="country_code" type="text" placeholder="Country Code"
                                                               class="form-control required"
                                                               value="{!! old('country_code', $singlecountryedit->country_code) !!}"/>
                                                    </div>
                                                    {!! $errors->first('last_name', '<span class="help-block">:message</span>') !!}
                                                </div>

                                                <div class="form-group {{ $errors->first('email', 'has-error') }}">
                                                    <label for="currency" class="col-sm-2 control-label">Currency *</label>
                                                    <div class="col-sm-10">
                                                        <input id="currency" name="currency" placeholder="Currency" type="text"
                                                               class="form-control required email"
                                                               value="{!! old('currency', $singlecountryedit->currency) !!}"/>
                                                    </div>
                                                    {!! $errors->first('email', '<span class="help-block">:message</span>') !!}
                                                </div>

                                                <div class="form-group {{ $errors->first('password', 'has-error') }}">
                                                    <label for="currency_code" class="col-sm-2 control-label">Currency Code </label>
                                                    <div class="col-sm-10">
                                                        <input id="currency_code" name="currency_code" type="text" placeholder="Currency Code"
                                                               class="form-control" value="{!! old('currency_code', $singlecountryedit->currency_code) !!}"/>
                                                    </div>
                                                    {!! $errors->first('password', '<span class="help-block">:message</span>') !!}
                                                </div>

                                                <div class="form-group {{ $errors->first('status', 'has-error') }}">
                                                    <label for="status" class="col-sm-2 control-label">Status </label>
                                                    <?php $status = $singlecountryedit->country_name; ?>
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
                                                </div>


                                            </div>
                                            <div class="tab-pane" id="tab2" disabled="disabled">
                                                <h2 class="hidden">&nbsp;</h2>
                                                <div class="form-group {{ $errors->first('std_employees', 'has-error') }}">
                                                    <label for="std_employees" class="col-sm-2 control-label">Standard Employees</label>
                                                    <div class="col-sm-10">
                                                        <input id="std_employees" name="std_employees" type="text" class="form-control" value="{!! old('std_employees', $singlecountryedit->std_employees) !!}"
                                                               placeholder="Standard Employees"/>
                                                    </div>
                                                    {!! $errors->first('std_employees', '<span class="help-block">:message</span>') !!}
                                                </div>
                                                <div class="form-group {{ $errors->first('std_base', 'has-error') }}">
                                                    <label for="std_base" class="col-sm-2 control-label">Standard Base</label>
                                                    <div class="col-sm-10">
                                                        <input id="std_base" name="std_base" type="text" class="form-control" value="{!! old('std_base', $singlecountryedit->std_base) !!}"
                                                               placeholder="Standard Base"/>
                                                    </div>
                                                    {!! $errors->first('std_base', '<span class="help-block">:message</span>') !!}
                                                </div>
                                                <div class="form-group {{ $errors->first('std_discount', 'has-error') }}">
                                                    <label for="std_discount" class="col-sm-2 control-label">Standard Annual Payment Discount</label>
                                                    <div class="col-sm-10">
                                                        <input id="std_discount" name="std_discount" type="text" class="form-control" value="{!! old('std_discount', $singlecountryedit->std_discount) !!}"
                                                               placeholder="Standard Annual Payment Discount"/>
                                                    </div>
                                                    {!! $errors->first('std_discount', '<span class="help-block">:message</span>') !!}
                                                </div>
                                                <div class="form-group {{ $errors->first('std_terms', 'has-error') }}">
                                                    <label for="std_terms" class="col-sm-2 control-label">Standard Terms Forms (Active & checks)</label>
                                                    <div class="col-sm-10">
                                                        <input id="std_terms" name="std_terms" type="text" class="form-control" value="{!! old('std_terms', $singlecountryedit->std_terms) !!}"
                                                               placeholder="Standard Terms Forms (Active & checks)"/>
                                                    </div>
                                                    {!! $errors->first('std_terms', '<span class="help-block">:message</span>') !!}
                                                </div>
                                                <div class="form-group {{ $errors->first('std_cost_employee', 'has-error') }}">
                                                    <label for="std_cost_employee" class="col-sm-2 control-label">Standard Cost per employee or check</label>
                                                    <div class="col-sm-10">
                                                        <input id="std_cost_employee" name="std_cost_employee" type="text" class="form-control" value="{!! old('std_cost_employee', $singlecountryedit->std_cost_employee) !!}"
                                                               placeholder="Standard Cost per employee or check"/>
                                                    </div>
                                                    {!! $errors->first('std_cost_employee', '<span class="help-block">:message</span>') !!}
                                                </div>
                                                <div class="form-group {{ $errors->first('std_support', 'has-error') }}">
                                                    <label for="std_support" class="col-sm-2 control-label">Standard Support</label>
                                                    <div class="col-sm-10">
                                                        <input id="std_support" name="std_support" type="text" class="form-control" value="{!! old('std_support', $singlecountryedit->std_support) !!}"
                                                               placeholder="Standard Support"/>
                                                    </div>
                                                    {!! $errors->first('std_support', '<span class="help-block">:message</span>') !!}
                                                </div>
                                                <div class="form-group {{ $errors->first('std_users', 'has-error') }}">
                                                    <label for="std_users" class="col-sm-2 control-label">Standard Users(admins)</label>
                                                    <div class="col-sm-10">
                                                        <input id="std_users" name="std_users" type="text" class="form-control" value="{!! old('std_users', $singlecountryedit->std_users) !!}"
                                                               placeholder="Standard Users(admins)"/>
                                                    </div>
                                                    {!! $errors->first('std_users', '<span class="help-block">:message</span>') !!}
                                                </div>
                                                <div class="form-group {{ $errors->first('std_price', 'has-error') }}">
                                                    <label for="std_price" class="col-sm-2 control-label">Standard Price</label>
                                                    <div class="col-sm-10">
                                                        <input id="std_price" name="std_price" type="text" class="form-control" value="{!! old('std_price', $singlecountryedit->std_price) !!}"
                                                               placeholder="Standard Price"/>
                                                    </div>
                                                    {!! $errors->first('std_price', '<span class="help-block">:message</span>') !!}
                                                </div>


                                            </div>
                                            <div class="tab-pane" id="tab3" disabled="disabled">
                                                <h2 class="hidden">&nbsp;</h2>
                                                <div class="form-group {{ $errors->first('bn_employees', 'has-error') }}">
                                                    <label for="bn_employees" class="col-sm-2 control-label">Business Employees</label>
                                                    <div class="col-sm-10">
                                                        <input id="bn_employees" name="bn_employees" type="text" class="form-control" value="{!! old('bn_employees', $singlecountryedit->bn_employees) !!}"
                                                               placeholder="Business Employees"/>
                                                    </div>
                                                    {!! $errors->first('bn_employees', '<span class="help-block">:message</span>') !!}
                                                </div>
                                                <div class="form-group {{ $errors->first('bn_base', 'has-error') }}">
                                                    <label for="std_base" class="col-sm-2 control-label">Business Base</label>
                                                    <div class="col-sm-10">
                                                        <input id="bn_base" name="bn_base" type="text" class="form-control" value="{!! old('bn_base', $singlecountryedit->bn_base) !!}"
                                                               placeholder="Business Base"/>
                                                    </div>
                                                    {!! $errors->first('bn_base', '<span class="help-block">:message</span>') !!}
                                                </div>
                                                <div class="form-group {{ $errors->first('bn_discount', 'has-error') }}">
                                                    <label for="bn_discount" class="col-sm-2 control-label">Business Annual Payment Discount</label>
                                                    <div class="col-sm-10">
                                                        <input id="bn_discount" name="bn_discount" type="text" class="form-control" value="{!! old('bn_discount', $singlecountryedit->bn_discount) !!}"
                                                               placeholder="Business Annual Payment Discount"/>
                                                    </div>
                                                    {!! $errors->first('bn_discount', '<span class="help-block">:message</span>') !!}
                                                </div>
                                                <div class="form-group {{ $errors->first('bn_terms', 'has-error') }}">
                                                    <label for="bn_terms" class="col-sm-2 control-label">Business Terms Forms (Active & checks)</label>
                                                    <div class="col-sm-10">
                                                        <input id="bn_terms" name="bn_terms" type="text" class="form-control" value="{!! old('bn_terms', $singlecountryedit->bn_terms) !!}"
                                                               placeholder="Business Terms Forms (Active & checks)"/>
                                                    </div>
                                                    {!! $errors->first('bn_terms', '<span class="help-block">:message</span>') !!}
                                                </div>
                                                <div class="form-group {{ $errors->first('bn_cost_employee', 'has-error') }}">
                                                    <label for="bn_cost_employee" class="col-sm-2 control-label">Business Cost per employee or check</label>
                                                    <div class="col-sm-10">
                                                        <input id="bn_cost_employee" name="bn_cost_employee" type="text" class="form-control" value="{!! old('std_cost_employee', $singlecountryedit->std_cost_employee) !!}"
                                                               placeholder="Business Cost per employee or check"/>
                                                    </div>
                                                    {!! $errors->first('bn_cost_employee', '<span class="help-block">:message</span>') !!}
                                                </div>
                                                <div class="form-group {{ $errors->first('bn_support', 'has-error') }}">
                                                    <label for="bn_support" class="col-sm-2 control-label">Business Support</label>
                                                    <div class="col-sm-10">
                                                        <input id="bn_support" name="bn_support" type="text" class="form-control" value="{!! old('bn_support', $singlecountryedit->bn_support) !!}"
                                                               placeholder="Business Support"/>
                                                    </div>
                                                    {!! $errors->first('bn_support', '<span class="help-block">:message</span>') !!}
                                                </div>
                                                <div class="form-group {{ $errors->first('bn_admins', 'has-error') }}">
                                                    <label for="bn_admins" class="col-sm-2 control-label">Business Users(admins)</label>
                                                    <div class="col-sm-10">
                                                        <input id="bn_admins" name="bn_admins" type="text" class="form-control" value="{!! old('bn_admins', $singlecountryedit->bn_users) !!}"
                                                               placeholder="Business Users(admins)"/>
                                                    </div>
                                                    {!! $errors->first('bn_admins', '<span class="help-block">:message</span>') !!}
                                                </div>
                                                <div class="form-group {{ $errors->first('bn_price', 'has-error') }}">
                                                    <label for="bn_price" class="col-sm-2 control-label">Business Price</label>
                                                    <div class="col-sm-10">
                                                        <input id="bn_price" name="bn_price" type="text" class="form-control" value="{!! old('bn_price', $singlecountryedit->bn_price) !!}"
                                                               placeholder="Business Price"/>
                                                    </div>
                                                    {!! $errors->first('bn_price', '<span class="help-block">:message</span>') !!}
                                                </div>

                    
                                            </div>
                                            <div class="tab-pane" id="tab4" disabled="disabled">
                                                <h2 class="hidden">&nbsp;</h2>
                                                <div class="form-group {{ $errors->first('pro_employees', 'has-error') }}">
                                                    <label for="pro_employees" class="col-sm-2 control-label">Professional Employees</label>
                                                    <div class="col-sm-10">
                                                        <input id="pro_employees" name="pro_employees" type="text" class="form-control" value="{!! old('pro_employees', $singlecountryedit->pro_employees) !!}"
                                                               placeholder="Standard Employees"/>
                                                    </div>
                                                    {!! $errors->first('pro_employees', '<span class="help-block">:message</span>') !!}
                                                </div>
                                                <div class="form-group {{ $errors->first('pro_base', 'has-error') }}">
                                                    <label for="pro_base" class="col-sm-2 control-label">Professional Base</label>
                                                    <div class="col-sm-10">
                                                        <input id="pro_base" name="pro_base" type="text" class="form-control" value="{!! old('pro_base', $singlecountryedit->pro_base) !!}"
                                                               placeholder="Standard Base"/>
                                                    </div>
                                                    {!! $errors->first('std_base', '<span class="help-block">:message</span>') !!}
                                                </div>
                                                <div class="form-group {{ $errors->first('pro_discount', 'has-error') }}">
                                                    <label for="pro_discount" class="col-sm-2 control-label">Professional Annual Payment Discount</label>
                                                    <div class="col-sm-10">
                                                        <input id="pro_discount" name="pro_discount" type="text" class="form-control" value="{!! old('pro_discount', $singlecountryedit->pro_discount) !!}"
                                                               placeholder="Standard Annual Payment Discount"/>
                                                    </div>
                                                    {!! $errors->first('pro_discount', '<span class="help-block">:message</span>') !!}
                                                </div>
                                                <div class="form-group {{ $errors->first('pro_terms', 'has-error') }}">
                                                    <label for="pro_terms" class="col-sm-2 control-label">Professional Terms Forms (Active & checks)</label>
                                                    <div class="col-sm-10">
                                                        <input id="pro_terms" name="pro_terms" type="text" class="form-control" value="{!! old('pro_terms', $singlecountryedit->pro_terms) !!}"
                                                               placeholder="Standard Terms Forms (Active & checks)"/>
                                                    </div>
                                                    {!! $errors->first('pro_terms', '<span class="help-block">:message</span>') !!}
                                                </div>
                                                <div class="form-group {{ $errors->first('pro_employee_cost', 'has-error') }}">
                                                    <label for="pro_employee_cost" class="col-sm-2 control-label">Professional Cost per employee or check</label>
                                                    <div class="col-sm-10">
                                                        <input id="pro_employee_cost" name="pro_employee_cost" type="text" class="form-control" value="{!! old('pro_employee_cost', $singlecountryedit->pro_employee_cost) !!}"
                                                               placeholder="Standard Cost per employee or check"/>
                                                    </div>
                                                    {!! $errors->first('pro_employee_cost', '<span class="help-block">:message</span>') !!}
                                                </div>
                                                <div class="form-group {{ $errors->first('pro_support', 'has-error') }}">
                                                    <label for="pro_support" class="col-sm-2 control-label">Professional Support</label>
                                                    <div class="col-sm-10">
                                                        <input id="pro_support" name="pro_support" type="text" class="form-control" value="{!! old('pro_support', $singlecountryedit->pro_support) !!}"
                                                               placeholder="Standard Support"/>
                                                    </div>
                                                    {!! $errors->first('pro_support', '<span class="help-block">:message</span>') !!}
                                                </div>
                                                <div class="form-group {{ $errors->first('pro_admins', 'has-error') }}">
                                                    <label for="pro_admins" class="col-sm-2 control-label">Professional Users(admins)</label>
                                                    <div class="col-sm-10">
                                                        <input id="pro_admins" name="pro_admins" type="text" class="form-control" value="{!! old('pro_users', $singlecountryedit->pro_users) !!}"
                                                               placeholder="Standard Users(admins)"/>
                                                    </div>
                                                    {!! $errors->first('pro_admins', '<span class="help-block">:message</span>') !!}
                                                </div>
                                                <div class="form-group {{ $errors->first('pro_price', 'has-error') }}">
                                                    <label for="pro_price" class="col-sm-2 control-label">Professional Price</label>
                                                    <div class="col-sm-10">
                                                        <input id="pro_price" name="pro_price" type="text" class="form-control" value="{!! old('pro_price', $singlecountryedit->pro_price) !!}"
                                                               placeholder="Standard Users(admins)"/>
                                                    </div>
                                                    {!! $errors->first('pro_price', '<span class="help-block">:message</span>') !!}
                                                </div>

                                            </div>

                                            <div class="tab-pane" id="tab5" disabled="disabled">
                                                <h2 class="hidden">&nbsp;</h2>
                                                <div class="form-group {{ $errors->first('ent_employees', 'has-error') }}">
                                                    <label for="ent_employees" class="col-sm-2 control-label">Enterprise Employees</label>
                                                    <div class="col-sm-10">
                                                        <input id="ent_employees" name="ent_employees" type="text" class="form-control" value="{!! old('ent_employees', $singlecountryedit->ent_employees) !!}"
                                                               placeholder="Enterprise Employees"/>
                                                    </div>
                                                    {!! $errors->first('ent_employees', '<span class="help-block">:message</span>') !!}
                                                </div>
                                                <div class="form-group {{ $errors->first('ent_base', 'has-error') }}">
                                                    <label for="ent_base" class="col-sm-2 control-label">Enterprise Base</label>
                                                    <div class="col-sm-10">
                                                        <input id="ent_base" name="ent_base" type="text" class="form-control" value="{!! old('ent_base', $singlecountryedit->ent_base) !!}"
                                                               placeholder="Enterprise Base"/>
                                                    </div>
                                                    {!! $errors->first('ent_base', '<span class="help-block">:message</span>') !!}
                                                </div>
                                                <div class="form-group {{ $errors->first('ent_discount', 'has-error') }}">
                                                    <label for="ent_discount" class="col-sm-2 control-label">Enterprise Annual Payment Discount</label>
                                                    <div class="col-sm-10">
                                                        <input id="ent_discount" name="ent_discount" type="text" class="form-control" value="{!! old('ent_discount', $singlecountryedit->ent_discount) !!}"
                                                               placeholder="Enterprise Annual Payment Discount"/>
                                                    </div>
                                                    {!! $errors->first('ent_discount', '<span class="help-block">:message</span>') !!}
                                                </div>
                                                <div class="form-group {{ $errors->first('ent_terms', 'has-error') }}">
                                                    <label for="ent_terms" class="col-sm-2 control-label">Enterprise Terms Forms (Active & checks)</label>
                                                    <div class="col-sm-10">
                                                        <input id="ent_terms" name="ent_terms" type="text" class="form-control" value="{!! old('ent_terms', $singlecountryedit->ent_terms) !!}"
                                                               placeholder="Enterprise Terms Forms (Active & checks)"/>
                                                    </div>
                                                    {!! $errors->first('ent_terms', '<span class="help-block">:message</span>') !!}
                                                </div>
                                                <div class="form-group {{ $errors->first('ent_employee_cost', 'has-error') }}">
                                                    <label for="ent_employee_cost" class="col-sm-2 control-label">Enterprise Cost per employee or check</label>
                                                    <div class="col-sm-10">
                                                        <input id="ent_employee_cost" name="ent_employee_cost" type="text" class="form-control" value="{!! old('ent_employee_cost', $singlecountryedit->ent_employee_cost) !!}"
                                                               placeholder="Enterprise Cost per employee or check"/>
                                                    </div>
                                                    {!! $errors->first('ent_employee_cost', '<span class="help-block">:message</span>') !!}
                                                </div>
                                                <div class="form-group {{ $errors->first('ent_support', 'has-error') }}">
                                                    <label for="ent_support" class="col-sm-2 control-label">Enterprise Support</label>
                                                    <div class="col-sm-10">
                                                        <input id="ent_support" name="ent_support" type="text" class="form-control" value="{!! old('ent_support', $singlecountryedit->ent_support) !!}"
                                                               placeholder="Enterprise Support"/>
                                                    </div>
                                                    {!! $errors->first('ent_support', '<span class="help-block">:message</span>') !!}
                                                </div>
                                                <div class="form-group {{ $errors->first('ent_admins', 'has-error') }}">
                                                    <label for="ent_admins" class="col-sm-2 control-label">Enterprise Users(admins)</label>
                                                    <div class="col-sm-10">
                                                        <input id="ent_admins" name="ent_admins" type="text" class="form-control" value="{!! old('ent_users', $singlecountryedit->ent_users) !!}"
                                                               placeholder="Enterprise Users(admins)"/>
                                                    </div>
                                                    {!! $errors->first('ent_admins', '<span class="help-block">:message</span>') !!}
                                                </div>
                                                <div class="form-group {{ $errors->first('ent_price', 'has-error') }}">
                                                    <label for="ent_price" class="col-sm-2 control-label">Enterprise Price</label>
                                                    <div class="col-sm-10">
                                                        <input id="ent_price" name="ent_price" type="text" class="form-control" value="{!! old('ent_price', $singlecountryedit->ent_price) !!}"
                                                               placeholder="Enterprise Users(admins)"/>
                                                    </div>
                                                    {!! $errors->first('ent_price', '<span class="help-block">:message</span>') !!}
                                                </div>

                                            </div>

                                            <div class="tab-pane" id="tab6" disabled="disabled">
                                                <h2 class="hidden">&nbsp;</h2>
                                                <div class="form-group {{ $errors->first('el_employees', 'has-error') }}">
                                                    <label for="el_employees" class="col-sm-2 control-label">Elite Employees</label>
                                                    <div class="col-sm-10">
                                                        <input id="el_employees" name="el_employees" type="text" class="form-control" value="{!! old('el_employees', $singlecountryedit->el_employees) !!}"
                                                               placeholder="Elite Employees"/>
                                                    </div>
                                                    {!! $errors->first('el_employees', '<span class="help-block">:message</span>') !!}
                                                </div>
                                                <div class="form-group {{ $errors->first('el_base', 'has-error') }}">
                                                    <label for="el_base" class="col-sm-2 control-label">Elite Base</label>
                                                    <div class="col-sm-10">
                                                        <input id="el_base" name="el_base" type="text" class="form-control" value="{!! old('el_base', $singlecountryedit->el_base) !!}"
                                                               placeholder="Elite Base"/>
                                                    </div>
                                                    {!! $errors->first('el_base', '<span class="help-block">:message</span>') !!}
                                                </div>
                                                <div class="form-group {{ $errors->first('el_discount', 'has-error') }}">
                                                    <label for="el_discount" class="col-sm-2 control-label">Elite Annual Payment Discount</label>
                                                    <div class="col-sm-10">
                                                        <input id="el_discount" name="el_discount" type="text" class="form-control" value="{!! old('el_discount', $singlecountryedit->el_discount) !!}"
                                                               placeholder="Elite Annual Payment Discount"/>
                                                    </div>
                                                    {!! $errors->first('el_discount', '<span class="help-block">:message</span>') !!}
                                                </div>
                                                <div class="form-group {{ $errors->first('el_terms', 'has-error') }}">
                                                    <label for="el_terms" class="col-sm-2 control-label">Elite Terms Forms (Active & checks)</label>
                                                    <div class="col-sm-10">
                                                        <input id="el_terms" name="el_terms" type="text" class="form-control" value="{!! old('el_terms', $singlecountryedit->el_terms) !!}"
                                                               placeholder="Elite Terms Forms (Active & checks)"/>
                                                    </div>
                                                    {!! $errors->first('el_terms', '<span class="help-block">:message</span>') !!}
                                                </div>
                                                <div class="form-group {{ $errors->first('el_employee_cost', 'has-error') }}">
                                                    <label for="el_employee_cost" class="col-sm-2 control-label">Elite Cost per employee or check</label>
                                                    <div class="col-sm-10">
                                                        <input id="el_employee_cost" name="el_employee_cost" type="text" class="form-control" value="{!! old('el_employee_cost', $singlecountryedit->el_employee_cost) !!}"
                                                               placeholder="Elite Cost per employee or check"/>
                                                    </div>
                                                    {!! $errors->first('el_employee_cost', '<span class="help-block">:message</span>') !!}
                                                </div>
                                                <div class="form-group {{ $errors->first('el_support', 'has-error') }}">
                                                    <label for="el_support" class="col-sm-2 control-label">Elite Support</label>
                                                    <div class="col-sm-10">
                                                        <input id="el_support" name="el_support" type="text" class="form-control" value="{!! old('el_support', $singlecountryedit->el_support) !!}"
                                                               placeholder="Elite Support"/>
                                                    </div>
                                                    {!! $errors->first('el_support', '<span class="help-block">:message</span>') !!}
                                                </div>
                                                <div class="form-group {{ $errors->first('el_admins', 'has-error') }}">
                                                    <label for="el_admins" class="col-sm-2 control-label">Elite Users(admins)</label>
                                                    <div class="col-sm-10">
                                                        <input id="el_admins" name="el_admins" type="text" class="form-control" value="{!! old('el_users', $singlecountryedit->el_users) !!}"
                                                               placeholder="Elite Users(admins)"/>
                                                    </div>
                                                    {!! $errors->first('el_admins', '<span class="help-block">:message</span>') !!}
                                                </div>
                                                <div class="form-group {{ $errors->first('el_price', 'has-error') }}">
                                                    <label for="el_price" class="col-sm-2 control-label">Elite Price</label>
                                                    <div class="col-sm-10">
                                                        <input id="el_price" name="el_price" type="text" class="form-control" value="{!! old('el_price', $singlecountryedit->el_price) !!}"
                                                               placeholder="Elite Users(admins)"/>
                                                    </div>
                                                    {!! $errors->first('el_price', '<span class="help-block">:message</span>') !!}
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
    <script src="{{ asset('assets/js/pages/editcountry.js') }}"></script>
@stop
