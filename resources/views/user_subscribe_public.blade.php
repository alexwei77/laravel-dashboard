<?php $og = new OpenGraph(); 
$og->title('Start Free Trial - StaffLife.com')
        ->image("")
        ->description("Start using the platform for free through a 14 days trial period.")
        ->url();
?>
<!DOCTYPE html>
<html lang="en">
<head>
{!! $og->renderTags() !!}
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <title>Login | StaffLife</title>
      <!--global css starts-->
      @if(env('APP_ENV') === 'prod')
      <link rel="stylesheet" type="text/css" href="{{ secure_asset('assets/css/bootstrap.min.css') }}">
      <!-- Google Tag Manager -->
      <script>(function (w, d, s, l, i) {
         w[l] = w[l] || [];
         w[l].push({
             'gtm.start':
                 new Date().getTime(), event: 'gtm.js'
         });
         var f = d.getElementsByTagName(s)[0],
             j = d.createElement(s), dl = l != 'dataLayer' ? '&l=' + l : '';
         j.async = true;
         j.src =
             'https://www.googletagmanager.com/gtm.js?id=' + i + dl;
         f.parentNode.insertBefore(j, f);
         })(window, document, 'script', 'dataLayer', 'GTM-K6GM83G');
      </script>
      <!-- End Google Tag Manager -->
      @else
      <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/bootstrap.min.css') }}">
      @endif
      <link rel="shortcut icon" href="{{ asset('assets/images/favicon.png') }}" type="image/x-icon">
      <link rel="icon" href="{{ asset('assets/images/favicon.png') }}" type="image/x-icon">
      <!--end of global css-->
      <!--page level css starts-->
      @if(env('APP_ENV') === 'prod')
      <link type="text/css" rel="stylesheet" href="{{secure_asset('assets/vendors/iCheck/css/all.css')}}"/>
      <link href="{{ secure_asset('assets/vendors/bootstrapvalidator/css/bootstrapValidator.min.css') }}"
         rel="stylesheet"/>
      <link rel="stylesheet" type="text/css" href="{{ secure_asset('assets/css/frontend/login.css') }}">
      @else
      <link type="text/css" rel="stylesheet" href="{{asset('assets/vendors/iCheck/css/all.css')}}"/>
      <link href="{{ asset('assets/vendors/bootstrapvalidator/css/bootstrapValidator.min.css') }}" rel="stylesheet"/>
      <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/frontend/login.css') }}">
      <style>
       .btn-primary{
           background-color: #4CAF50;
       }
       .btn-primary:hover{
           background-color: #4CAF50;
       }
      </style>
      @endif
      <!--end of page level css-->
   </head>
   <body>
      @if(env('APP_ENV') === 'prod')
      <!-- Google Tag Manager (noscript) -->
      <noscript>
         <iframe src="https://www.googletagmanager.com/ns.html?id=GTM-K6GM83G"
            height="0" width="0" style="display:none;visibility:hidden"></iframe>
      </noscript>
      <!-- End Google Tag Manager (noscript) -->
      @endif
      <!-- Header Start -->
      <?php
         /*
          * This is an example page of the form fields required for a PayGate PayWeb 3 transaction.
          */
         
         /*
          * Sessions used here only because we can't get the PayGate ID, Transaction reference and secret key on the result page.
          *
          * First input so we make sure there is nothing in the session.
          */
         
         include_once base_path('app/MyLibrary/paygatelib/php/global.inc.php');
         include_once base_path('app/MyLibrary/paygatelib/paygate.payweb3.php');
         include_once base_path('app/MyLibrary/paygatelib2/php/global.inc.php');
         include_once base_path('app/MyLibrary/paygatelib2/paygate.payweb3.php');
         
         function get_ip_address()
         {
             // check for shared internet/ISP IP
             if (!empty($_SERVER['HTTP_CLIENT_IP']) && validate_ip($_SERVER['HTTP_CLIENT_IP'])) {
                 return $_SERVER['HTTP_CLIENT_IP'];
             }
         
             // check for IPs passing through proxies
             if (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
                 // check if multiple ips exist in var
                 if (strpos($_SERVER['HTTP_X_FORWARDED_FOR'], ',') !== false) {
                     $iplist = explode(',', $_SERVER['HTTP_X_FORWARDED_FOR']);
                     foreach ($iplist as $ip) {
                         if (validate_ip($ip))
                             return $ip;
                     }
                 } else {
                     if (validate_ip($_SERVER['HTTP_X_FORWARDED_FOR']))
                         return $_SERVER['HTTP_X_FORWARDED_FOR'];
                 }
             }
             if (!empty($_SERVER['HTTP_X_FORWARDED']) && validate_ip($_SERVER['HTTP_X_FORWARDED']))
                 return $_SERVER['HTTP_X_FORWARDED'];
             if (!empty($_SERVER['HTTP_X_CLUSTER_CLIENT_IP']) && validate_ip($_SERVER['HTTP_X_CLUSTER_CLIENT_IP']))
                 return $_SERVER['HTTP_X_CLUSTER_CLIENT_IP'];
             if (!empty($_SERVER['HTTP_FORWARDED_FOR']) && validate_ip($_SERVER['HTTP_FORWARDED_FOR']))
                 return $_SERVER['HTTP_FORWARDED_FOR'];
             if (!empty($_SERVER['HTTP_FORWARDED']) && validate_ip($_SERVER['HTTP_FORWARDED']))
                 return $_SERVER['HTTP_FORWARDED'];
         
             // return unreliable ip since all else failed
             return $_SERVER['REMOTE_ADDR'];
         }
         
         /**
          * Ensures an ip address is both a valid IP and does not fall within
          * a private network range.
          */
         function validate_ip($ip)
         {
             if (strtolower($ip) === 'unknown')
                 return false;
         
             // generate ipv4 network address
             $ip = ip2long($ip);
         
             // if the ip is set and not equivalent to 255.255.255.255
             if ($ip !== false && $ip !== -1) {
                 // make sure to get unsigned long representation of ip
                 // due to discrepancies between 32 and 64 bit OSes and
                 // signed numbers (ints default to signed in PHP)
                 $ip = sprintf('%u', $ip);
                 // do private network range checking
                 if ($ip >= 0 && $ip <= 50331647) return false;
                 if ($ip >= 167772160 && $ip <= 184549375) return false;
                 if ($ip >= 2130706432 && $ip <= 2147483647) return false;
                 if ($ip >= 2851995648 && $ip <= 2852061183) return false;
                 if ($ip >= 2886729728 && $ip <= 2887778303) return false;
                 if ($ip >= 3221225984 && $ip <= 3221226239) return false;
                 if ($ip >= 3232235520 && $ip <= 3232301055) return false;
                 if ($ip >= 4294967040) return false;
             }
             return true;
         }
         
         $ipaddress = get_ip_address();
         
         $records = IP2LocationLaravel::get('207.209.185.255');
         /*echo 'IP Number             : ' . $records['ipNumber'] . "<br>";
         echo 'IP Version            : ' . $records['ipVersion'] . "<br>";
         echo 'IP Address            : ' . $records['ipAddress'] . "<br>";
         echo 'Country Code          : ' . $records['countryCode'] . "<br>";
         echo 'Country Name          : ' . $records['countryName'] . "<br>";
         echo 'Region Name           : ' . $records['regionName'] . "<br>";
         echo 'City Name             : ' . $records['cityName'] . "<br>";
         echo 'Latitude              : ' . $records['latitude'] . "<br>";
         echo 'Longitude             : ' . $records['longitude'] . "<br>";
         echo 'ZIP Code              : ' . $records['zipCode'] . "<br>";*/
         
         //Get the country currency
         $userCountryCode;
         $currencyCode;
         foreach ($currencyInfo as $currency) {
             if ($currency->country == $records['countryName']) {
                 $userCountryCode = $records['countryCode'];
                 $currencyCode = $currency->code;
             }
         }
         
         if ($yearly) {
             $userCountryCode = 'USA';//just for now
         } else {
             $userCountryCode = 'ZAF';//just for now
         }
         //Amount depending on the country and currency chosen
         $requestAmount = 399;
         
         $userEMail = 'dev14@stafflife.com';
         
         $locale = 'en-za';
         
         ?>
      <?php
         //Get standard package details
         $countryPricesRow;
         foreach ($countryPrices as $singleCountryPrices) {
             if ($singleCountryPrices->country_code == $userCountryCode) {
                 //echo "subscription is supported in this country";
                 //echo $singleCountryPrices->std_price;
                 $countryPricesRow = $singleCountryPrices;
             } else {
                 //echo "sorry, subscription is not supported in your country";
             }
         }
         
         
         ?>
      <?php //select all account types from database
         //Basic number of contracts
         $subperiod = ['Monthly', 'Yearly'];
         $payreference = generateReference();
         ?>
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
         $_SESSION["standard_category"] = $packageChosen;
         $_SESSION["sub_countryid"] = $userCountryCode;
         
         //calculate the amount based on the period chosen
         $amountCost = 0;
         if ($yearly) {
             //determine the amount based on the package chosen
             if ($packageChosen == 'standard') {
                 $amountCost = ($countryPricesRow->std_price) * 10;
             }
             if ($packageChosen == 'business') {
                 $amountCost = ($countryPricesRow->bn_price) * 10;
             }
             if ($packageChosen == 'professional') {
                 $amountCost = ($countryPricesRow->pro_price) * 10;
             }
             if ($packageChosen == 'enterprise') {
                 $amountCost = ($countryPricesRow->ent_price) * 10;
             }
             if ($packageChosen == 'elite') {
                 $amountCost = str_replace(' ', '', ($countryPricesRow->el_price)) * 10;
             }
         } else {
             //determine the amount based on the package chosen
             if ($packageChosen == 'standard') {
                 $amountCost = ($countryPricesRow->std_price);
             }
             if ($packageChosen == 'business') {
                 $amountCost = ($countryPricesRow->bn_price);
             }
             if ($packageChosen == 'professional') {
                 $amountCost = ($countryPricesRow->pro_price);
             }
             if ($packageChosen == 'enterprise') {
                 $amountCost = ($countryPricesRow->ent_price);
             }
             if ($packageChosen == 'elite') {
                 $amountCost = str_replace(' ', '', ($countryPricesRow->el_price));
             }
         }
         $_SESSION["AMOUNT"] = $amountCost;
         //set the user's details in session variable
         
         $_SESSION["country"] = $userCountryCode;
         
         $encryption_key = 'secret';
         
         $currecyCode = $countryPricesRow->currency_code;
         $returnUrl = $fullPath['protocol'] . $fullPath['host'] . '/' . $root . '/dmmx/public/payresult';
         $transcationDate = getDateTime('Y-m-d H:i');
         $tranStartDate = getDateTime('Y-m-d');
         $tranEndDate = date('Y-m-d', strtotime("+12 months", strtotime(getDateTime('Y-m-d'))));
         $subscriptionFrequency = 0;
         if (!$yearly) {
             $subscriptionFrequency = 201;
         }
         
         $mandatoryFields = array(
             'VERSION' => '21',
             'PAYGATE_ID' => '10011072130',
             'REFERENCE' => $payreference,
             'AMOUNT' => $amountCost, //cehck if the amount reeived is valid
             'CURRENCY' => $currecyCode,
             'RETURN_URL' => $returnUrl,  //."/" .$subdata['category'] ."/" .$subdata['contractsQuantity']
             'TRANSACTION_DATE' => $transcationDate,
             //'EMAIL'             => "customer@mywebsite.com", //if not given it will be requested in the pages
             'SUBS_START_DATE' => $tranStartDate,
             'SUBS_END_DATE' => $tranEndDate,
             'SUBS_FREQUENCY' => $subscriptionFrequency,
             'PROCESS_NOW' => 'YES',
             'PROCESS_NOW_AMOUNT' => $amountCost,
         );
         
         $mandatoryFields1 = array(
             'PAYGATE_ID' => '10011072130',
             'REFERENCE' => $payreference,
             'AMOUNT' => $amountCost, //cehck if the amount reeived is valid
             'CURRENCY' => $currecyCode,
             'RETURN_URL' => $returnUrl,  //."/" .$subdata['category'] ."/" .$subdata['contractsQuantity']
             'TRANSACTION_DATE' => $transcationDate,
             //'EMAIL'             => "customer@mywebsite.com", //if not given it will be requested in the pages
             'LOCALE' => 'en-za',
             'COUNTRY' => $userCountryCode,
             'EMAIL' => $userEMail,
         );
         
         $optionalFields = array();
         $optionalFields1 = array(
             'PAY_METHOD' => (isset($_POST['PAY_METHOD']) ? filter_var($_POST['PAY_METHOD'], FILTER_SANITIZE_STRING) : ''),
             'PAY_METHOD_DETAIL' => (isset($_POST['PAY_METHOD_DETAIL']) ? filter_var($_POST['PAY_METHOD_DETAIL'], FILTER_SANITIZE_STRING) : ''),
             'NOTIFY_URL' => (isset($_POST['NOTIFY_URL']) ? filter_var($_POST['NOTIFY_URL'], FILTER_SANITIZE_URL) : ''),
             'USER1' => (isset($_POST['USER1']) ? filter_var($_POST['USER1'], FILTER_SANITIZE_URL) : ''),
             'USER2' => (isset($_POST['USER2']) ? filter_var($_POST['USER2'], FILTER_SANITIZE_URL) : ''),
             'USER3' => (isset($_POST['USER3']) ? filter_var($_POST['USER3'], FILTER_SANITIZE_URL) : ''),
             'VAULT' => (isset($_POST['VAULT']) ? filter_var($_POST['VAULT'], FILTER_SANITIZE_NUMBER_INT) : ''),
             'VAULT_ID' => (isset($_POST['VAULT_ID']) ? filter_var($_POST['VAULT_ID'], FILTER_SANITIZE_STRING) : '')
         );
         
         $data = array_merge($mandatoryFields, $optionalFields);
         $data1 = array_merge($mandatoryFields1, $optionalFields1);
         
         /*
          * Set the session vars once we have cleaned the inputs
          */
         $_SESSION['requestArray'] = $data; //Check what this need to be
         $_SESSION['COUNTRY'] = $userCountryCode;
         $_SESSION['requestArray1'] = $data1; //Check what this need to be
         $_SESSION['COUNTRY1'] = $userCountryCode;
         
         /*
          * Initiate the PayWeb 3 helper class
          */
         $PayWeb3 = new PayGate_PayWeb3();
         $PayWeb31 = new PayGate_PayWeb31();
         /*
          * if debug is set to true, the curl request and result as well as the calculated checksum source will be logged to the php error log
          */
         //$PayWeb3->setDebug(true);
         /*
          * Set the encryption key of your PayGate PayWeb3 configuration
          */
         $PayWeb3->setEncryptionKey($encryption_key);
         $PayWeb31->setEncryptionKey($encryption_key);
         /*
          * Set the array of fields to be posted to PayGate
          */
         $PayWeb3->setInitiateRequest($data);
         $PayWeb31->setInitiateRequest($data1);
         
         /*
          * Do the curl post to PayGate
          */
         //$returnData = $PayWeb3->doInitiate();
         $theChecksum = $PayWeb3->generateChecksum($data);
         $theChecksum1 = $PayWeb31->generateChecksum($data1);
         //echo $theChecksum;
         
         //echo $returnData;
         
         ?>
      <div class="container">
         <!--Content Section Start -->
         <div class="row">
            <div class="box">
               <div class="box1">
                  <a href="{{ route('home', session('custom_lang')) }}">
                  <img src="{{ asset('assets/images/logostaff.png') }}" alt="logo" class="img-responsive mar">
                  </a>
                  <p>Your details below will be used to create your company's Membership on StaffLife.</p>
                  <!-- Notifications -->
                  @include('notifications')
                  @if(!$yearly)
                  <form role="form" id="standardForm" class="form-horizontal"
                     action="{{ route('/business/subscribe', session('custom_lang')) }}" method="POST">
                     <input type="hidden" name="_method" value="PUT">
                     <input type="hidden" name="_token" value="{{ csrf_token() }}">
                     <input type="hidden" name="category" value="<?php echo $packageChosen; ?>">
                     <input type="hidden" name="subscription_amount" value="">
                     <input type="hidden" name="PAYGATE_ID" id="PAYGATE_ID"
                        value="<?php echo $data['PAYGATE_ID']; ?>"/>
                     <input type="hidden" name="REFERENCE" id="REFERENCE" value="<?php echo $data['REFERENCE']; ?>"/>
                     <input type="hidden" name="AMOUNT" id="AMOUNT" value="<?php echo $data['AMOUNT']; ?>"/>
                     <input type="hidden" name="CURRENCY" id="CURRENCY" value="<?php echo $data['CURRENCY']; ?>"/>
                     <input type="hidden" name="RETURN_URL" id="RETURN_URL"
                        value="<?php echo $fullPath['protocol'] . $fullPath['host'] . '/' . 'payresult'; ?>"/>
                     <input type="hidden" name="TRANSACTION_DATE" id="TRANSACTION_DATE"
                        value="<?php echo $data['TRANSACTION_DATE']; ?>"/>
                     <!--<input type="hidden" name="EMAIL" id="EMAIL" value="<?php //echo $userEMail; ?>"/>-->
                     <input type="hidden" name="SUBS_START_DATE" value="<?php echo $data['SUBS_START_DATE']; ?>">
                     <input type="hidden" name="SUBS_FREQUENCY" value="<?php echo $data['SUBS_FREQUENCY']; ?>">
                     <input type="hidden" name="SUBS_END_DATE" value="<?php echo $data['SUBS_END_DATE']; ?>">
                     <input type="hidden" name="PROCESS_NOW" value="<?php echo $data['PROCESS_NOW']; ?>">
                     <input type="hidden" name="VERSION" value="<?php echo $data['VERSION']; ?>">
                     <input type="hidden" name="PROCESS_NOW_AMOUNT"
                        value="<?php echo $data['PROCESS_NOW_AMOUNT']; ?>">
                     <input type="hidden" name="LOCALE" id="LOCALE" value="<?php echo $locale; ?>"/>
                     <input type="hidden" name="COUNTRY" id="COUNTRY" value="<?php echo $userCountryCode; ?>"/>
                     <input type="hidden" name="standard_category" id="standard_category"
                        value="<?php echo $packageChosen; ?>"/>
                     <input type="hidden" name="sub_countryid" id="sub_countryid"
                        value="<?php echo $countryPricesRow->id; ?>"/>
                     <input type="hidden" name="subperiod" id="sub_period" value="<?php echo $yearly; ?>">
                     <div class="row">
                     <div class="{{ $errors->first('first_name', 'has-error') }}">
                        <label class="sr-only"> {{ __('loginsignup.accountadminfirstname') }}</label>
                        <div class="col-md-6">
                           <div>
                              <input type="text" class="form-control" id="first_name" name="first_name"
                                 placeholder="{{ __('loginsignup.accountadminfirstname') }}"
                                 value="{!! old('first_name') !!}">
                           </div>
                        </div>
                        {!! $errors->first('first_name', '<span class="help-block">:message</span>') !!}
                     </div>
                     <div class="{{ $errors->first('last_name', 'has-error') }}">
                        <label class="sr-only"> {{ __('loginsignup.accountadminlastname') }}</label>
                        <div class="col-md-6">
                           <div>
                              <input type="text" class="form-control" id="last_name" name="last_name"
                                 placeholder="{{ __('loginsignup.accountadminlastname') }}"
                                 value="{!! old('last_name') !!}">
                           </div>
                        </div>
                        {!! $errors->first('last_name', '<span class="help-block">:message</span>') !!}
                     </div>
                     </div>
                     <br>
                     <div class="row">
                     <div class="{{ $errors->first('companyname', 'has-error') }}">
                        <label class="sr-only"> Company Name</label>
                        <div class="col-md-12">
                           <div>
                              <input type="text" class="form-control" id="companyname" name="companyname"
                                 placeholder="Company Name"
                                 value="{!! old('companyname') !!}">
                           </div>
                        </div>
                        {!! $errors->first('companyname', '<span class="help-block">:message</span>') !!}
                     </div>
                    
                     </div>
                     <br>
                     <div class="row">
                      <div class="{{ $errors->first('email', 'has-error') }}">
                        <label class="sr-only"> {{ __('loginsignup.signupemail') }}</label>
                        <div class="col-md-6">
                           <div>
                              <input type="email" class="form-control" id="Email" name="email"
                                 placeholder="{{ __('loginsignup.signupemail') }}"
                                 value="{!! old('Email') !!}">
                           </div>
                        </div>
                        {!! $errors->first('email', '<span class="help-block">:message</span>') !!}
                     </div>
                     <div class="{{ $errors->first('company_phone', 'has-error') }}">
                        <label class="sr-only">  Phone</label>
                        <div class="col-md-6">
                           <div>
                              <input type="tel" class="form-control" id="Password2" name="company_phone"
                                 placeholder="Phone">
                              {!! $errors->first('company_phone', '<span class="help-block">:message</span>') !!}
                           </div>
                        </div>
                     </div>
                     </div>
                     <br>
                     <div class="row">
                     <div class="{{ $errors->first('password', 'has-error') }}">
                        <label class="sr-only"> {{ __('loginsignup.password') }}</label>
                        <div class="col-md-6">
                           <div>
                              <input type="password" class="form-control" id="Password1" name="password"
                                 placeholder="{{ __('loginsignup.password') }}">
                              {!! $errors->first('password', '<span class="help-block">:message</span>') !!}
                           </div>
                        </div>
                     </div>
                     <div class="{{ $errors->first('password_confirm', 'has-error') }}">
                        <label class="sr-only">  {{ __('loginsignup.confirmpassword') }}</label>
                        <div class="col-md-6">
                           <div>
                              <input type="password" class="form-control" id="Password2" name="password_confirm"
                                 placeholder="{{ __('loginsignup.confirmpassword') }}">
                              {!! $errors->first('password_confirm', '<span class="help-block">:message</span>') !!}
                           </div>
                        </div>
                     </div>
                     </div>
                     <br>
                     <div class="form-group {{ $errors->first('country', 'has-error') }}">
                        <!--<label for="country" class="col-sm-2 control-label">Country</label>-->
                        <div class="col-sm-12">
                           {!! Form::select('country', $countries, strtoupper(session('custom_lang')),['class' => 'form-control select2', 'id' => 'countries']) !!}
                        </div>
                        <span class="help-block">{{ $errors->first('country', ':message') }}</span>
                     </div>
                     <div class="form-group text-center {{ $errors->first('acceptTerms', 'has-error') }}">
                        <label for="acceptTerms">I agree to the StaffLife <a href="{{ route(session('nav_section').'.terms-and-conditions', session('custom_lang')) }}" target="_blank">Terms & Conditions</a></label>
                        <div class="col-sm-12">
                           <!--<p id="additional_amount"></p>-->
                           <input id="acceptTerms" name="acceptTerms" type="checkbox">
                           {!! $errors->first('acceptTerms', '<span class="help-block">:message</span>') !!}
                        </div>
                     </div>
                     <div class="form-group">
                        <!--<div class="col-lg-offset-2 col-lg-10">-->
                        <div>
                           <button class="btn btn-primary" type="submit">Submit</button>
                        </div>
                     </div>
                  </form>
                  {{--{!!  Form::close()  !!}--}}
                  @endif
                  @if($yearly)
                  <form role="form" id="standardForm" class="form-horizontal"
                     action="{{ route('/business/subscribe', session('custom_lang')) }}" method="POST">
                     <input type="hidden" name="_method" value="PUT">
                     <input type="hidden" name="_token" value="{{ csrf_token() }}">
                     <input type="hidden" name="category" value="<?php echo $packageChosen; ?>">
                     <input type="hidden" name="subscription_amount" value="">
                     <input type="hidden" name="PAYGATE_ID" id="PAYGATE_ID" value="10011072130"/>
                     <input type="hidden" name="REFERENCE" id="REFERENCE"
                        value="<?php echo $data1['REFERENCE']; ?>"/>
                     <input type="hidden" name="AMOUNT" id="AMOUNT" value="<?php echo $data1['AMOUNT']; ?>"/>
                     <input type="hidden" name="CURRENCY" id="CURRENCY"
                        value="<?php echo $countryPricesRow->currency_code; ?>"/>
                     <input type="hidden" name="RETURN_URL" id="RETURN_URL"
                        value="<?php echo $fullPath['protocol'] . '/' .'payresult'; ?>"/>
                     <input type="hidden" name="TRANSACTION_DATE" id="TRANSACTION_DATE"
                        value="<?php echo $data1['TRANSACTION_DATE']; ?>"/>
                     <input type="hidden" name="LOCALE" id="LOCALE" value="<?php echo $locale; ?>"/>
                     <input type="hidden" name="COUNTRY" id="COUNTRY" value="<?php echo $userCountryCode; ?>"/>
                     <input type="hidden" name="EMAIL" id="EMAIL" value="<?php echo $userEMail; ?>"/>
                     <input type="hidden" name="CHECKSUM" value="<?php echo $theChecksum1; ?>">
                     <input type="hidden" name="standard_category" id="standard_category"
                        value="<?php echo $packageChosen; ?>">
                     <input type="hidden" name="sub_countryid" id="sub_countryid"
                        value="<?php echo $countryPricesRow->id; ?>">
                     <input type="hidden" name="subperiod" id="sub_period" value="<?php echo $yearly; ?>">
                     <div class="row">
                     <div class="{{ $errors->first('first_name', 'has-error') }}">
                        <label class="sr-only"> {{ __('loginsignup.accountadminfirstname') }}</label>
                        <div class="col-md-6">
                           <div>
                              <input type="text" class="form-control" id="first_name" name="first_name"
                                 placeholder="{{ __('loginsignup.accountadminfirstname') }}"
                                 value="{!! old('first_name') !!}">
                           </div>
                        </div>
                        {!! $errors->first('first_name', '<span class="help-block">:message</span>') !!}
                     </div>
                     <div class="{{ $errors->first('last_name', 'has-error') }}">
                        <label class="sr-only"> {{ __('loginsignup.accountadminlastname') }}</label>
                        <div class="col-md-6">
                           <div>
                              <input type="text" class="form-control" id="last_name" name="last_name"
                                 placeholder="{{ __('loginsignup.accountadminlastname') }}"
                                 value="{!! old('last_name') !!}">
                           </div>
                        </div>
                        {!! $errors->first('last_name', '<span class="help-block">:message</span>') !!}
                     </div>
                     </div>
                     <br>
                     <div class="row">
                     <div class="{{ $errors->first('companyname', 'has-error') }}">
                        <label class="sr-only"> Company Name</label>
                        <div class="col-md-12">
                           <div>
                              <input type="text" class="form-control" id="companyname" name="companyname"
                                 placeholder="Company Name"
                                 value="{!! old('companyname') !!}">
                           </div>
                        </div>
                        {!! $errors->first('companyname', '<span class="help-block">:message</span>') !!}
                     </div>
                     
                     </div>
                     <br>
                     <div class="row">
                     <div class="{{ $errors->first('email', 'has-error') }}">
                        <label class="sr-only"> {{ __('loginsignup.signupemail') }}</label>
                        <div class="col-md-6">
                           <div>
                              <input type="email" class="form-control" id="Email" name="email"
                                 placeholder="{{ __('loginsignup.signupemail') }}"
                                 value="{!! old('Email') !!}">
                           </div>
                        </div>
                        {!! $errors->first('email', '<span class="help-block">:message</span>') !!}
                     </div>
                     <div class="{{ $errors->first('company_phone', 'has-error') }}">
                        <label class="sr-only">  Phone</label>
                        <div class="col-md-6">
                           <div>
                              <input type="tel" class="form-control" id="Password2" name="company_phone"
                                 placeholder="Phone">
                              {!! $errors->first('company_phone', '<span class="help-block">:message</span>') !!}
                           </div>
                        </div>
                     </div>
                     </div>
                     <br>
                     <div class="row">
                     <div class="{{ $errors->first('password', 'has-error') }}">
                        <label class="sr-only"> {{ __('loginsignup.password') }}</label>
                        <div class="col-md-6">
                           <div>
                              <input type="password" class="form-control" id="Password1" name="password"
                                 placeholder="{{ __('loginsignup.password') }}">
                              {!! $errors->first('password', '<span class="help-block">:message</span>') !!}
                           </div>
                        </div>
                     </div>
                     <div class="{{ $errors->first('password_confirm', 'has-error') }}">
                        <label class="sr-only">  {{ __('loginsignup.confirmpassword') }}</label>
                        <div class="col-md-6">
                           <div>
                              <input type="password" class="form-control" id="Password2" name="password_confirm"
                                 placeholder="{{ __('loginsignup.confirmpassword') }}">
                              {!! $errors->first('password_confirm', '<span class="help-block">:message</span>') !!}
                           </div>
                        </div>
                     </div>
                     </div>
                     <br>
                     <div class="form-group {{ $errors->first('country', 'has-error') }}">
                        <!--<label for="country" class="col-sm-2 control-label">Country</label>-->
                        <div class="col-sm-12">
                           {!! Form::select('country', $countries, strtoupper(session('custom_lang')),['class' => 'form-control select2', 'id' => 'countries']) !!}
                        </div>
                        <span class="help-block">{{ $errors->first('country', ':message') }}</span>
                     </div>
                     <div class="form-group text-center {{ $errors->first('acceptTerms', 'has-error') }}">
                        <label for="acceptTerms">I agree to the StaffLife <a href="{{ route(session('nav_section').'.terms-and-conditions', session('custom_lang')) }}" target="_blank">Terms & Conditions</a></label>
                        <div class="col-sm-12">
                           <!--<p id="additional_amount"></p>-->
                           <input id="acceptTerms" name="acceptTerms" type="checkbox">
                           {!! $errors->first('acceptTerms', '<span class="help-block">:message</span>') !!}
                        </div>
                     </div>
                     <div class="form-group text-center">
                        <!--<div class="col-lg-offset-2 col-lg-10">-->
                        <div>
                           <button class="btn btn-primary" type="submit">Start my free trial</button>
                        </div>
                     </div>
                  </form>
                  {{--{!!  Form::close()  !!}--}}
                  @endif
               </div>
               <!--<div class="bg-light animation flipInX">
                  <a href="{{ route('home', session('custom_lang')) }}" id="forgot_pwd_title">{{ __('loginsignup.goback') }}</a>
                  </div>-->
            </div>
         </div>
         <!-- //Content Section End -->
      </div>
      <!--global js starts-->
      @if(env('APP_ENV') === 'prod')
      <script type="text/javascript" src="{{ secure_asset('assets/js/frontend/jquery.min.js') }}"></script>
      <script type="text/javascript" src="{{ secure_asset('assets/js/frontend/bootstrap.min.js') }}"></script>
      <script src="{{ secure_asset('assets/vendors/bootstrapvalidator/js/bootstrapValidator.min.js') }}"
         type="text/javascript"></script>
      <script type="text/javascript" src="{{ secure_asset('assets/vendors/iCheck/js/icheck.js') }}"></script>
      <script type="text/javascript" src="{{ secure_asset('assets/js/frontend/login_custom.js') }}"></script>
      <script src="{{ secure_asset('assets/vendors/bootstrapvalidator/js/bootstrapValidator.min.js') }}"
         type="text/javascript"></script>
      <script type="text/javascript" src="{{ secure_asset('assets/js/frontend/user_subscribe.js') }}"></script>
      @else
      <script type="text/javascript" src="{{ asset('assets/js/frontend/jquery.min.js') }}"></script>
      <script type="text/javascript" src="{{ asset('assets/js/frontend/bootstrap.min.js') }}"></script>
      <script src="{{ asset('assets/vendors/bootstrapvalidator/js/bootstrapValidator.min.js') }}"
         type="text/javascript"></script>
      <script type="text/javascript" src="{{ asset('assets/vendors/iCheck/js/icheck.js') }}"></script>
      <script type="text/javascript" src="{{ asset('assets/js/frontend/login_custom.js') }}"></script>
      <script src="{{ asset('assets/vendors/bootstrapvalidator/js/bootstrapValidator.min.js') }}"
         type="text/javascript"></script>
      <script type="text/javascript" src="{{ asset('assets/js/frontend/user_subscribe.js') }}"></script>
      @endif
      <!--global js end-->
   </body>
</html>