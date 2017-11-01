@extends('admin/layouts/default')

{{-- Page title --}}
@section('title')
    Add User
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
        <h1>Add New Country/Prices</h1>
        <ol class="breadcrumb">
            <li>
                <a href="{{ route('admin.dashboard') }}">
                    <i class="livicon" data-name="home" data-size="14" data-color="#000"></i>
                    Dashboard
                </a>
            </li>
            <li><a href="#"> memberships</a></li>
            <li class="active">Add New Country/Prices</li>
        </ol>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h3 class="panel-title">
                            <i class="livicon" data-name="user-add" data-size="18" data-c="#fff" data-hc="#fff" data-loop="true"></i>
                            Add New Country/Prices
                        </h3>
                                <span class="pull-right clickable">
                                    <i class="glyphicon glyphicon-chevron-up"></i>
                                </span>
                    </div>
                    <div class="panel-body">
                        <!--main content-->
                        <form id="addCountryPrice" action="{{ action('SubscriptionsController@submitprices') }}"
                              method="POST" enctype="multipart/form-data" class="form-horizontal">
                            <!-- CSRF Token -->
                            <input type="hidden" name="_token" value="{{ csrf_token() }}" />

                            <div id="rootwizard">
                                <ul>
                                    <li><a href="#tab1" data-toggle="tab">Country Details</a></li>
                                    <li><a href="#tab2" data-toggle="tab">Standard</a></li>
                                    <li><a href="#tab3" data-toggle="tab">Business</a></li>
                                    <li><a href="#tab4" data-toggle="tab">Professional</a></li>
                                    <li><a href="#tab5" data-toggle="tab">Enterprise</a></li>
                                    <li><a href="#tab6" data-toggle="tab">Elite</a></li>
                                </ul>
                                <div class="tab-content">
                                    <div class="tab-pane" id="tab1">
                                        <h2 class="hidden">&nbsp;</h2>
                                        <div class="form-group {{ $errors->first('country_name', 'has-error') }}">
                                            <label for="country_name" class="col-sm-2 control-label">Country Name *</label>
                                            <div class="col-sm-10">
                                                <input id="country_name" name="country_name" type="text"
                                                       placeholder="Country Name" class="form-control required"
                                                       value=""/>

                                                {!! $errors->first('country_name', '<span class="help-block">:message</span>') !!}
                                            </div>
                                        </div>

                                        <div class="form-group {{ $errors->first('country_code', 'has-error') }}">
                                            <label for="country_code" class="col-sm-2 control-label">Country Code *</label>
                                            <div class="col-sm-10">
                                                <input id="country_code" name="country_code" type="text" placeholder="Country Code"
                                                       class="form-control required" value="{!! old('country_code') !!}"/>

                                                {!! $errors->first('country_code', '<span class="help-block">:message</span>') !!}
                                            </div>
                                        </div>

                                        <div class="form-group {{ $errors->first('currency', 'has-error') }}">
                                            <label for="currency" class="col-sm-2 control-label">Currency *</label>
                                            <div class="col-sm-10">
                                                <input id="currency" name="currency" placeholder="Currency" type="text"
                                                       class="form-control required" value="{!! old('currency') !!}"/>
                                                {!! $errors->first('currency', '<span class="help-block">:message</span>') !!}
                                            </div>
                                        </div>
                                        

                                        <div class="form-group {{ $errors->first('currency_code', 'has-error') }}">
                                            <label for="currency_code" class="col-sm-2 control-label">Currency Code*</label>
                                            <div class="col-sm-10">
                                                <input id="currency_code" name="currency_code" type="text" placeholder="Currency Code"
                                                       class="form-control required" value="{!! old('currency_code') !!}"/>
                                                {!! $errors->first('currency_code', '<span class="help-block">:currency_code</span>') !!}
                                            </div>
                                        </div>

                                    </div>
                                    <div class="tab-pane" id="tab2" disabled="disabled">
                                        <h2 class="hidden">&nbsp;</h2> <div class="form-group  {{ $errors->first('std_employees', 'has-error') }}">
                                           
                                            <label for="std_employees" class="col-sm-2 control-label">Employees Qty*</label>
                                            <div class="col-sm-10">
                                                <input id="std_employees" name="std_employees" type="text" placeholder="Employees Range"
                                                       class="form-control required" value="{!! old('std_employees') !!}"/>

                                                {!! $errors->first('std_employees', '<span class="help-block">:message</span>') !!}
                                            </div>
                                           
                                            <span class="help-block">{{ $errors->first('std_employees', ':message') }}</span>
                                        </div>

                                        <div class="form-group {{ $errors->first('std_base', 'has-error') }}">
                                            <label for="std_base" class="col-sm-2 control-label">Base *</label>
                                            <div class="col-sm-10">
                                                <input id="std_base" name="std_base" placeholder="Base" type="text"
                                                       class="form-control required" value="{!! old('std_base') !!}"/>
                                                {!! $errors->first('std_base', '<span class="help-block">:message</span>') !!}
                                            </div>
                                        </div>

                                        <div class="form-group {{ $errors->first('std_discount', 'has-error') }}">
                                            <label for="currency" class="col-sm-2 control-label">Annual Discount *</label>
                                            <div class="col-sm-10">
                                                <input id="std_discount" name="std_discount" placeholder="Discount" type="text"
                                                       class="form-control required" value="{!! old('std_discount') !!}"/>
                                                {!! $errors->first('currency', '<span class="help-block">:message</span>') !!}
                                            </div>
                                        </div>

                                        <div class="form-group {{ $errors->first('std_terms', 'has-error') }}">
                                            <label for="std_terms" class="col-sm-2 control-label">Terms Forms(Active & Checks) *</label>
                                            <div class="col-sm-10">
                                                <input id="std_terms" name="std_terms" placeholder="Terms Forms" type="text"
                                                       class="form-control required" value="{!! old('std_terms') !!}"/>
                                                {!! $errors->first('currency', '<span class="help-block">:message</span>') !!}
                                            </div>
                                        </div>

                                        <div class="form-group {{ $errors->first('std_cost_employee', 'has-error') }}">
                                            <label for="std_cost_employee" class="col-sm-2 control-label">Cost per employee or check $ *</label>
                                            <div class="col-sm-10">
                                                <input id="std_cost_employee" name="std_cost_employee" placeholder="Cost per employee or check" type="text"
                                                       class="form-control required" value="{!! old('std_cost_employee') !!}"/>
                                                {!! $errors->first('std_cost_employee', '<span class="help-block">:message</span>') !!}
                                            </div>
                                        </div>

                                        <div class="form-group {{ $errors->first('std_support', 'has-error') }}">
                                            <label for="std_support" class="col-sm-2 control-label">Support *</label>
                                            <div class="col-sm-10">
                                                <input id="std_support" name="std_support" placeholder="Support" type="text"
                                                       class="form-control required" value="{!! old('std_support') !!}"/>
                                                {!! $errors->first('std_support', '<span class="help-block">:message</span>') !!}
                                            </div>
                                        </div>

                                        <div class="form-group {{ $errors->first('std_users', 'has-error') }}">
                                            <label for="std_users" class="col-sm-2 control-label">Users(admins) *</label>
                                            <div class="col-sm-10">
                                                <input id="std_users" name="std_users" placeholder="Users" type="text"
                                                       class="form-control required" value="{!! old('std_users') !!}"/>
                                                {!! $errors->first('std_users', '<span class="help-block">:message</span>') !!}
                                            </div>
                                        </div>

                                        <div class="form-group {{ $errors->first('std_price', 'has-error') }}">
                                            <label for="std_price" class="col-sm-2 control-label">Standard Price *</label>
                                            <div class="col-sm-10">
                                                <input id="std_price" name="std_price" placeholder="Price" type="text"
                                                       class="form-control required" value="{!! old('std_price') !!}"/>
                                                {!! $errors->first('std_price', '<span class="help-block">:message</span>') !!}
                                            </div>
                                        </div>
                                                                             
                                    </div>
                                    <!--end of basic prices-->
                                    
                                    <div class="tab-pane" id="tab3" disabled="disabled">
                                        

                                        <div class="form-group">
                                            <label for="bn_employees" class="col-sm-2 control-label">Employees*</label>
                                            <div class="col-sm-10">
                                                <input id="bn_employees" name="bn_employees" placeholder="Employees" type="text" class="form-control"
                                                       value="{!! old('bn_employees') !!}"/>
                                            </div>
                                            <span class="help-block">{{ $errors->first('bn_employees', ':message') }}</span>
                                        </div>

                                        <div class="form-group {{ $errors->first('bn_base', 'has-error') }}">
                                            <label for="bn_base" class="col-sm-2 control-label">Base *</label>
                                            <div class="col-sm-10">
                                                <input id="bn_base" name="bn_base" placeholder="Base" type="text"
                                                       class="form-control required" value="{!! old('currency') !!}"/>
                                                {!! $errors->first('bn_base', '<span class="help-block">:message</span>') !!}
                                            </div>
                                        </div>

                                        <div class="form-group {{ $errors->first('bn_discount', 'has-error') }}">
                                            <label for="bn_discount" class="col-sm-2 control-label">Annual Discount *</label>
                                            <div class="col-sm-10">
                                                <input id="bn_discount" name="bn_discount" placeholder="Annual Discount" type="text"
                                                       class="form-control required" value="{!! old('currency') !!}"/>
                                                {!! $errors->first('bn_discount', '<span class="help-block">:message</span>') !!}
                                            </div>
                                        </div>

                                        <div class="form-group {{ $errors->first('bn_terms', 'has-error') }}">
                                            <label for="bn_terms" class="col-sm-2 control-label">Terms Forms(Active & Checks) *</label>
                                            <div class="col-sm-10">
                                                <input id="bn_terms" name="bn_terms" placeholder="Terms" type="text"
                                                       class="form-control required" value="{!! old('bn_terms') !!}"/>
                                                {!! $errors->first('bn_terms', '<span class="help-block">:message</span>') !!}
                                            </div>
                                        </div>

                                        <div class="form-group {{ $errors->first('bn_employee_cost', 'has-error') }}">
                                            <label for="bn_employee_cost" class="col-sm-2 control-label">Cost per employee or check $ *</label>
                                            <div class="col-sm-10">
                                                <input id="bn_employee_cost" name="bn_employee_cost" placeholder="Cost per employee or check" type="text"
                                                       class="form-control required" value="{!! old('bn_employee_cost') !!}"/>
                                                {!! $errors->first('bn_employee_cost', '<span class="help-block">:message</span>') !!}
                                            </div>
                                        </div>

                                        <div class="form-group {{ $errors->first('bn_support', 'has-error') }}">
                                            <label for="bn_support" class="col-sm-2 control-label">Support *</label>
                                            <div class="col-sm-10">
                                                <input id="bn_support" name="bn_support" placeholder="Support" type="text"
                                                       class="form-control required" value="{!! old('bn_support') !!}"/>
                                                {!! $errors->first('bn_support', '<span class="help-block">:message</span>') !!}
                                            </div>
                                        </div>

                                        <div class="form-group {{ $errors->first('bn_users', 'has-error') }}">
                                            <label for="bn_users" class="col-sm-2 control-label">Users(admins) *</label>
                                            <div class="col-sm-10">
                                                <input id="bn_users" name="bn_users" placeholder="Users" type="text"
                                                       class="form-control required" value="{!! old('bn_users') !!}"/>
                                                {!! $errors->first('bn_users', '<span class="help-block">:message</span>') !!}
                                            </div>
                                        </div>

                                        <div class="form-group {{ $errors->first('bn_price', 'has-error') }}">
                                            <label for="bn_price" class="col-sm-2 control-label">Business Price *</label>
                                            <div class="col-sm-10">
                                                <input id="bn_price" name="bn_price" placeholder="Price" type="text"
                                                       class="form-control required" value="{!! old('bn_price') !!}"/>
                                                {!! $errors->first('bn_price', '<span class="help-block">:message</span>') !!}
                                            </div>
                                        </div>


                                    </div>
                                    <div class="tab-pane" id="tab4" disabled="disabled">

                                        <div class="form-group">
                                            <label for="pro_employees" class="col-sm-2 control-label">Employees*</label>
                                            <div class="col-sm-10">
                                                <input id="pro_employees" name="pro_employees" type="text" placeholder="Premium Price" class="form-control"
                                                       value="{!! old('pro_employees') !!}"/>
                                            </div>
                                            <span class="help-block">{{ $errors->first('pro_employees', ':message') }}</span>
                                        </div>

                                        <div class="form-group {{ $errors->first('pro_base', 'has-error') }}">
                                            <label for="pro_base" class="col-sm-2 control-label">Base *</label>
                                            <div class="col-sm-10">
                                                <input id="pro_base" name="pro_base" placeholder="Base" type="text"
                                                       class="form-control required" value="{!! old('pro_base') !!}"/>
                                                {!! $errors->first('pro_base', '<span class="help-block">:message</span>') !!}
                                            </div>
                                        </div>

                                        <div class="form-group {{ $errors->first('pro_discount', 'has-error') }}">
                                            <label for="pro_discount" class="col-sm-2 control-label">Annual Discount *</label>
                                            <div class="col-sm-10">
                                                <input id="pro_discount" name="pro_discount" placeholder="Annual Discount" type="text"
                                                       class="form-control required" value="{!! old('pro_discount') !!}"/>
                                                {!! $errors->first('pro_discount', '<span class="help-block">:message</span>') !!}
                                            </div>
                                        </div>

                                        <div class="form-group {{ $errors->first('pro_terms', 'has-error') }}">
                                            <label for="pro_terms" class="col-sm-2 control-label">Terms Forms(Active & Checks) *</label>
                                            <div class="col-sm-10">
                                                <input id="pro_terms" name="pro_terms" placeholder="Terms Forms" type="text"
                                                       class="form-control required" value="{!! old('pro_terms') !!}"/>
                                                {!! $errors->first('pro_terms', '<span class="help-block">:message</span>') !!}
                                            </div>
                                        </div>

                                        <div class="form-group {{ $errors->first('pro_employee_cost', 'has-error') }}">
                                            <label for="pro_employee_cost" class="col-sm-2 control-label">Cost per employee or check $ *</label>
                                            <div class="col-sm-10">
                                                <input id="pro_employee_cost" name="pro_employee_cost" placeholder="Cost per employee" type="text"
                                                       class="form-control required" value="{!! old('pro_employee_cost') !!}"/>
                                                {!! $errors->first('pro_employee_cost', '<span class="help-block">:message</span>') !!}
                                            </div>
                                        </div>

                                        <div class="form-group {{ $errors->first('pro_support', 'has-error') }}">
                                            <label for="currency" class="col-sm-2 control-label">Support *</label>
                                            <div class="col-sm-10">
                                                <input id="pro_support" name="pro_support" placeholder="Support" type="text"
                                                       class="form-control required" value="{!! old('pro_support') !!}"/>
                                                {!! $errors->first('pro_support', '<span class="help-block">:message</span>') !!}
                                            </div>
                                        </div>

                                        <div class="form-group {{ $errors->first('pro_users', 'has-error') }}">
                                            <label for="pro_users" class="col-sm-2 control-label">Users(admins) *</label>
                                            <div class="col-sm-10">
                                                <input id="pro_users" name="pro_users" placeholder="Users" type="text"
                                                       class="form-control required" value="{!! old('pro_users') !!}"/>
                                                {!! $errors->first('currency', '<span class="help-block">:message</span>') !!}
                                            </div>
                                        </div>

                                        <div class="form-group {{ $errors->first('pro_price', 'has-error') }}">
                                            <label for="pro_price" class="col-sm-2 control-label">Professional Price *</label>
                                            <div class="col-sm-10">
                                                <input id="pro_price" name="pro_price" placeholder="Price" type="text"
                                                       class="form-control required" value="{!! old('pro_price') !!}"/>
                                                {!! $errors->first('pro_price', '<span class="help-block">:message</span>') !!}
                                            </div>
                                        </div>

                                        
                                       <!-- <div class="form-group">
                                            <label for="activate" class="col-sm-2 control-label"> Activate Country*</label>
                                            <div class="col-sm-10">
                                                <input id="activate" name="activate" type="checkbox"
                                                       class="pos-rel p-l-30 custom-checkbox"
                                                       value="1" @if(old('activate')) checked="checked" @endif >
                                                <span>To activate country automatically, click the check box</span></div>

                                        </div>-->
                                    </div>
                                    <div class="tab-pane" id="tab5" disabled="disabled">
                                        

                                        <div class="form-group">
                                            <label for="ent_employees" class="col-sm-2 control-label">Employees*</label>
                                            <div class="col-sm-10">
                                                <input id="ent_employees" name="ent_employees" placeholder="Employees" type="text" class="form-control"
                                                       value="{!! old('ent_employees') !!}"/>
                                            </div>
                                            <span class="help-block">{{ $errors->first('ent_employees', ':message') }}</span>
                                        </div>

                                        <div class="form-group {{ $errors->first('ent_base', 'has-error') }}">
                                            <label for="ent_base" class="col-sm-2 control-label">Base *</label>
                                            <div class="col-sm-10">
                                                <input id="ent_base" name="ent_base" placeholder="Base" type="text"
                                                       class="form-control required" value="{!! old('ent_base') !!}"/>
                                                {!! $errors->first('ent_base', '<span class="help-block">:message</span>') !!}
                                            </div>
                                        </div>

                                        <div class="form-group {{ $errors->first('ent_discount', 'has-error') }}">
                                            <label for="ent_discount" class="col-sm-2 control-label">Annual Discount *</label>
                                            <div class="col-sm-10">
                                                <input id="ent_discount" name="ent_discount" placeholder="Annual Discount" type="text"
                                                       class="form-control required" value="{!! old('ent_discount') !!}"/>
                                                {!! $errors->first('ent_discount', '<span class="help-block">:message</span>') !!}
                                            </div>
                                        </div>

                                        <div class="form-group {{ $errors->first('ent_terms', 'has-error') }}">
                                            <label for="ent_terms" class="col-sm-2 control-label">Terms Forms(Active & Checks) *</label>
                                            <div class="col-sm-10">
                                                <input id="ent_terms" name="ent_terms" placeholder="Terms Forms" type="text"
                                                       class="form-control required" value="{!! old('ent_terms') !!}"/>
                                                {!! $errors->first('ent_terms', '<span class="help-block">:message</span>') !!}
                                            </div>
                                        </div>

                                        <div class="form-group {{ $errors->first('ent_employee_cost', 'has-error') }}">
                                            <label for="ent_employee_cost" class="col-sm-2 control-label">Cost per employee or check $ *</label>
                                            <div class="col-sm-10">
                                                <input id="ent_employee_cost" name="ent_employee_cost" placeholder="Cost per employee" type="text"
                                                       class="form-control required" value="{!! old('ent_employee_cost') !!}"/>
                                                {!! $errors->first('ent_employee_cost', '<span class="help-block">:message</span>') !!}
                                            </div>
                                        </div>

                                        <div class="form-group {{ $errors->first('ent_support', 'has-error') }}">
                                            <label for="ent_support" class="col-sm-2 control-label">Support *</label>
                                            <div class="col-sm-10">
                                                <input id="ent_support" name="ent_support" placeholder="Support" type="text"
                                                       class="form-control required" value="{!! old('ent_support') !!}"/>
                                                {!! $errors->first('ent_support', '<span class="help-block">:message</span>') !!}
                                            </div>
                                        </div>

                                        <div class="form-group {{ $errors->first('ent_users', 'has-error') }}">
                                            <label for="ent_users" class="col-sm-2 control-label">Users(admins) *</label>
                                            <div class="col-sm-10">
                                                <input id="ent_users" name="ent_users" placeholder="Users" type="text"
                                                       class="form-control required" value="{!! old('ent_users') !!}"/>
                                                {!! $errors->first('ent_users', '<span class="help-block">:message</span>') !!}
                                            </div>
                                        </div>

                                        <div class="form-group {{ $errors->first('ent_price', 'has-error') }}">
                                            <label for="ent_price" class="col-sm-2 control-label">Enterprise Price *</label>
                                            <div class="col-sm-10">
                                                <input id="ent_price" name="ent_price" placeholder="Price" type="text"
                                                       class="form-control required" value="{!! old('ent_price') !!}"/>
                                                {!! $errors->first('ent_price', '<span class="help-block">:message</span>') !!}
                                            </div>
                                        </div>


                                    </div>
                                    <div class="tab-pane" id="tab6" disabled="disabled">
                                        

                                        <div class="form-group">
                                            <label for="el_employees" class="col-sm-2 control-label">Employees*</label>
                                            <div class="col-sm-10">
                                                <input id="el_employees" name="el_employees" placeholder="Employees" type="text" class="form-control"
                                                       value="{!! old('el_employees') !!}"/>
                                            </div>
                                            <span class="help-block">{{ $errors->first('el_employees', ':message') }}</span>
                                        </div>

                                        <div class="form-group {{ $errors->first('el_base', 'has-error') }}">
                                            <label for="el_base" class="col-sm-2 control-label">Base *</label>
                                            <div class="col-sm-10">
                                                <input id="el_base" name="el_base" placeholder="Base" type="text"
                                                       class="form-control required" value="{!! old('el_base') !!}"/>
                                                {!! $errors->first('el_base', '<span class="help-block">:message</span>') !!}
                                            </div>
                                        </div>

                                        <div class="form-group {{ $errors->first('el_discount', 'has-error') }}">
                                            <label for="el_discount" class="col-sm-2 control-label">Annual Discount *</label>
                                            <div class="col-sm-10">
                                                <input id="el_discount" name="el_discount" placeholder="Annual Discount" type="text"
                                                       class="form-control required" value="{!! old('el_discount') !!}"/>
                                                {!! $errors->first('el_discount', '<span class="help-block">:message</span>') !!}
                                            </div>
                                        </div>

                                        <div class="form-group {{ $errors->first('el_terms', 'has-error') }}">
                                            <label for="el_terms" class="col-sm-2 control-label">Terms Forms(Active & Checks) *</label>
                                            <div class="col-sm-10">
                                                <input id="el_terms" name="el_terms" placeholder="Terms Forms" type="text"
                                                       class="form-control required" value="{!! old('el_terms') !!}"/>
                                                {!! $errors->first('el_terms', '<span class="help-block">:message</span>') !!}
                                            </div>
                                        </div>

                                        <div class="form-group {{ $errors->first('el_employee_cost', 'has-error') }}">
                                            <label for="el_employee_cost" class="col-sm-2 control-label">Cost per employee or check $ *</label>
                                            <div class="col-sm-10">
                                                <input id="el_employee_cost" name="el_employee_cost" placeholder="Cost per employee" type="text"
                                                       class="form-control required" value="{!! old('el_employee_cost') !!}"/>
                                                {!! $errors->first('el_employee_cost', '<span class="help-block">:message</span>') !!}
                                            </div>
                                        </div>

                                        <div class="form-group {{ $errors->first('el_support', 'has-error') }}">
                                            <label for="el_support" class="col-sm-2 control-label">Support *</label>
                                            <div class="col-sm-10">
                                                <input id="el_support" name="el_support" placeholder="Support" type="text"
                                                       class="form-control required" value="{!! old('el_support') !!}"/>
                                                {!! $errors->first('el_support', '<span class="help-block">:message</span>') !!}
                                            </div>
                                        </div>

                                        <div class="form-group {{ $errors->first('el_users', 'has-error') }}">
                                            <label for="el_users" class="col-sm-2 control-label">Users(admins) *</label>
                                            <div class="col-sm-10">
                                                <input id="el_users" name="el_users" placeholder="Users" type="text"
                                                       class="form-control required" value="{!! old('el_users') !!}"/>
                                                {!! $errors->first('el_users', '<span class="help-block">:message</span>') !!}
                                            </div>
                                        </div>

                                        <div class="form-group {{ $errors->first('el_price', 'has-error') }}">
                                            <label for="el_price" class="col-sm-2 control-label">Elite Price *</label>
                                            <div class="col-sm-10">
                                                <input id="el_price" name="el_price" placeholder="Price" type="text"
                                                       class="form-control required" value="{!! old('el_price') !!}"/>
                                                {!! $errors->first('el_price', '<span class="help-block">:message</span>') !!}
                                            </div>
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
