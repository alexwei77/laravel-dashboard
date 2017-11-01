@extends('admin/layouts/defaultx')
{{-- Page title --}}
@section('title')
Upgrade
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
<?php 
   session_name('paygate_payweb3_testing_sample');
   session_start();

   include_once base_path('app/MyLibrary/paygatelib/php/global.inc.php');
   include_once base_path('app/MyLibrary/paygatelib/paygate.payweb3.php');
   include_once base_path('app/MyLibrary/paygatelib2/php/global.inc.php');
   include_once base_path('app/MyLibrary/paygatelib2/paygate.payweb3.php');
   
      $requestAmount = 399;
      
      $userEMail = 'dev14@stafflife.com';
      
      $locale = 'en-za';
      $country = 'ZAF';
      $currencycode = 'USD';
   
      $getUserPackage = DB::table('dmmx_paysubscriptions')->where('userid', $user->id)->first();

      $subscriptionPeriodVal = $getUserPackage->sub_type;
      
      if($getUserPackage->sub_type == 1){
         $subscriptionPeriod = "Yearly";
      }else{
          $subscriptionPeriod = "Monthly";
      }
      //Determining category of the package 
      $packageData = DB::table('packages')->where('id', $getUserPackage->packageid)->first();


      $allPackages = DB::table('packages')->limit(5)->get();

      $packages = array();
      foreach($allPackages as $singlepackage){
          array_push($packages, $singlepackage->name);
      }
      $period = ['Monthly', 'Yearly'];

    $payreference = generateReference();
    $currecyCode = 'USD';
    $returnUrl	= $fullPath['protocol'] . $fullPath['host'] . '/' . $root . '/dmmx/public/payresult'; 
    $transcationDate = getDateTime('Y-m-d H:i');
    $tranStartDate = getDateTime('Y-m-d'); 
    $tranEndDate = date('Y-m-d', strtotime("+12 months", strtotime(getDateTime('Y-m-d')))); //This should be dynamic depedning on the the user's chosen combinations'

    $data = array(
		'VERSION'            => '21',
		'PAYGATE_ID'        => '10011072130',
		'REFERENCE'         => $payreference ,
		'AMOUNT'            => '', //cehck if the amount reeived is valid
		'CURRENCY'          => $currecyCode,
		'RETURN_URL'        => $returnUrl,  //."/" .$subdata['category'] ."/" .$subdata['contractsQuantity']
		'TRANSACTION_DATE'  => $transcationDate,
		//'EMAIL'             => "customer@mywebsite.com", //if not given it will be requested in the pages
		'SUBS_START_DATE'   => $tranStartDate,
		'SUBS_END_DATE'     => $tranEndDate,
		'SUBS_FREQUENCY'    => '',
		'PROCESS_NOW'       => 'YES',
		'PROCESS_NOW_AMOUNT' => '',
	);
   
   ?>
<section class="content-header">
   <h1>Upgrade/Downgrade</h1>
   <ol class="breadcrumb">
      <li>
         <a href="{{ route('dashboard') }}">
         <i class="livicon" data-name="barchart" data-size="14" data-color="#000"></i>
         Dashboard
         </a>
      </li>
      <li class="active">Upgrade/downgrade</li>
   </ol>
</section>
<section class="content">
   <div class="row">
      <div class="col-md-12">
         <div class="panel panel-primary">
            <div class="panel-heading">
               <h3 class="panel-title">
                  <i class="livicon" data-name="user-add" data-size="18" data-c="#fff" data-hc="#fff" data-loop="true"></i>
                  Upgrade
               </h3>
               <span class="pull-right clickable">
               <!--<i class="glyphicon glyphicon-chevron-up"></i>-->
               </span>
            </div>
            <div class="panel-body">
               <!--main content-->
               <form id="submitUpgradeDowngrade" action="{{ action('SubscriptionsController@upgradedowngradesubmit') }}"
                  method="POST" enctype="multipart/form-data" class="form-horizontal">
                  <!-- CSRF Token -->
                  <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                  <input type="hidden" name="PAYGATE_ID" id="PAYGATE_ID" value="<?php echo $data['PAYGATE_ID']; ?>"/>
                  <input type="hidden" name="REFERENCE" id="REFERENCE" value="<?php echo $data['REFERENCE']; ?>"/>
                  <!--<input type="hidden" name="AMOUNT" id="AMOUNT" value="<?php ?>"/>-->
                  <input type="hidden" name="CURRENCY" id="CURRENCY" value="<?php echo $data['CURRENCY']; ?>"/>
                  <input type="hidden" name="RETURN_URL" id="RETURN_URL" value="<?php echo $fullPath['protocol'] . $fullPath['host'] . '/' .'payresult'; ?>"/>
                  <input type="hidden" name="TRANSACTION_DATE" id="TRANSACTION_DATE" value="<?php echo $data['TRANSACTION_DATE']; ?>"/>
                  <input type="hidden" name="SUBS_START_DATE" value="<?php echo $data['SUBS_START_DATE']; ?>">
                  <!--<input type="hidden" name="SUBS_FREQUENCY" value="<?php ?>">-->
                  <!--<input type="hidden" name="SUBS_END_DATE" value="<?php ?>">-->
                  <input type="hidden" name="PROCESS_NOW" value="YES">
                   <input type="hidden" name="VERSION" value="<?php echo $data['VERSION']; ?>">
                  <input type="hidden" id="PROCESS_NOW_AMOUNT" name="PROCESS_NOW_AMOUNT" value="<?php ?>">
                   <input type="hidden" name="LOCALE" id="LOCALE" value="<?php echo $locale; ?>"/>
                   <input type="hidden" name="COUNTRY" id="COUNTRY" value="<?php echo $country; ?>"/>
                   <input type="hidden" name="currencycode" id="currencycode" value="<?php echo $currencycode; ?>"/>

                  <div id="rootwizard">
                     <ul>
                        <li><a href="#tab1" data-toggle="tab" style="cursor:default !important;">Current package details</a></li>
                        <li><a href="#tab2" data-toggle="tab" style="cursor:default !important;">Choose upgrade/downgrade package</a></li>
                        <li><a href="#tab3" data-toggle="tab" style="cursor:default !important;">Total cost</a></li>
                     </ul>
                     <div class="tab-content">
                        <div class="tab-pane" id="tab1">
                           <h2 class="hidden">&nbsp;</h2>
                           <div class="form-group {{ $errors->first('country_name', 'has-error') }}">
                              <label for="country_name" class="col-sm-2 control-label">Admins allowed</label>
                              <div class="col-sm-10">
                                 {{ $packageData->admins }}
                                 {!! $errors->first('country_name', '<span class="help-block">:message</span>') !!}
                              </div>
                           </div>
                           <div class="form-group {{ $errors->first('country_name', 'has-error') }}">
                              <label for="country_name" class="col-sm-2 control-label">Amount</label>
                              <div class="col-sm-10">
                                 @if($getUserPackage->sub_type == 0)
                                 <?php echo "$"; ?>{{ $packageData->monthly_price }}
                                 @endif
                                 @if($getUserPackage->sub_type == 1)
                                 <?php echo "$"; ?>{{ ($packageData->price)*12 }}
                                 @endif
                                 {!! $errors->first('country_name', '<span class="help-block">:message</span>') !!}
                              </div>
                           </div>
                           <div class="form-group {{ $errors->first('country_name', 'has-error') }}">
                              <label for="country_name" class="col-sm-2 control-label">Contracts/units available</label>
                              <div class="col-sm-10">
                              @if($getUserPackage->employees_avail < 0)
                                 Unlimited
                              @else
                                 {{ $getUserPackage->employees_avail }}
                              @endif
                                 {!! $errors->first('country_name', '<span class="help-block">:message</span>') !!}
                              </div>
                           </div>
                           <div class="form-group {{ $errors->first('country_name', 'has-error') }}">
                              <label for="country_name" class="col-sm-2 control-label">Support</label>
                              <div class="col-sm-10">
                                 {{ $getUserPackage->support }}
                                 {!! $errors->first('country_name', '<span class="help-block">:message</span>') !!}
                              </div>
                           </div>
                           <div class="form-group {{ $errors->first('country_name', 'has-error') }}">
                              <label for="country_name" class="col-sm-2 control-label">Membership start date</label>
                              <div class="col-sm-10">
                                 {{ $getUserPackage->SUBS_START_DATE }}
                                 {!! $errors->first('country_name', '<span class="help-block">:message</span>') !!}
                              </div>
                           </div>
                           <div class="form-group {{ $errors->first('country_name', 'has-error') }}">
                              <label for="country_name" class="col-sm-2 control-label">Period</label>
                              <div class="col-sm-10">
                                 {{ $subscriptionPeriod }}
                                 {!! $errors->first('country_name', '<span class="help-block">:message</span>') !!}
                              </div>
                           </div>
                           @if($getUserPackage->pay_status == 0)
                           <div class="form-group {{ $errors->first('country_name', 'has-error') }}">
                              <label for="country_name" class="col-sm-2 control-label">Status</label>
                              <div class="col-sm-10">
                                 Not paid/Expired
                              </div>
                           </div>
                           @endif
                           @if($getUserPackage->pay_status == 1)
                           <div class="form-group {{ $errors->first('country_name', 'has-error') }}">
                              <label for="country_name" class="col-sm-2 control-label">Status</label>
                              <div class="col-sm-10">
                                 Active
                              </div>
                           </div>
                           <div class="form-group {{ $errors->first('country_name', 'has-error') }}">
                              <label for="country_name" class="col-sm-2 control-label">Cancel Membership</label>
                              <div class="col-sm-1">
                                 <button id="cancel-subscription" data-target="#cancel_subscription" data-toggle="modal" class="btn btn-primary add_contract_button">Cancel</button>
                              </div>
                           </div>
                           @else
                            <div class="form-group {{ $errors->first('country_name', 'has-error') }}">
                              <label for="country_name" class="col-sm-2 control-label">Pay the Package</label>
                              <div class="col-sm-1">
                                 <a style="color: #fff !important" href="{{ route('pay-package') }}" class="btn btn-primary">Pay</a>
                              </div>
                           </div>
                           @endif
                        </div>
                        <div class="tab-pane" id="tab2" disabled="disabled">
                           <div class="form-group {{ $errors->first('basicContracts', 'has-error') }}">
                              <label class="control-label  col-md-2">Choose package: </label>
                              <div class="col-md-6">
                                 {!! Form::select('packages', $packages, null,['class' => 'form-control select2', 'id' => 'packages']) !!}
                                 <span class="help-block">{{ $errors->first('packages', ':message') }}</span>
                              </div>
                           </div>
                           <div class="form-group {{ $errors->first('basicContracts', 'has-error') }}">
                              <label class="control-label  col-md-2">Choose period: </label>
                              <div class="col-md-6">
                                 {!! Form::select('period', $period, null,['class' => 'form-control select2', 'id' => 'period']) !!}
                                 <span class="help-block">{{ $errors->first('period', ':message') }}</span>
                              </div>
                           </div>
                           <div class="form-group {{ $errors->first('amoun_to_pay', 'has-error') }}">
                              <div class="col-md-6">
                                 {!! Form::hidden('amoun_to_pay', null,['class' => 'form-control select2', 'id' => 'amoun_to_pay']) !!}
                                 <span class="help-block">{{ $errors->first('amoun_to_pay', ':message') }}</span>
                              </div>
                           </div>
                        </div>
                        <!--end of basic prices-->
                        <div class="tab-pane" id="tab3" disabled="disabled">
                           <!--<div class="form-group {{ $errors->first('credit_worth', 'has-error') }}">
                              <label for="credit_worth" class="col-sm-2 control-label">Remaining credit worth of your package</label>
                              <div class="col-sm-10">
                                 <p id="credit_worth"></p>
                                 {!! $errors->first('credit_worth', '<span class="help-block">:message</span>') !!}
                              </div>
                           </div>
                           <div class="form-group {{ $errors->first('amount_pay', 'has-error') }}">
                              <label for="amount_pay" class="col-sm-2 control-label">Amount to be paid</label>
                              <div class="col-sm-10">
                                 <p id="amount_pay"></p>
                                 {!! $errors->first('amount_pay', '<span class="help-block">:message</span>') !!}
                              </div>
                           </div>
                           <div class="form-group {{ $errors->first('additional_amount', 'has-error') }}">
                              <label for="additional_amount" class="col-sm-2 control-label">Additional amount to be paid</label>
                              <div class="col-sm-10">
                                 <p id="additional_amount"></p>
                                 {!! $errors->first('additional_amount', '<span class="help-block">:message</span>') !!}
                              </div>
                           </div>-->
                           <div class="form-group {{ $errors->first('country_name', 'has-error') }}">
                              <label for="country_name" class="col-sm-2 control-label">Total cost of the swap</label>
                              <div class="col-sm-10">
                                 <p id="amount_pay">loading...</p>
                                 {!! $errors->first('country_name', '<span class="help-block">:message</span>') !!}
                              </div>
                           </div>
                           <div class="form-group {{ $errors->first('acceptTerms', 'has-error') }}">
                              <label for="acceptTerms" class="col-sm-2 control-label">Please tick if you agree to our <a style="color: #3c8dbc !important" href="{{ route(session('nav_section').'.terms-and-conditions', session('custom_lang')) }}">Ts&Cs</a></label>
                              <div class="col-sm-10">
                                 <!--<p id="additional_amount"></p>-->
                                 <input id="acceptTerms" name="acceptTerms" type="checkbox" class="form-control required number">
                                 {!! $errors->first('acceptTerms', '<span class="help-block">:message</span>') !!}
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


  <!--end date modal starts here-->
   <div class="modal fade" id="cancel_subscription" tabindex="-1" role="dialog" aria-labelledby="edit" aria-hidden="true">
      <div class="modal-dialog">
         <div class="modal-content">
            <div class="modal-header">
               <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
               <h4 class="modal-title custom_align" id="Heading">
                  Are you sure you want to cancel this membership?
               </h4>
            </div>
            <div class="modal-body">
               <form class="form" id="main_input_box2" action="{{ route('cancel-subscription') }}" method="POST">
                  <input type="hidden" name="_token" value="{{ csrf_token() }}">
                   
            </div>
            <div class="modal-footer ">
            <button type="submit" class="btn btn-warning">
            <span class="glyphicon glyphicon-ok-sign"></span>
            Yes
            </button>
            <button type="button" class="btn btn-warning" data-dismiss="modal">
            <span class="glyphicon glyphicon-remove"></span><?php //echo $id ?>
            No
            </button>
            </form>
            </div>
         </div>
      </div>
   </div>
   <!-- /.modal ends here -->


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
<script src="{{ asset('assets/js/pages/upgradedowngrade.js') }}"></script>
<script>
   jQuery(document).ready(function () {
           
           var packageindex = '<?php echo $getUserPackage->packageid ?>';
            var currentPackagePeriod = '<?php echo $subscriptionPeriodVal ?>';
            var packageStatus = '<?php echo $getUserPackage->pay_status ?>'

             if($(this).val() == (packageindex-1)){
                     //alert("current package")
                     if(currentPackagePeriod == 0){
                         //alert("hide monthly");
                         jQuery('#period option[value="0"]').attr("hidden", true);
                         $("#period").val('1');
                     }else{
                         //alert("hide yearly");
                         jQuery('#period option[value="1"]').attr("hidden", true);
                         $("#period").val('0');
                     }

                     //show the yearly and monthly if status is inactive 
                     if(packageStatus == 0){
                         jQuery('#period option[value="0"]').attr("hidden", false);
                         jQuery('#period option[value="1"]').attr("hidden", false);
                     }
                 }

             jQuery("#packages").change(function() {
                 //alert($(this).val());
                 if($(this).val() == (packageindex-1)){
                     //alert("current package")
                     if(currentPackagePeriod == 0){
                         //alert("hide monthly");
                         jQuery('#period option[value="0"]').attr("hidden", true);
                         $("#period").val('1');
                     }else{
                         //alert("hide yearly");
                         jQuery('#period option[value="1"]').attr("hidden", false);
                         $("#period").val('0');
                     }
                 }else{
                     jQuery('#period option[value="0"]').attr("hidden", false);
                     jQuery('#period option[value="1"]').attr("hidden", false);
                 }

                  //show the yearly and monthly if status is inactive 
                     if(packageStatus == 0){
                         jQuery('#period option[value="0"]').attr("hidden", false);
                         jQuery('#period option[value="1"]').attr("hidden", false);
                     }
             });
        });
</script>
@stop