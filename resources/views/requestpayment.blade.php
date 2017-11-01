<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login | Welcome to Josh Frontend</title>
    <!--global css starts-->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/bootstrap.min.css') }}">
    <link rel="shortcut icon" href="{{ asset('assets/images/favicon.png') }}" type="image/x-icon">
    <link rel="icon" href="{{ asset('assets/images/favicon.png') }}" type="image/x-icon">
    <!--end of global css-->
    <!--page level css starts-->
    <link type="text/css" rel="stylesheet" href="{{asset('assets/vendors/iCheck/css/all.css')}}" />
    <link href="{{ asset('assets/vendors/bootstrapvalidator/css/bootstrapValidator.min.css') }}" rel="stylesheet"/>
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/frontend/login.css') }}">
    <!--end of page level css-->
</head>
<body>

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
		
		/*print_r($subdata);
		die;*/

	if(count($subdata) > 0){
	$_SESSION["standard_category"] = $subdata['standard_category'];
	$_SESSION["sub_countryid"] = $subdata['sub_countryid'];
	$_SESSION["AMOUNT"] = $subdata['AMOUNT'];
	//set the user's details in session variable
	$_SESSION["user"] = $subdata['user'];
	$_SESSION["country"] = $subdata['COUNTRY'];
	$_SESSION['requestArray'] = $subdata;
	$_SESSION["sub_countryid"] = $subdata['sub_countryid'];
	}else{
	$_SESSION["standard_category"] = $subdata1['standard_category'];
	$_SESSION["sub_countryid"] = $subdata1['sub_countryid'];
	$_SESSION["AMOUNT"] = $subdata1['AMOUNT'];
	//set the user's details in session variable
	$_SESSION["user"] = $subdata1['user'];
	$_SESSION["country"] = $subdata1['COUNTRY'];
	$_SESSION['requestArray'] = $subdata1;
	$_SESSION["sub_countryid"] = $subdata1['sub_countryid'];
	}

     include_once base_path('app/MyLibrary/paygatelib/php/global.inc.php');
     include_once base_path('app/MyLibrary/paygatelib/paygate.payweb3.php');
     include_once base_path('app/MyLibrary/paygatelib2/php/global.inc.php');
     include_once base_path('app/MyLibrary/paygatelib2/paygate.payweb3.php');

	$encryption_key = 'secret';
				   

    if(count($subdata) > 0){
	$mandatoryFields = array(
		'VERSION'            => $subdata['VERSION'],
		'PAYGATE_ID'        => $subdata['PAYGATE_ID'],
		'REFERENCE'         => $subdata['REFERENCE'],
		'AMOUNT'            => ($subdata['AMOUNT'] * 100), //cehck if the amount reeived is valid
		'CURRENCY'          => $subdata['CURRENCY'],
		'RETURN_URL'        => $subdata['RETURN_URL'],  //."/" .$subdata['category'] ."/" .$subdata['contractsQuantity']
		'TRANSACTION_DATE'  => $subdata['TRANSACTION_DATE'],
		//'EMAIL'             => "customer@mywebsite.com", //if not given it will be requested in the pages
		'SUBS_START_DATE'   => $subdata['SUBS_START_DATE'],
		'SUBS_END_DATE'     => $subdata['SUBS_END_DATE'],
		'SUBS_FREQUENCY'    => $subdata['SUBS_FREQUENCY'],
		'PROCESS_NOW'       => $subdata['PROCESS_NOW'],
		'PROCESS_NOW_AMOUNT' => ($subdata['AMOUNT'] * 100),
	);

	$optionalFields = array(
		
	);

	$data = array_merge($mandatoryFields, $optionalFields);

	$_SESSION['requestArray'] = $data;
	$_SESSION['COUNTRY']      = $subdata['COUNTRY'];

	$PayWeb3 = new PayGate_PayWeb3();
	
	$PayWeb3->setEncryptionKey($encryption_key);
	
	$PayWeb3->setInitiateRequest($data);

	$theChecksum = $PayWeb3->generateChecksum($data);
	
	}else{


 $mandatoryFields1 = array(
		'PAYGATE_ID'        => $subdata1['PAYGATE_ID'],
		'REFERENCE'         => $subdata1['REFERENCE'],
		'AMOUNT'            => ($subdata1['AMOUNT'])*100, //cehck if the amount reeived is valid
		'CURRENCY'          => $subdata1['CURRENCY'],
		'RETURN_URL'        => $subdata1['RETURN_URL'],  //."/" .$subdata['category'] ."/" .$subdata['contractsQuantity']
		'TRANSACTION_DATE'  => $subdata1['TRANSACTION_DATE'],
		//'EMAIL'             => "customer@mywebsite.com", //if not given it will be requested in the pages
		'LOCALE'   => $subdata1['LOCALE'],
		'COUNTRY'     => $subdata1['COUNTRY'],
		'EMAIL'    => $subdata1['EMAIL'],
	);

    $optionalFields = array(
    );
	$optionalFields1 = array(
		'PAY_METHOD'        => (isset($_POST['PAY_METHOD']) ? filter_var($_POST['PAY_METHOD'], FILTER_SANITIZE_STRING) : ''),
		'PAY_METHOD_DETAIL' => (isset($_POST['PAY_METHOD_DETAIL']) ? filter_var($_POST['PAY_METHOD_DETAIL'], FILTER_SANITIZE_STRING) : ''),
		'NOTIFY_URL'        => (isset($_POST['NOTIFY_URL']) ? filter_var($_POST['NOTIFY_URL'], FILTER_SANITIZE_URL) : ''),
		'USER1'             => (isset($_POST['USER1']) ? filter_var($_POST['USER1'], FILTER_SANITIZE_URL) : ''),
		'USER2'             => (isset($_POST['USER2']) ? filter_var($_POST['USER2'], FILTER_SANITIZE_URL) : ''),
		'USER3'             => (isset($_POST['USER3']) ? filter_var($_POST['USER3'], FILTER_SANITIZE_URL) : ''),
		'VAULT'             => (isset($_POST['VAULT']) ? filter_var($_POST['VAULT'], FILTER_SANITIZE_NUMBER_INT) : ''),
		'VAULT_ID'          => (isset($_POST['VAULT_ID']) ? filter_var($_POST['VAULT_ID'], FILTER_SANITIZE_STRING) : '')
	);

	$data1 = array_merge($mandatoryFields1, $optionalFields1);
	//print_r($data1);

	$_SESSION['requestArray1'] = $data1;
	$_SESSION['COUNTRY1']      = $subdata1['COUNTRY'];

	$PayWeb31 = new PayGate_PayWeb31();
	
	$PayWeb31->setEncryptionKey($encryption_key);
	
	$requestPre = $PayWeb31->setInitiateRequest($data1);

	$theChecksum1 = $PayWeb31->generateChecksum($data1);
	$returnData = $PayWeb31->doInitiate();
	//echo "printing the request ";
	$dataPostedBack = $PayWeb31->processRequest;
	/*print_r($dataPostedBack);
	die;*/
	//echo $dataPostedBack['PAY_REQUEST_ID'];
	
	}

?>

<div class="container">
    <!--Content Section Start -->
    <div class="row">
        <div class="box animation">
            <div class="box1">
            <img src="{{ asset('assets/images/logodmmx.jpg') }}" alt="logo" class="img-responsive mar">
            <h3 class="text-primary">Notice</h3>
                <!-- Notifications -->
                @include('notifications')
                @if(count($subdata) > 0)
				<form  role="form" id="submit-subscription" class="form-horizontal text-left" action='https://www.2checkout.com/checkout/purchase' method='post'>
                     <input type='hidden' name='sid' value='103325953' />
                     <input type='hidden' name='li_0_product_id' value='<?php echo $user->id; ?>' />	
                     <input type='hidden' name='mode' value='2CO' />
					 <input type='hidden' name='name' value='<?php echo $getPackageChosen->name; ?>' />
					 <input type='hidden' name='package_id' value='<?php echo $getPackageChosen->id; ?>' />
                     <input type='hidden' name='li_0_type' value='product' />
                     <input type='hidden' name='li_0_name' value='<?php echo "Upgrade to " .$getPackageChosen->name ." Subscription Package"; ?>' />
                     <input type='hidden' name='li_0_price' value='<?php echo (float)$subdata['AMOUNT']; ?>' />
                     <input type='hidden' name='currency_code' value='USD' />
                     <input type='hidden' name='merchant_order_id' value='<?php echo $subdata['REFERENCE']; ?>' />
                     <input type='hidden' name='x_receipt_link_url' value='<?php echo $subdata['RETURN_URL']; ?>' />
                     <input type='hidden' name='card_holder_name' value='<?php echo $user->first_name ." " .$user->last_name; ?>' />
                     <input type='hidden' name='email' value='<?php echo $user->email; ?>' />
					 <input type='hidden' name='employees_avail' value='<?php echo $getPackageChosen->terms_forms; ?>' />
					 <input type='hidden' name='li_0_recurrence' value='1 month' />
					 <input type='hidden' name='admins_avail' value='<?php echo $getPackageChosen->admins; ?>' />
					 <input type='hidden' name='old_order_number' value='<?php echo $getUserPackage->order_number; ?>' />
                     <input type='hidden' name='demo' value='N' />
					 <input type='hidden' name='package_price' value='<?php echo $getPackageChosen->price; ?>' />
					 <input type='hidden' name='month_year' value='0' />
					 <input type='hidden' name='upgrade' value='Y' />
					 <label class="control-label">{{ __('loginsignup.noticetext') }}</label>
                    <hr>
                      <div class="form-group">
                        <div class=" col-sm-offset-4 col-sm-4">
                           <input class="btn btn-success btn-block" style="background-color:#ee6f00;" type="submit" name="btnSubmit" value="Submit" />
                        </div>
                     </div>
                  </form>
				@endif

				@if(count($subdata1) > 0)
				<form  role="form" id="submit-subscription" class="form-horizontal text-left" action='https://www.2checkout.com/checkout/purchase' method='post'>
                     <input type='hidden' name='sid' value='103325953' />
                     <input type='hidden' name='li_0_product_id' value='<?php echo $user->id; ?>' />	
                     <input type='hidden' name='mode' value='2CO' />
					 <input type='hidden' name='name' value='<?php echo $getPackageChosen->name; ?>' />
					 <input type='hidden' name='package_id' value='<?php echo $getPackageChosen->id; ?>' />
                     <input type='hidden' name='li_0_type' value='product' />
                     <input type='hidden' name='li_0_name' value='<?php echo "Upgrade to " .$getPackageChosen->name ." Subscription Package"; ?>' />
                     <input type='hidden' name='li_0_price' value='<?php echo (float)$subdata1['AMOUNT']; ?>' />
                     <input type='hidden' name='currency_code' value='USD' />
                     <input type='hidden' name='merchant_order_id' value='<?php echo $subdata1['REFERENCE']; ?>' />
                     <input type='hidden' name='x_receipt_link_url' value='<?php echo $subdata1['RETURN_URL']; ?>' />
                     <input type='hidden' name='card_holder_name' value='<?php echo $user->first_name ." " .$user->last_name; ?>' />
                     <input type='hidden' name='email' value='<?php echo $user->email; ?>' />
					 <input type='hidden' name='employees_avail' value='<?php echo $getPackageChosen->terms_forms; ?>' />
					 <input type='hidden' name='admins_avail' value='<?php echo $getPackageChosen->admins; ?>' />
					 <input type='hidden' name='old_order_number' value='<?php echo $getUserPackage->order_number; ?>' />
					 <input type='hidden' name='li_0_recurrence' value='1 Year' />
                     <input type='hidden' name='demo' value='N' />
					 <input type='hidden' name='month_year' value='1' />
					 <input type='hidden' name='upgrade' value='Y' />
					 <input type='hidden' name='package_price' value='<?php echo ($getPackageChosen->price)*10; ?>' />
					 <label class="control-label">{{ __('loginsignup.noticetext') }}</label>
                    <hr>
                      <div class="form-group">
                        <div class=" col-sm-offset-4 col-sm-4">
                           <input class="btn btn-success btn-block" style="background-color:#ee6f00;" type="submit" name="btnSubmit" value="Submit" />
                        </div>
                     </div>
                  </form>
				@endif
            </div>
        <div class="bg-light animation flipInX">
            <a href="{{ route('upgrade-downgrade') }}" id="forgot_pwd_title">Go Back</a>
        </div>
        </div>
    </div>
    <!-- //Content Section End -->
</div>
<!--global js starts-->
<script type="text/javascript" src="{{ asset('assets/js/frontend/jquery.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/js/frontend/bootstrap.min.js') }}"></script>
<script src="{{ asset('assets/vendors/bootstrapvalidator/js/bootstrapValidator.min.js') }}" type="text/javascript"></script>
<script type="text/javascript" src="{{ asset('assets/vendors/iCheck/js/icheck.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/js/frontend/login_custom.js') }}"></script>
<!--global js end-->

<script language="javascript" type="text/javascript">
 jQuery(document).ready(function () {
     jQuery("#submit-subscription").submit();
});

jQuery(document).ready(function () {
     jQuery("#submit-subscription-yearly").submit();
});
</script>

</body>
</html>
