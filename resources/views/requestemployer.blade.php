@extends('admin/layouts/defaultx')
{{-- Page title --}}
@section('title')
Subscribe
@stop
{{-- page level styles --}}
@section('header_styles')
<link href="{{ asset('assets/vendors/jasny-bootstrap/css/jasny-bootstrap.css') }}" rel="stylesheet"/>
<link href="{{ asset('assets/vendors/x-editable/css/bootstrap-editable.css') }}" rel="stylesheet"/>
<link href="{{ asset('assets/css/pages/user_profile.css') }}" rel="stylesheet"/>
@stop
{{-- Page content --}}
@section('content')
<?php
   /*
    * Once the client is ready to be redirected to the payment page, we get all the information needed and initiate the transaction with PayGate.
    * This checks that all the information is valid and that a transaction can take place.
    * If the initiate is successful we are returned a request ID and a checksum which we will use to redirect the client to PayWeb3.
    */
   
   /*
    * Sessions used here only because we can't get the PayGate ID, Transaction reference and secret key on the result page.
    */
   session_name('paygate_payweb3_testing_sample');
   session_start();
   $_SESSION["standard_category"] = $subdata['standard_category'];
   $_SESSION["sub_countryid"] = $subdata['sub_countryid'];
   $_SESSION["AMOUNT"] = $subdata['AMOUNT'];
   //set the user's details in session variable
   $_SESSION["user"] = $subdata['user'];
   $_SESSION["country"] = $subdata['COUNTRY'];

    include_once base_path('app/MyLibrary/paygatelib/php/global.inc.php');
   
   /*
    * Include the helper PayWeb 3 class
    */
    include_once base_path('app/MyLibrary/paygatelib/paygate.payweb3.php');
   
   $encryption_key = 'secret';

   //determine the AMOUNT and the PROCESS_NOW_AMOUNT

   	$packagePeriod = '';
    $amountValue = 0;
    $payNowValue = 0;
  
   if($subdata['subperiod'] == 0){
       $packagePeriod = 'monthly';
       $amountValue = ($subdata['AMOUNT'] * 100);
       $payNowValue = ($subdata['PROCESS_NOW_AMOUNT'] * 100);
   }else{
      $packagePeriod = 'yearly'; 
      $processPeriod = 
      $amountValue = $subdata['AMOUNT'] * 100;
      $payNowValue = ($subdata['PROCESS_NOW_AMOUNT'] * 100) * 10;
   }				   
   
   $mandatoryFields = array(
   	'VERSION'            => $subdata['VERSION'],
   	'PAYGATE_ID'        => $subdata['PAYGATE_ID'],
   	'REFERENCE'         => $subdata['REFERENCE'],
   	'AMOUNT'            => $amountValue, //cehck if the amount reeived is valid
   	'CURRENCY'          => $subdata['CURRENCY'],
   	'RETURN_URL'        => $subdata['RETURN_URL'],  //."/" .$subdata['category'] ."/" .$subdata['contractsQuantity']
   	'TRANSACTION_DATE'  => $subdata['TRANSACTION_DATE'],
   	//'EMAIL'             => "customer@mywebsite.com", //if not given it will be requested in the pages
   	'SUBS_START_DATE'   => $subdata['SUBS_START_DATE'],
   	'SUBS_END_DATE'     => $subdata['SUBS_END_DATE'],
   	'SUBS_FREQUENCY'    => $subdata['SUBS_FREQUENCY'],
   	'PROCESS_NOW'       => $subdata['PROCESS_NOW'],
   	'PROCESS_NOW_AMOUNT' => $payNowValue,
   );
   
   $optionalFields = array(
   	
   );
   
   $data = array_merge($mandatoryFields, $optionalFields);
   
   /*
    * Set the session vars once we have cleaned the inputs
    */
   $_SESSION['requestArray'] = $data;
   $_SESSION['COUNTRY']      = $subdata['COUNTRY'];
   $_SESSION['subperiod']    = $subdata['subperiod'];
   
   /*
    * Initiate the PayWeb 3 helper class
    */
   $PayWeb3 = new PayGate_PayWeb3();
   /*
    * if debug is set to true, the curl request and result as well as the calculated checksum source will be logged to the php error log
    */
   //$PayWeb3->setDebug(true);
   /*
    * Set the encryption key of your PayGate PayWeb3 configuration
    */
   $PayWeb3->setEncryptionKey($encryption_key);
   /*
    * Set the array of fields to be posted to PayGate
    */
   $PayWeb3->setInitiateRequest($data);
   
   /*
    * Do the curl post to PayGate
    */
   //$returnData = $PayWeb3->doInitiate();
   $theChecksum = $PayWeb3->generateChecksum($data);
   //echo $theChecksum;
   
   //echo $returnData;
   
   
   ?>
<section class="content-header">
   <h1>Confirm membership</h1>
   <ol class="breadcrumb">
      <li>
         <a href="{{ route('admin.dashboard') }}">
         <i class="livicon" data-name="home" data-size="14" data-loop="true"></i>
         Dashboard
         </a>
      </li>
      <li class='active'>confirm membership</li>
   </ol>
</section>
<!--section ends-->
<section class="content">
   <div class="row">
   <div class="col-lg-12">
      <form role="form" class="form-horizontal text-left" action="<?php echo $PayWeb3::$process_url ?>" method="post" name="paygate_process_form">
         <!--<input type="hidden" name="_token" value="{{ csrf_token() }}">-->
         <input type="hidden" name="VERSION" value="<?php echo $data['VERSION']; ?>">
         <input type="hidden" name="PAYGATE_ID" value="<?php echo $data['PAYGATE_ID']; ?>">
         <input type="hidden" name="REFERENCE" value="<?php echo $data['REFERENCE']; ?>">
         <input type="hidden" name="AMOUNT" value="<?php echo $data['AMOUNT']; ?>">
         <input type="hidden" name="CURRENCY" value="<?php echo $data['CURRENCY']; ?>">
         <input type="hidden" name="RETURN_URL" value="<?php echo $data['RETURN_URL']; ?>">
         <input type="hidden" name="TRANSACTION_DATE" value="<?php echo $data['TRANSACTION_DATE']; ?>">
         <input type="hidden" name="SUBS_START_DATE" value="<?php echo $data['SUBS_START_DATE']; ?>">
         <input type="hidden" name="SUBS_END_DATE" value="<?php echo $data['SUBS_END_DATE']; ?>">
         <input type="hidden" name="SUBS_FREQUENCY" value="<?php echo $data['SUBS_FREQUENCY']; ?>">
         <input type="hidden" name="PROCESS_NOW" value="<?php echo $data['PROCESS_NOW']; ?>">
         <input type="hidden" name="PROCESS_NOW_AMOUNT" value="<?php echo $data['PROCESS_NOW_AMOUNT']; ?>">
         <input type="hidden" name="CHECKSUM" value="<?php echo $theChecksum; ?>">
         <div class="form-group">
            <label for="REFERENCE" class="col-sm-3 control-label">Package</label>
            <p id="REFERENCE" class="form-control-static"><?php echo $subdata['category']; ?></p>
         </div>
         <div class="form-group">
            <label for="AMOUNT" class="col-sm-3 control-label">Cost Per Month</label>
            <p id="AMOUNT" class="form-control-static"><?php echo ($data['AMOUNT']/100); ?><?php echo " " .$data['CURRENCY']; ?></p>
         </div>
         <div class="form-group">
            <label for="AMOUNT" class="col-sm-3 control-label">Amount to be paid now</label>
            <p id="AMOUNT" class="form-control-static"><?php echo ($data['PROCESS_NOW_AMOUNT'])/100; ?><?php echo " " .$data['CURRENCY']; ?></p>
         </div>
         <div class="form-group">
            <label for="AMOUNT" class="col-sm-3 control-label">Membership cycle</label>
            <p id="AMOUNT" class="form-control-static"><?php echo $packagePeriod; ?></p>
         </div>
         <div class="form-group">
            <div class=" col-sm-offset-4 col-sm-4">
               <input class="btn btn-success btn-block" style="background-color:#ee6f00;" type="submit" name="btnSubmit" value="Submit" />
            </div>
            </div
      </form>
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

        $("#subscribe").addClass("active");
    </script>
@stop