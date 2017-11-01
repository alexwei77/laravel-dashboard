@extends('admin/layouts/default')

{{-- Page title --}}
@section('title')
    Generate Voucher
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

<?php
$voucher_type = ['Percentage', 'Amount($)'];
$duration_type = ['Monthly', 'Yearly'];
?>


{{-- Page content --}}
@section('content')
    <section class="content-header">
        
        <ol class="breadcrumb">
            <li>
                <a href="{{ route('admin.dashboard') }}">
                    <i class="livicon" data-name="home" data-size="14" data-color="#000"></i>
                    Dashboard
                </a>
            </li>
            <li><a href="#">Vouchers</a></li>
            <li class="active">Generate Voucher</li>
        </ol>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h3 class="panel-title">
                            <i class="livicon" data-name="user-add" data-size="18" data-c="#fff" data-hc="#fff" data-loop="true"></i>
                            Generate Voucher
                        </h3>
                                <span class="pull-right clickable">
                                    <i class="glyphicon glyphicon-chevron-up"></i>
                                </span>
                    </div>
                    <div class="panel-body">
                        <!--main content-->
                        <form id="addCountryPrice" action="{{ action('VouchersController@postCreatedVoucher') }}"
                              method="POST" enctype="multipart/form-data" class="form-horizontal">
                            <!-- CSRF Token -->
                            <input type="hidden" name="_token" value="{{ csrf_token() }}" />

                            <div id="rootwizard">
                                <ul>
                                    
                                </ul>
                                <div class="tab-content">


                                    <div class="form-group {{ $errors->first('voucher_name', 'has-error') }}">
                                        <label for="voucher_name" class="col-sm-2 control-label">Voucher name*</label>
                                        <div class="col-sm-6">
                                            <input id="email" name="voucher_name" type="text"
                                                   placeholder="Voucher Name" class="form-control required"
                                                   value="" required/>

                                            {!! $errors->first('voucher_name', '<span class="help-block">:message</span>') !!}
                                        </div>

                                    </div>

                                    <div class="form-group {{ $errors->first('max_redemptions', 'has-error') }}">
                                        <label for="max_redemptions" class="col-sm-2 control-label">Maximum Redemptions*</label>
                                        <div class="col-sm-6">
                                            <input id="email" name="max_redemptions" type="text"
                                                   placeholder="Maximum Redemptions" class="form-control required"
                                                   value="" required/>

                                            {!! $errors->first('max_redemptions', '<span class="help-block">:message</span>') !!}
                                        </div>

                                    </div>


                                    <div id="discount_duration_section" class="form-group {{ $errors->first('discount_duration', 'has-error') }}">
                                        <label for="discount_duration" class="col-sm-2 control-label">Number of Months*</label>
                                        <div class="col-sm-6">
                                            <input id="discount_duration" name="discount_duration" type="number"
                                                   placeholder="Number of Months" class="form-control required"
                                                   value="" required/>

                                            {!! $errors->first('discount_duration', '<span class="help-block">:message</span>') !!}
                                        </div>

                                    </div>

                                        <div class="form-group {{ $errors->first('owner_name', 'has-error') }}">
                                            <label for="owner_name" class="col-sm-2 control-label">Distributor name*</label>
                                            <div class="col-sm-6">
                                                <input id="owner_name" name="owner_name" type="text"
                                                       placeholder="Distributor Name" class="form-control required"
                                                       value="" required/>

                                                {!! $errors->first('owner_name', '<span class="help-block">:message</span>') !!}
                                            </div>

                                        </div>

                                        <div class="form-group {{ $errors->first('email', 'has-error') }}">
                                            <label for="fact_opinion" class="col-sm-2 control-label">Email address*</label>
                                            <div class="col-sm-6">
                                                <input id="email" name="email" type="text"
                                                       placeholder="Distributor Email" class="form-control required"
                                                       value="" required/>

                                                {!! $errors->first('email', '<span class="help-block">:message</span>') !!}
                                            </div>

                                        </div>

                                       <div class="form-group {{ $errors->first('discount_type', 'has-error') }}">
                                        <label class="control-label  col-md-2">Discount type* </label>
                                        <div class="col-md-6">
                                            {!! Form::select('discount_type', $voucher_type, null,['class' => 'form-control select2', 'id' => 'discount_type']) !!}
                                            <span class="help-block">{{ $errors->first('discount_type', ':message') }}</span>
                                        </div>
                                      </div>

                                        <div id="percentage_section" class="form-group {{ $errors->first('percentage_discount', 'has-error') }}">
                                            <label for="percentage_discount" class="col-sm-2 control-label">Percentage discount*</label>
                                            <div class="col-sm-6">
                                                <input id="percentage_discount" name="percentage_discount" type="text"
                                                       placeholder="Percentage Discount" class="form-control required"
                                                       value="" required/>

                                                {!! $errors->first('percentage_discount', '<span class="help-block">:message</span>') !!}
                                            </div>

                                        </div>

                                    <div id="amount_section" class="form-group {{ $errors->first('amount', 'has-error') }}">
                                        <label for="amount" class="col-sm-2 control-label">Amount*</label>
                                        <div class="col-sm-6">
                                            <input id="amount" name="amount" type="text"
                                                   placeholder="Amount" class="form-control required"
                                                   value="" required/>

                                            {!! $errors->first('amount', '<span class="help-block">:message</span>') !!}
                                        </div>

                                    </div>

                                        <div class="form-group {{ $errors->first('redeem_by', 'has-error') }}">
                                            <label for="redeem_by" class="col-sm-2 control-label">Expiry*</label>
                                            <div class="col-sm-6">
                                                <input id="redeem_by" name="redeem_by" type="date"
                                                       placeholder="Expiry" class="form-control required"
                                                       value="" required/>

                                                {!! $errors->first('redeem_by', '<span class="help-block">:message</span>') !!}
                                            </div>

                                        </div>

                                        <div class="form-group {{ $errors->first('country_name', 'has-error') }}">
                                        <label for="country_name" class="col-sm-2 control-label"></label>
                                           <div class="col-sm-6">
                                             <button type="submit" class="btn btn-primary" id="change-password">Submit
                                             </button>
                                            </div>
                                        </div>
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

    <script>
        jQuery( document ).ready(function() {
            jQuery("#amount_section").hide();
            jQuery("#amount").val('');
            jQuery("#discount_type").val(0).change();

            jQuery("#discount_duration1_section").hide();
            jQuery("#discount_duration1").val('');
            jQuery("#duration_type").val(0).change();

          jQuery("#discount_type").change(function() {
              //alert($(this).val());
              if($(this).val() == 0) {
                  jQuery("#amount_section").hide();
                  jQuery("#amount").val('');
                  jQuery("#percentage_section").show();
              }else{
                  jQuery("#percentage_section").hide();
                  jQuery("#percentage_discount").val('');
                  jQuery("#amount_section").show();
              }
          });

        });

    </script>
@stop
