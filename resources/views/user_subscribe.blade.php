@extends('admin/layouts/defaultx')

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
<?php
   /*
    * This is an example page of the form fields required for a PayGate PayWeb 3 transaction.
    */
   
   /*
    * Sessions used here only because we can't get the PayGate ID, Transaction reference and secret key on the result page.
    *
    * First input so we make sure there is nothing in the session.
    */
   session_name('paygate_payweb3_testing_sample');
   session_start();
   session_destroy();

    include_once base_path('app/MyLibrary/paygatelib/php/global.inc.php');
   
   function get_ip_address() {
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
   function validate_ip($ip) {
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
   foreach($currencyInfo as $currency){
    if($currency->country == $records['countryName']){
        $userCountryCode = $records['countryCode'];
        $currencyCode = $currency->code;
    }
   }
   
   $userCountryCode ='USA';//just for now
   //Amount depending on the country and currency chosen 
   $requestAmount = 399;
   
   $userEMail = 'dev14@stafflife.com';
   
   $locale = 'en-za';
   
   ?>
<?php 
   //Get standard package details 
   $countryPricesRow;
   foreach($countryPrices as $singleCountryPrices){
   if($singleCountryPrices->country_code == $userCountryCode){
   //echo "subscription is supported in this country";
   //echo $singleCountryPrices->std_price;
   $countryPricesRow = $singleCountryPrices;
   }else{
       //echo "sorry, subscription is not supported in your country";
        }
    }
   
    //package chosen to purchase 
    /*if(isset($packageView)){
        echo $packageView;
    }*/


    //we need to perform a test of whether the user is in subscription already or not, if in subscription, get the subscription reference and use it for the submission
    use App\User;
    use Illuminate\Support\Facades\DB;

    $user = Sentinel::getUser();
    $subscriptionCheck = DB::table('dmmx_paysubscriptions')->where('userid', $user->id)->get();
    $theUserReference = generateReference();
    if($subscriptionCheck->count()){
    $theUserReference = $subscriptionCheck[0]->REFERENCE;
    }

    //check which subscription package the user has. for now use a check for the amount of admins, but this must be changed later 
    //numerical values for all packages 
    $standardNum = 1;
    $businessNum = 2;
    $professionalNum = 3;
    $enterpriseNum = 4;
    $eliteNum = 5;
    $whichPackage = 0;
    if($subscriptionCheck->count()){
       if($subscriptionCheck[0]->quantity_admins == 1){
         $whichPackage = 1;
       }
       if($subscriptionCheck[0]->quantity_admins == 2){
         $whichPackage = 2;
       }
       if($subscriptionCheck[0]->quantity_admins == 3){
         $whichPackage = 3;
       }
       if($subscriptionCheck[0]->quantity_admins == 5){
         $whichPackage = 4;
       }
       if($subscriptionCheck[0]->quantity_admins < 0){
         $whichPackage = 5;
       }
    }
    
   ?>
    <?php //select all account types from database
          //Basic number of contracts 
            $subperiod = ['Monthly', 'Yearly'];
    ?>
    <section class="content-header">
        <!--section starts-->
        <?php
        if($subscriptionCheck->count()){
            echo "<h1>Update your package</h1>";
        }else{
            echo "<h1>Subscribe</h1>";
        }
        ?>
        <ol class="breadcrumb">
            <li>
                <a href="{{ route('admin.dashboard') }}">
                    <i class="livicon" data-name="home" data-size="14" data-loop="true"></i>
                    Dashboard
                </a>
            </li>
            <?php
        if($subscriptionCheck->count()){
            echo "<li class='active'>Upgrade</li>";
        }else{
            echo "<li class='active'>Subscribe</li>";
        }
        ?>
        </ol>
    </section>
    <!--section ends-->
    <section class="content">
        <div class="row">
            <div class="col-lg-12">
                <ul class="nav  nav-tabs ">
                    <li class="active">
                    <?php if($whichPackage == $standardNum){
                      echo "<a id='standard' href='#tab' data-toggle='tab'>Your current Package (Standard)</a>";
                    }else{
                        if(!$whichPackage){
                            echo "<a id='standard' href='#tab' data-toggle='tab'>Standard</a>";
                        }else{
                            echo "<a id='standard' href='#tab' data-toggle='tab'>Downgrade to Standard</a>";
                        }
                    }
                    ?>
                    </li>
                    <li>
                    <?php if($whichPackage == $businessNum){
                      echo "<a id='business' href='#tab2' data-toggle='tab'>Your current Package (Business)</a>";
                    }else{
                        if(!$whichPackage){
                            echo "<a id='business' href='#tab2' data-toggle='tab'>Business</a>";
                        }else{
                            //check whether it is an option for downgrade or for upgrade
                            if($whichPackage > $businessNum){
                            echo "<a id='business' href='#tab2' data-toggle='tab'>Downgrade to business</a>";
                            }else{
                               echo "<a id='business' href='#tab2' data-toggle='tab'>Upgrade to business</a>"; 
                            }
                        }
                    }
                    
                    ?>
                    </li>
                    <li>
                    <?php if($whichPackage == $professionalNum){
                      echo "<a id='professional' href='#tab3' data-toggle='tab'>Your current Package (Professional)</a>";
                    }else{
                        if(!$whichPackage){
                            echo "<a id='professional' href='#tab3' data-toggle='tab'>Professional</a>";
                        }else{
                            //check whether it is an option for downgrade or for upgrade
                            if($whichPackage > $professionalNum){
                            echo "<a id='professional' href='#tab3' data-toggle='tab'>Downgrade to professional</a>";
                            }else{
                               echo "<a id='professional' href='#tab3' data-toggle='tab'>Upgrade to professional</a>"; 
                            }
                        }
                    }
                    
                    ?>
                    </li>
                    <li>
                    <?php if($whichPackage == $enterpriseNum){
                      echo "<a id='enterprise' href='#tab4' data-toggle='tab'>Your current Package (Enterprise)</a>";
                    }else{
                        if(!$whichPackage){
                            echo "<a id='enterprise' href='#tab4' data-toggle='tab'>Enterprise</a>";
                        }else{
                            //check whether it is an option for downgrade or for upgrade
                            if($whichPackage > $enterpriseNum){
                            echo "<a id='enterprise' href='#tab4' data-toggle='tab'>Downgrade to enterprise</a>";
                            }else{
                               echo "<a id='enterprise' href='#tab4' data-toggle='tab'>Upgrade to enterprise</a>"; 
                            }
                        }
                    }
                    ?>
                    </li>
                    <li>
                    <?php if($whichPackage == $eliteNum){
                      echo "<a id='elite' href='#tab5' data-toggle='tab'>Your current Package (Elite)</a>";
                    }else{
                        if(!$whichPackage){
                            echo "<a id='elite' href='#tab5' data-toggle='tab'>Elite</a>";
                        }else{
                            //check whether it is an option for downgrade or for upgrade
                            if($whichPackage > $eliteNum){
                            echo "<a id='elite' href='#tab5' data-toggle='tab'>Downgrade to elite</a>";
                            }else{
                               echo "<a id='elite' href='#tab5' data-toggle='tab'>Upgrade to elite</a>"; 
                            }
                        }
                    }
                    
                    ?>
                    <!--<li>
                        <a href="{{ URL::to('admin/user_profile') }}" >
                            <i class="livicon" data-name="gift" data-size="16" data-loop="true" data-c="#000" data-hc="#000"></i>
                            Advanced User Profile</a>
                    </li>-->

                </ul>
                <div  class="tab-content mar-top">
                    <div id="tab" class="tab-pane fade active in">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="panel">
                                <?php if($whichPackage == $standardNum){ ?>

                                     <div class="form-group">
                              <label class="control-label  col-md-2">Package:  </label>
                              <div class="col-md-6">
                                 <div>
                                     <p class="text-primary">Standard</p>
                                 </div>
                              </div>
                           </div>
                            <br>
                           <div class="form-group">
                              <label class="control-label  col-md-2">Reference:  </label>
                              <div class="col-md-6">
                                 <div>
                                     <p class="text-primary"><?php echo $subscriptionCheck[0]->REFERENCE ?></p>
                                 </div>
                              </div>
                           </div>
                           <br>
                           <div class="form-group">
                              <label class="control-label  col-md-2">Amount:  </label>
                              <div class="col-md-6">
                                 <div>
                                     <p class="text-primary"><?php echo ($subscriptionCheck[0]->AMOUNT)/100  ." " .$subscriptionCheck[0]->sub_currencycode ?></p>
                                 </div>
                              </div>
                           </div>
                           <br>
                           <div class="form-group">
                              <label class="control-label  col-md-2">Number of Allowed Admins:  </label>
                              <div class="col-md-6">
                                 <div>
                                     <p class="text-primary"><?php echo $subscriptionCheck[0]->quantity_admins ?></p>
                                 </div>
                              </div>
                           </div>
                           <br><br>
                           <div class="form-group">
                              <label class="control-label  col-md-2">Admins Available:  </label>
                              <div class="col-md-6">
                                 <div>
                                     <p class="text-primary"><?php echo $subscriptionCheck[0]->admins_avail ?></p>
                                 </div>
                              </div>
                           </div>
                           <br>
                           <div class="form-group">
                              <label class="control-label  col-md-2">Employees:  </label>
                              <div class="col-md-6">
                                 <div>
                                     <p class="text-primary"><?php echo $subscriptionCheck[0]->employees	 ?></p>
                                 </div>
                              </div>
                           </div>
                           <br>
                           <div class="form-group">
                              <label class="control-label  col-md-2">Employees Available:  </label>
                              <div class="col-md-6">
                                 <div>
                                     <p class="text-primary"><?php echo $subscriptionCheck[0]->employees_avail	 ?></p>
                                 </div>
                              </div>
                           </div>
                           <br>
                           <div class="form-group">
                              <label class="control-label  col-md-2">Support:  </label>
                              <div class="col-md-6">
                                 <div>
                                     <p class="text-primary"><?php echo $subscriptionCheck[0]->support	 ?></p>
                                 </div>
                              </div>
                           </div>
                           <br>
                           <div class="form-group">
                              <label class="control-label  col-md-2">Membership Start date:  </label>
                              <div class="col-md-6">
                                 <div>
                                     <p class="text-primary"><?php echo $subscriptionCheck[0]->SUBS_START_DATE	 ?></p>
                                 </div>
                              </div>
                           </div>
                           <br><br>
                           <div class="form-group">
                              <label class="control-label  col-md-2">Membership expiry date:  </label>
                              <div class="col-md-6">
                                 <div>
                                     <p class="text-primary"><?php echo $subscriptionCheck[0]->SUBS_END_DATE	 ?></p>
                                 </div>
                              </div>
                           </div>
                           <br><br>
                           <div class="form-group">
                              <label class="control-label  col-md-2">Membership Frequency:  </label>
                              <div class="col-md-6">
                                 <div>
                                     <p class="text-primary"><?php echo $subscriptionCheck[0]->SUBS_FREQUENCY	 ?></p>
                                 </div>
                              </div>
                           </div>

                             <?php }else{
                        if(!$whichPackage){ ?>

                               <form role="form" id="standardForm" class="form-horizontal"
                           action="{{ route('subscribe') }}" method="POST">
                           <input type="hidden" name="_method" value="PUT">
                           <input type="hidden" name="_token" value="{{ csrf_token() }}">
                           <input type="hidden" name="category" value="standard">
                           <input type="hidden" name="subscription_amount" value="">
                           <input type="hidden" name="PAYGATE_ID" id="PAYGATE_ID" value="10011072130"/>
                           <input type="hidden" name="REFERENCE" id="REFERENCE" value="<?php echo $theUserReference; ?>"/>
                           <input type="hidden" name="AMOUNT" id="AMOUNT" value="<?php echo $countryPricesRow->std_price; ?>"/>
                           <input type="hidden" name="CURRENCY" id="CURRENCY" value="<?php echo $countryPricesRow->currency_code; ?>"/>
                           <input type="hidden" name="RETURN_URL" id="RETURN_URL" value="<?php echo $fullPath['protocol'] . $fullPath['host'] . '/' . $root . '/dmmx/public/payresult-employer'; ?>"/>
                           <input type="hidden" name="TRANSACTION_DATE" id="TRANSACTION_DATE" value="<?php echo getDateTime('Y-m-d H:i'); ?>"/>
                           <!--<input type="hidden" name="EMAIL" id="EMAIL" value="<?php //echo $userEMail; ?>"/>-->
                           <input type="hidden" name="SUBS_START_DATE" value="<?php echo getDateTime('Y-m-d'); ?>">
                           <input type="hidden" name="SUBS_FREQUENCY" value="229">
                           <input type="hidden" name="SUBS_END_DATE" value="2018-05-04">
                           <input type="hidden" name="PROCESS_NOW" value="YES">
                           <input type="hidden" name="VERSION" value="21">
                           <input type="hidden" name="PROCESS_NOW_AMOUNT" value="<?php echo $countryPricesRow->std_price; ?>">
                           <input type="hidden" name="LOCALE" id="LOCALE" value="<?php echo $locale; ?>"/>
                           <input type="hidden" name="COUNTRY" id="COUNTRY" value="<?php echo $userCountryCode; ?>"/>
                           <input type="hidden" name="standard_category" id="standard_category" value="standard"/>
                           <input type="hidden" name="downupgrade" id="downupgrade" value="null"/>
                           <input type="hidden" name="sub_countryid" id="sub_countryid" value="<?php echo $countryPricesRow->id; ?>"/>
                          
                           <div class="form-group {{ $errors->first('basicContracts', 'has-error') }}">
                              <label class="control-label  col-md-2">Period: </label>
                              <div class="col-md-6">
                                 {!! Form::select('subperiod', $subperiod, null,['class' => 'form-control select2', 'id' => 'subperiod']) !!}
                                 <span class="help-block">{{ $errors->first('subperiod', ':message') }}</span>
                              </div>
                           </div>
                           <div class="form-group {{ $errors->first('basicContracts', 'has-error') }}">
                              <label class="control-label  col-md-2">Price: </label>
                              <div class="col-md-6">
                                 <div>
                                    <h4 class="text-primary" id="basicPrice"><?php echo $countryPricesRow->std_price; ?><?php echo " " .$countryPricesRow->currency_code; ?></h4>
                                 </div>
                              </div>
                           </div>
                
                           <div class="form-group {{ $errors->first('basicContracts', 'has-error') }}">
                              <label class="control-label  col-md-2">Terms Forms (Active & checks): </label>
                              <div class="col-md-6">
                                 <div>
                                    <h4 class="text-primary" id="basicPrice"><?php echo $countryPricesRow->std_terms; ?></h4>
                                 </div>
                              </div>
                           </div>
                           <div class="form-group {{ $errors->first('basicContracts', 'has-error') }}">
                              <label class="control-label  col-md-2">Cost per employee or check $: </label>
                              <div class="col-md-6">
                                 <div>
                                    <h4 class="text-primary" id="basicPrice"><?php echo $countryPricesRow->std_cost_employee; ?></h4>
                                 </div>
                              </div>
                           </div>
                           <div class="form-group {{ $errors->first('basicContracts', 'has-error') }}">
                              <label class="control-label  col-md-2">Support: </label>
                              <div class="col-md-6">
                                 <div>
                                    <h4 class="text-primary" id="basicPrice"><?php echo $countryPricesRow->std_support; ?></h4>
                                 </div>
                              </div>
                           </div>
                           <div class="form-group {{ $errors->first('basicContracts', 'has-error') }}">
                              <label class="control-label  col-md-2">Users(admins): </label>
                              <div class="col-md-6">
                                 <div>
                                    <h4 class="text-primary" id="basicPrice"><?php echo $countryPricesRow->std_users; ?></h4>
                                 </div>
                              </div>
                           </div>
                           @if(Sentinel::guest())
                           <h3 class="text-primary"><strong> We realized that you are not logged in or you do not have an account, please quickly fill in the fields below to sign up or <a href="{{ route('login') }}">signin</a></strong></h3>
                           <div class="form-group {{ $errors->first('companyname', 'has-error') }}">
                              <label class="control-label  col-md-2">Company Name: </label>
                              <div class="col-md-6">
                                 <div>
                                    <input type="text" class="form-control" id="companyname" name="companyname" placeholder="Company Name*"
                                       value="{!! old('companyname') !!}" >
                                 </div>
                              </div>
                           </div>
                           <div class="form-group {{ $errors->first('registrationnumber', 'has-error') }}">
                              <label class="control-label  col-md-2"> Company Registration Number:</label>
                              <div class="col-md-6">
                                 <div>
                                    <input type="text" class="form-control" id="registrationnumber" name="registrationnumber" placeholder="Company Registration*"
                                       value="{!! old('registrationnumber') !!}" >
                                 </div>
                              </div>
                              {!! $errors->first('registrationnumber', '<span class="help-block">:message</span>') !!}
                           </div>
                           <div class="form-group {{ $errors->first('first_name', 'has-error') }}">
                              <label class="control-label  col-md-2"> Account Admin First Name</label>
                              <div class="col-md-6">
                                 <div>
                                    <input type="text" class="form-control" id="first_name" name="first_name" placeholder="Account Admin First Name*"
                                       value="{!! old('first_name') !!}" >
                                 </div>
                              </div>
                              {!! $errors->first('first_name', '<span class="help-block">:message</span>') !!}
                           </div>
                           <div class="form-group {{ $errors->first('last_name', 'has-error') }}">
                              <label class="control-label  col-md-2"> Account Admin Last Name</label>
                              <div class="col-md-6">
                                 <div>
                                    <input type="text" class="form-control" id="last_name" name="last_name" placeholder="Account Admin Last Name*"
                                       value="{!! old('last_name') !!}" >
                                 </div>
                              </div>
                              {!! $errors->first('last_name', '<span class="help-block">:message</span>') !!}
                           </div>
                           <div class="form-group {{ $errors->first('email', 'has-error') }}">
                              <label class="control-label  col-md-2"> Email</label>
                              <div class="col-md-6">
                                 <div>
                                    <input type="email" class="form-control" id="Email" name="email" placeholder="Email*"
                                       value="{!! old('Email') !!}" >
                                 </div>
                              </div>
                              {!! $errors->first('email', '<span class="help-block">:message</span>') !!}
                           </div>
                           <div class="form-group {{ $errors->first('password', 'has-error') }}">
                              <label class="control-label  col-md-2"> Password</label>
                              <div class="col-md-6">
                                 <div>
                                    <input type="password" class="form-control" id="Password1" name="password" placeholder="Password*">
                                    {!! $errors->first('password', '<span class="help-block">:message</span>') !!}
                                 </div>
                              </div>
                           </div>
                           <div class="form-group {{ $errors->first('password_confirm', 'has-error') }}">
                              <label class="control-label  col-md-2">  Confirm Password</label>
                              <div class="col-md-6">
                                 <div>
                                    <input type="password" class="form-control" id="Password2" name="password_confirm"
                                       placeholder="Confirm Password*">
                                    {!! $errors->first('password_confirm', '<span class="help-block">:message</span>') !!}
                                 </div>
                              </div>
                           </div>
                           @endif
                           <div class="form-group">
                              <div class="col-lg-offset-2 col-lg-10">
                                 <button class="btn btn-primary" type="submit">Subscribe</button>
                              </div>
                           </div>
                        </form>
                        {{--{!!  Form::close()  !!}--}}
                            

                        <?php }else{ ?>
                           <!--downgrade to standard-->
                           <!--<p>Details of the process are yet to be given </p>-->
                                            <?php 
						   ///When you downgrade, a check of whether you can downgrade or not is performed
						   //get the number of available employees
						   $employeesAvailStandC = $subscriptionCheck[0]->employees_avail;
						   //get the number of available admins
						   $adminsAvailStandC = $subscriptionCheck[0]->admins_avail;
						   $standardEmployessLimit = str_replace(' ', '',substr($countryPricesRow->std_employees, strpos($countryPricesRow->std_employees, "-")+1));
						   $standardAdminsLimit = $countryPricesRow->std_users;
                           if((($employeesAvailStandC+1) <  $standardEmployessLimit || $adminsAvailStandC < $standardAdminsLimit) && $employeesAvailStandC >= 0){
							   echo "You cannot downgrade to this package";
						   }else{
							$PAYNOW_AMOUNT = ($subscriptionCheck[0]->AMOUNT)/100 - ($countryPricesRow->std_price);
				      ?>
				 <form role="form" id="standardDowngrade" class="form-horizontal"
                           action="{{ route('subscribe') }}" method="POST">
                           <input type="hidden" name="_method" value="PUT">
                           <input type="hidden" name="_token" value="{{ csrf_token() }}">
                           <input type="hidden" name="category" value="standard">
                           <input type="hidden" name="subscription_amount" value="">
                           <input type="hidden" name="PAYGATE_ID" id="PAYGATE_ID" value="10011072130"/>
                           <input type="hidden" name="REFERENCE" id="REFERENCE" value="<?php echo $theUserReference; ?>"/>
                           <input type="hidden" name="AMOUNT" id="AMOUNT" value="<?php echo $countryPricesRow->std_price; ?>"/>
                           <input type="hidden" name="CURRENCY" id="CURRENCY" value="<?php echo $countryPricesRow->currency_code; ?>"/>
                           <input type="hidden" name="RETURN_URL" id="RETURN_URL" value="<?php echo $fullPath['protocol'] . $fullPath['host'] . '/' . $root . '/dmmx/public/payresult-employer'; ?>"/>
                           <input type="hidden" name="TRANSACTION_DATE" id="TRANSACTION_DATE" value="<?php echo getDateTime('Y-m-d H:i'); ?>"/>
                           <!--<input type="hidden" name="EMAIL" id="EMAIL" value="<?php //echo $userEMail; ?>"/>-->
                           <input type="hidden" name="SUBS_START_DATE" value="<?php echo getDateTime('Y-m-d'); ?>">
                           <input type="hidden" name="SUBS_FREQUENCY" value="229">
                           <input type="hidden" name="SUBS_END_DATE" value="2018-05-04">
                           <input type="hidden" name="PROCESS_NOW" value="YES">
                           <input type="hidden" name="VERSION" value="21">
                           <input type="hidden" name="PROCESS_NOW_AMOUNT" value="<?php echo $PAYNOW_AMOUNT ; ?>">
                           <input type="hidden" name="LOCALE" id="LOCALE" value="<?php echo $locale; ?>"/>
                           <input type="hidden" name="COUNTRY" id="COUNTRY" value="<?php echo $userCountryCode; ?>"/>
                           <input type="hidden" name="standard_category" id="standard_category" value="standard"/>
                           <input type="hidden" name="downupgrade" id="downupgrade" value="downgrade"/>
                           <input type="hidden" name="sub_countryid" id="sub_countryid" value="<?php echo $countryPricesRow->id; ?>"/>
                          
                           <div class="form-group {{ $errors->first('basicContracts', 'has-error') }}">
                              <label class="control-label  col-md-2">Period: </label>
                              <div class="col-md-6">
                                 {!! Form::select('subperiod', $subperiod, null,['class' => 'form-control select2', 'id' => 'subperiod']) !!}
                                 <span class="help-block">{{ $errors->first('subperiod', ':message') }}</span>
                              </div>
                           </div>
                           <div class="form-group {{ $errors->first('basicContracts', 'has-error') }}">
                              <label class="control-label  col-md-2">Price: </label>
                              <div class="col-md-6">
                                 <div>
                                    <h4 class="text-primary" id="basicPrice"><?php echo $countryPricesRow->std_price; ?><?php echo " " .$countryPricesRow->currency_code; ?></h4>
                                 </div>
                              </div>
                           </div>
                           <!--<div class="form-group {{ $errors->first('basicContracts', 'has-error') }}">
                              <label class="control-label  col-md-2">Refund Amount: </label>
                              <div class="col-md-6">
                                 <div>
                                    <h4 class="text-primary" id="basicPrice"><?php echo $PAYNOW_AMOUNT ; ?><?php echo " " .$countryPricesRow->currency_code; ?></h4>
                                 </div>
                              </div>
                           </div>-->
                           <div class="form-group {{ $errors->first('basicContracts', 'has-error') }}">
                              <label class="control-label  col-md-2">Employees: </label>
                              <div class="col-md-6">
                                 <div>
                                    <h4 class="text-primary" id="basicPrice"><?php echo $countryPricesRow->std_employees; ?></h4>
                                 </div>
                              </div>
                           </div>
                           <div class="form-group {{ $errors->first('basicContracts', 'has-error') }}">
                              <label class="control-label  col-md-2">Base: </label>
                              <div class="col-md-6">
                                 <div>
                                    <h4 class="text-primary" id="basicPrice"><?php echo $countryPricesRow->std_base; ?></h4>
                                 </div>
                              </div>
                           </div>
                           <div class="form-group {{ $errors->first('basicContracts', 'has-error') }}">
                              <label class="control-label  col-md-2">Annual Payment Discount: </label>
                              <div class="col-md-6">
                                 <div>
                                    <h4 class="text-primary" id="basicPrice"><?php echo $countryPricesRow->std_discount; ?></h4>
                                 </div>
                              </div>
                           </div>
                           <div class="form-group {{ $errors->first('basicContracts', 'has-error') }}">
                              <label class="control-label  col-md-2">Terms Forms (Active & checks): </label>
                              <div class="col-md-6">
                                 <div>
                                    <h4 class="text-primary" id="basicPrice"><?php echo $countryPricesRow->std_terms; ?></h4>
                                 </div>
                              </div>
                           </div>
                           <div class="form-group {{ $errors->first('basicContracts', 'has-error') }}">
                              <label class="control-label  col-md-2">Cost per employee or check $: </label>
                              <div class="col-md-6">
                                 <div>
                                    <h4 class="text-primary" id="basicPrice"><?php echo $countryPricesRow->std_cost_employee; ?></h4>
                                 </div>
                              </div>
                           </div>
                           <div class="form-group {{ $errors->first('basicContracts', 'has-error') }}">
                              <label class="control-label  col-md-2">Support: </label>
                              <div class="col-md-6">
                                 <div>
                                    <h4 class="text-primary" id="basicPrice"><?php echo $countryPricesRow->std_support; ?></h4>
                                 </div>
                              </div>
                           </div>
                           <div class="form-group {{ $errors->first('basicContracts', 'has-error') }}">
                              <label class="control-label  col-md-2">Users(admins): </label>
                              <div class="col-md-6">
                                 <div>
                                    <h4 class="text-primary" id="basicPrice"><?php echo $countryPricesRow->std_users; ?></h4>
                                 </div>
                              </div>
                           </div>
                           <div class="form-group">
                              <div class="col-lg-offset-2 col-lg-10">
                                 <button class="btn btn-primary" type="submit">Downgrade</button>
                              </div>
                           </div>
                        </form>
                        {{--{!!  Form::close()  !!}--}}
						
						   <?php } ?>


                       <?php }
                    }
                    ?>
                                     
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="tab2" class="tab-pane fade">
                        <div class="row">
                            <div class="col-md-12 pd-top">

                            <?php if($whichPackage == $businessNum){ ?>


                       <!--Business Pcakgage subscription details-->
                       <div class="form-group">
                              <label class="control-label  col-md-2">Package:  </label>
                              <div class="col-md-6">
                                 <div>
                                     <p class="text-primary">Business</p>
                                 </div>
                              </div>
                           </div>
                            <br>
                           <div class="form-group">
                              <label class="control-label  col-md-2">Reference:  </label>
                              <div class="col-md-6">
                                 <div>
                                     <p class="text-primary"><?php echo $subscriptionCheck[0]->REFERENCE ?></p>
                                 </div>
                              </div>
                           </div>
                           <br>
                           <div class="form-group">
                              <label class="control-label  col-md-2">Amount:  </label>
                              <div class="col-md-6">
                                 <div>
                                     <p class="text-primary"><?php echo ($subscriptionCheck[0]->AMOUNT)/100  ." " .$subscriptionCheck[0]->sub_currencycode ?></p>
                                 </div>
                              </div>
                           </div>
                           <br>
                           <div class="form-group">
                              <label class="control-label  col-md-2">Number of Allowed Admins:  </label>
                              <div class="col-md-6">
                                 <div>
                                     <p class="text-primary"><?php echo $subscriptionCheck[0]->quantity_admins ?></p>
                                 </div>
                              </div>
                           </div>
                           <br>
                           <div class="form-group">
                              <label class="control-label  col-md-2">Admins Available:  </label>
                              <div class="col-md-6">
                                 <div>
                                     <p class="text-primary"><?php echo $subscriptionCheck[0]->admins_avail ?></p>
                                 </div>
                              </div>
                           </div>
                           <br>
                           <div class="form-group">
                              <label class="control-label  col-md-2">Employees:  </label>
                              <div class="col-md-6">
                                 <div>
                                     <p class="text-primary"><?php echo $subscriptionCheck[0]->employees	 ?></p>
                                 </div>
                              </div>
                           </div>
                           <br>
                           <div class="form-group">
                              <label class="control-label  col-md-2">Employees Available:  </label>
                              <div class="col-md-6">
                                 <div>
                                     <p class="text-primary"><?php echo $subscriptionCheck[0]->employees_avail	 ?></p>
                                 </div>
                              </div>
                           </div>
                           <br>
                           <div class="form-group">
                              <label class="control-label  col-md-2">Support:  </label>
                              <div class="col-md-6">
                                 <div>
                                     <p class="text-primary"><?php echo $subscriptionCheck[0]->support	 ?></p>
                                 </div>
                              </div>
                           </div>
                           <br>
                           <div class="form-group">
                              <label class="control-label  col-md-2">Membership Start date:  </label>
                              <div class="col-md-6">
                                 <div>
                                     <p class="text-primary"><?php echo $subscriptionCheck[0]->SUBS_START_DATE	 ?></p>
                                 </div>
                              </div>
                           </div>
                           <br>
                           <div class="form-group">
                              <label class="control-label  col-md-2">Membership expiry date:  </label>
                              <div class="col-md-6">
                                 <div>
                                     <p class="text-primary"><?php echo $subscriptionCheck[0]->SUBS_END_DATE	 ?></p>
                                 </div>
                              </div>
                           </div>
                           <br>
                           <div class="form-group">
                              <label class="control-label  col-md-2">Membership Frequency:  </label>
                              <div class="col-md-6">
                                 <div>
                                     <p class="text-primary"><?php echo $subscriptionCheck[0]->SUBS_FREQUENCY	 ?></p>
                                 </div>
                              </div>
                           </div>


                    <?php }else{
                        if(!$whichPackage){?>


                            <!--Normal Business Form -->
                            <form role="form" id="businessForm" class="form-horizontal"
                           action="{{ route('subscribe') }}" method="POST">
                           <input type="hidden" name="_method" value="PUT">
                           <input type="hidden" name="_token" value="{{ csrf_token() }}">
                           <input type="hidden" name="category" value="business">
                           <input type="hidden" name="subscription_amount" value="">
                           <input type="hidden" name="PAYGATE_ID" id="PAYGATE_ID" value="10011072130"/>
                           <input type="hidden" name="REFERENCE" id="REFERENCE" value="<?php echo $theUserReference; ?>"/>
                           <input type="hidden" name="AMOUNT" id="AMOUNT" value="<?php echo $countryPricesRow->bn_price; ?>"/>
                           <input type="hidden" name="CURRENCY" id="CURRENCY" value="<?php echo $countryPricesRow->currency_code; ?>"/>
                           <input type="hidden" name="RETURN_URL" id="RETURN_URL" value="<?php echo $fullPath['protocol'] . $fullPath['host'] . '/' . $root . '/dmmx/public/payresult-employer'; ?>"/>
                           <input type="hidden" name="TRANSACTION_DATE" id="TRANSACTION_DATE" value="<?php echo getDateTime('Y-m-d H:i'); ?>"/>
                           <input type="hidden" name="SUBS_START_DATE" value="<?php echo getDateTime('Y-m-d'); ?>">
                           <input type="hidden" name="SUBS_FREQUENCY" value="229">
                           <input type="hidden" name="SUBS_END_DATE" value="2018-05-04">
                           <input type="hidden" name="PROCESS_NOW" value="YES">
                           <input type="hidden" name="VERSION" value="21">
                           <input type="hidden" name="PROCESS_NOW_AMOUNT" value="<?php echo $countryPricesRow->bn_price; ?>">
                           <input type="hidden" name="LOCALE" id="LOCALE" value="en-za"/>
                           <input type="hidden" name="COUNTRY" id="COUNTRY" value="<?php echo $countryPricesRow->country_code; ?>"/>
                           <input type="hidden" name="standard_category" id=standard_category value="business"/>
                           <input type="hidden" name="downupgrade" id="downupgrade" value="null"/>
                           <input type="hidden" name="sub_countryid" id="sub_countryid" value="<?php echo $countryPricesRow->id; ?>"/>
                           <div class="form-group {{ $errors->first('standardContracts', 'has-error') }}">
                              <label class="control-label  col-md-2">Period: </label>
                              <div class="col-md-6">
                                 {!! Form::select('subperiod', $subperiod, null,['class' => 'form-control select2', 'id' => 'subperiod']) !!}
                                 <span class="help-block">{{ $errors->first('subperiod', ':message') }}</span>
                              </div>
                           </div>
                           <div class="form-group {{ $errors->first('basicContracts', 'has-error') }}">
                              <label class="control-label  col-md-2">Price: </label>
                              <div class="col-md-6">
                                 <div>
                                    <h4 class="text-primary" id="basicPrice"><?php echo $countryPricesRow->bn_price; ?><?php echo " " .$countryPricesRow->currency_code; ?></h4>
                                 </div>
                              </div>
                           </div>
                           <div class="form-group {{ $errors->first('basicContracts', 'has-error') }}">
                              <label class="control-label  col-md-2">Employees: </label>
                              <div class="col-md-6">
                                 <div>
                                    <h4 class="text-primary" id="basicPrice"><?php echo $countryPricesRow->bn_employees; ?></h4>
                                 </div>
                              </div>
                           </div>
                           <div class="form-group {{ $errors->first('basicContracts', 'has-error') }}">
                              <label class="control-label  col-md-2">Base: </label>
                              <div class="col-md-6">
                                 <div>
                                    <h4 class="text-primary" id="basicPrice"><?php echo $countryPricesRow->bn_base; ?></h4>
                                 </div>
                              </div>
                           </div>
                           <div class="form-group {{ $errors->first('basicContracts', 'has-error') }}">
                              <label class="control-label  col-md-2">Annual Payment Discount</label>
                              <div class="col-md-6">
                                 <div>
                                    <h4 class="text-primary" id="basicPrice"><?php echo $countryPricesRow->bn_discount; ?></h4>
                                 </div>
                              </div>
                           </div>
                           <div class="form-group {{ $errors->first('basicContracts', 'has-error') }}">
                              <label class="control-label  col-md-2">Terms Forms (Active & checks): </label>
                              <div class="col-md-6">
                                 <div>
                                    <h4 class="text-primary" id="basicPrice"><?php echo $countryPricesRow->bn_terms; ?></h4>
                                 </div>
                              </div>
                           </div>
                           <div class="form-group {{ $errors->first('basicContracts', 'has-error') }}">
                              <label class="control-label  col-md-2">Cost per employee or check $: </label>
                              <div class="col-md-6">
                                 <div>
                                    <h4 class="text-primary" id="basicPrice"><?php echo $countryPricesRow->bn_employee_cost; ?></h4>
                                 </div>
                              </div>
                           </div>
                           <div class="form-group {{ $errors->first('basicContracts', 'has-error') }}">
                              <label class="control-label  col-md-2">Support: </label>
                              <div class="col-md-6">
                                 <div>
                                    <h4 class="text-primary" id="basicPrice"><?php echo $countryPricesRow->bn_support; ?></h4>
                                 </div>
                              </div>
                           </div>
                           <div class="form-group {{ $errors->first('basicContracts', 'has-error') }}">
                              <label class="control-label  col-md-2">Users(admins): </label>
                              <div class="col-md-6">
                                 <div>
                                    <h4 class="text-primary" id="basicPrice"><?php echo $countryPricesRow->bn_users; ?></h4>
                                 </div>
                              </div>
                           </div>

                            @if(Sentinel::guest())
                           <h3 class="text-primary"><strong> We realized that you are not logged in or you do not have an account, please quickly fill in the fields below to sign up or <a href="{{ route('login') }}">signin</a></strong></h3>
                           <div class="form-group {{ $errors->first('companyname', 'has-error') }}">
                              <label class="control-label  col-md-2">Company Name: </label>
                              <div class="col-md-6">
                                 <div>
                                    <input type="text" class="form-control" id="companyname" name="companyname" placeholder="Company Name*"
                                       value="{!! old('companyname') !!}" >
                                 </div>
                              </div>
                           </div>
                           <div class="form-group {{ $errors->first('companyname', 'has-error') }}">
                              <label class="control-label  col-md-2"> Company Registration Number:</label>
                              <div class="col-md-6">
                                 <div>
                                    <input type="text" class="form-control" id="registrationnumber" name="registrationnumber" placeholder="Company Registration*"
                                       value="{!! old('registrationnumber') !!}" >
                                 </div>
                              </div>
                              {!! $errors->first('registrationnumber', '<span class="help-block">:message</span>') !!}
                           </div>
                           <div class="form-group {{ $errors->first('first_name', 'has-error') }}">
                              <label class="control-label  col-md-2"> Account Admin First Name</label>
                              <div class="col-md-6">
                                 <div>
                                    <input type="text" class="form-control" id="first_name" name="first_name" placeholder="Account Admin First Name*"
                                       value="{!! old('first_name') !!}" >
                                 </div>
                              </div>
                              {!! $errors->first('first_name', '<span class="help-block">:message</span>') !!}
                           </div>
                           <div class="form-group {{ $errors->first('last_name', 'has-error') }}">
                              <label class="control-label  col-md-2"> Account Admin Last Name</label>
                              <div class="col-md-6">
                                 <div>
                                    <input type="text" class="form-control" id="last_name" name="last_name" placeholder="Account Admin Last Name*"
                                       value="{!! old('last_name') !!}" >
                                 </div>
                              </div>
                              {!! $errors->first('last_name', '<span class="help-block">:message</span>') !!}
                           </div>
                           <div class="form-group {{ $errors->first('email', 'has-error') }}">
                              <label class="control-label  col-md-2"> Email</label>
                              <div class="col-md-6">
                                 <div>
                                    <input type="email" class="form-control" id="Email" name="email" placeholder="Email*"
                                       value="{!! old('Email') !!}" >
                                 </div>
                              </div>
                              {!! $errors->first('email', '<span class="help-block">:message</span>') !!}
                           </div>
                           <div class="form-group {{ $errors->first('password', 'has-error') }}">
                              <label class="control-label  col-md-2"> Password</label>
                              <div class="col-md-6">
                                 <div>
                                    <input type="password" class="form-control" id="Password1" name="password" placeholder="Password*">
                                    {!! $errors->first('password', '<span class="help-block">:message</span>') !!}
                                 </div>
                              </div>
                           </div>
                           <div class="form-group {{ $errors->first('password_confirm', 'has-error') }}">
                              <label class="control-label  col-md-2">  Confirm Password</label>
                              <div class="col-md-6">
                                 <div>
                                    <input type="password" class="form-control" id="Password2" name="password_confirm"
                                       placeholder="Confirm Password*">
                                    {!! $errors->first('password_confirm', '<span class="help-block">:message</span>') !!}
                                 </div>
                              </div>
                           </div>
                           @endif

                           <div class="form-group">
                              <div class="col-lg-offset-2 col-lg-10">
                                 <button class="btn btn-primary" type="submit">Subscribe</button>
                              </div>
                           </div>
                        </form>
                        {{--{!!  Form::close()  !!}--}}


                        <?php }else{
                            //check whether it is an option for downgrade or for upgrade
                            if($whichPackage > $businessNum){?>

                             <!--downgrade to Business-->
                             <!--<p>Details of the process are yet to be given </p>-->
                                              <?php 
						   ///When you downgrade, a check of whether you can downgrade or not is performed
						   //get the number of available employees
						   $employeesAvailStandC = $subscriptionCheck[0]->employees_avail;
						   //get the number of available admins
						   $adminsAvailStandC = $subscriptionCheck[0]->admins_avail;
						   $standardEmployessLimit = str_replace(' ', '',substr($countryPricesRow->bn_employees, strpos($countryPricesRow->bn_employees, "-")+1));
						   $standardAdminsLimit = $countryPricesRow->bn_users;
                           if((($employeesAvailStandC+1) <  $standardEmployessLimit || $adminsAvailStandC < $standardAdminsLimit) && $employeesAvailStandC >= 0){
							   echo "You cannot downgrade to this package";
						   }else{
							$PAYNOW_AMOUNT = ($subscriptionCheck[0]->AMOUNT)/100 - ($countryPricesRow->bn_price);
				      ?>
				 <form role="form" id="standardDowngrade" class="form-horizontal"
                           action="{{ route('subscribe') }}" method="POST">
                           <input type="hidden" name="_method" value="PUT">
                           <input type="hidden" name="_token" value="{{ csrf_token() }}">
                           <input type="hidden" name="category" value="business">
                           <input type="hidden" name="subscription_amount" value="">
                           <input type="hidden" name="PAYGATE_ID" id="PAYGATE_ID" value="10011072130"/>
                           <input type="hidden" name="REFERENCE" id="REFERENCE" value="<?php echo $theUserReference; ?>"/>
                           <input type="hidden" name="AMOUNT" id="AMOUNT" value="<?php echo $countryPricesRow->bn_price; ?>"/>
                           <input type="hidden" name="CURRENCY" id="CURRENCY" value="<?php echo $countryPricesRow->currency_code; ?>"/>
                           <input type="hidden" name="RETURN_URL" id="RETURN_URL" value="<?php echo $fullPath['protocol'] . $fullPath['host'] . '/' . $root . '/dmmx/public/payresult-employer'; ?>"/>
                           <input type="hidden" name="TRANSACTION_DATE" id="TRANSACTION_DATE" value="<?php echo getDateTime('Y-m-d H:i'); ?>"/>
                           <!--<input type="hidden" name="EMAIL" id="EMAIL" value="<?php //echo $userEMail; ?>"/>-->
                           <input type="hidden" name="SUBS_START_DATE" value="<?php echo getDateTime('Y-m-d'); ?>">
                           <input type="hidden" name="SUBS_FREQUENCY" value="229">
                           <input type="hidden" name="SUBS_END_DATE" value="2018-05-04">
                           <input type="hidden" name="PROCESS_NOW" value="YES">
                           <input type="hidden" name="VERSION" value="21">
                           <input type="hidden" name="PROCESS_NOW_AMOUNT" value="<?php echo $PAYNOW_AMOUNT ; ?>">
                           <input type="hidden" name="LOCALE" id="LOCALE" value="<?php echo $locale; ?>"/>
                           <input type="hidden" name="COUNTRY" id="COUNTRY" value="<?php echo $userCountryCode; ?>"/>
                           <input type="hidden" name="standard_category" id="standard_category" value="business"/>
                           <input type="hidden" name="downupgrade" id="downupgrade" value="downgrade"/>
                           <input type="hidden" name="sub_countryid" id="sub_countryid" value="<?php echo $countryPricesRow->id; ?>"/>
                          
                           <div class="form-group {{ $errors->first('basicContracts', 'has-error') }}">
                              <label class="control-label  col-md-2">Period: </label>
                              <div class="col-md-6">
                                 {!! Form::select('subperiod', $subperiod, null,['class' => 'form-control select2', 'id' => 'subperiod']) !!}
                                 <span class="help-block">{{ $errors->first('subperiod', ':message') }}</span>
                              </div>
                           </div>
                           <div class="form-group {{ $errors->first('basicContracts', 'has-error') }}">
                              <label class="control-label  col-md-2">Price: </label>
                              <div class="col-md-6">
                                 <div>
                                    <h4 class="text-primary" id="basicPrice"><?php echo $countryPricesRow->bn_price; ?><?php echo " " .$countryPricesRow->currency_code; ?></h4>
                                 </div>
                              </div>
                           </div>
                           <!--<div class="form-group {{ $errors->first('basicContracts', 'has-error') }}">
                              <label class="control-label  col-md-2">Refund Amount: </label>
                              <div class="col-md-6">
                                 <div>
                                    <h4 class="text-primary" id="basicPrice"><?php echo $PAYNOW_AMOUNT ; ?><?php echo " " .$countryPricesRow->currency_code; ?></h4>
                                 </div>
                              </div>
                           </div>-->
                           <div class="form-group {{ $errors->first('basicContracts', 'has-error') }}">
                              <label class="control-label  col-md-2">Employees: </label>
                              <div class="col-md-6">
                                 <div>
                                    <h4 class="text-primary" id="basicPrice"><?php echo $countryPricesRow->bn_employees; ?></h4>
                                 </div>
                              </div>
                           </div>
                           <div class="form-group {{ $errors->first('basicContracts', 'has-error') }}">
                              <label class="control-label  col-md-2">Base: </label>
                              <div class="col-md-6">
                                 <div>
                                    <h4 class="text-primary" id="basicPrice"><?php echo $countryPricesRow->bn_base; ?></h4>
                                 </div>
                              </div>
                           </div>
                           <div class="form-group {{ $errors->first('basicContracts', 'has-error') }}">
                              <label class="control-label  col-md-2">Annual Payment Discount: </label>
                              <div class="col-md-6">
                                 <div>
                                    <h4 class="text-primary" id="basicPrice"><?php echo $countryPricesRow->bn_discount; ?></h4>
                                 </div>
                              </div>
                           </div>
                           <div class="form-group {{ $errors->first('basicContracts', 'has-error') }}">
                              <label class="control-label  col-md-2">Terms Forms (Active & checks): </label>
                              <div class="col-md-6">
                                 <div>
                                    <h4 class="text-primary" id="basicPrice"><?php echo $countryPricesRow->bn_terms; ?></h4>
                                 </div>
                              </div>
                           </div>
                           <div class="form-group {{ $errors->first('basicContracts', 'has-error') }}">
                              <label class="control-label  col-md-2">Cost per employee or check $: </label>
                              <div class="col-md-6">
                                 <div>
                                    <h4 class="text-primary" id="basicPrice"><?php echo $countryPricesRow->bn_employees; ?></h4>
                                 </div>
                              </div>
                           </div>
                           <div class="form-group {{ $errors->first('basicContracts', 'has-error') }}">
                              <label class="control-label  col-md-2">Support: </label>
                              <div class="col-md-6">
                                 <div>
                                    <h4 class="text-primary" id="basicPrice"><?php echo $countryPricesRow->bn_support; ?></h4>
                                 </div>
                              </div>
                           </div>
                           <div class="form-group {{ $errors->first('basicContracts', 'has-error') }}">
                              <label class="control-label  col-md-2">Users(admins): </label>
                              <div class="col-md-6">
                                 <div>
                                    <h4 class="text-primary" id="basicPrice"><?php echo $countryPricesRow->bn_users; ?></h4>
                                 </div>
                              </div>
                           </div>
                           <div class="form-group">
                              <div class="col-lg-offset-2 col-lg-10">
                                 <button class="btn btn-primary" type="submit">Downgrade</button>
                              </div>
                           </div>
                        </form>
                        {{--{!!  Form::close()  !!}--}}
						
						   <?php } ?>
                              
                            <?php }else{?>

                               <!--upgrade to Business-->
                               <!--<p>Details of the process are yet to be given </p>-->
                                                <form role="form" id="businessUpgrade" class="form-horizontal"
                           action="{{ route('subscribe') }}" method="POST">
                           <input type="hidden" name="_method" value="PUT">
                           <input type="hidden" name="_token" value="{{ csrf_token() }}">
                           <input type="hidden" name="category" value="business">
                           <input type="hidden" name="subscription_amount" value="">
                           <input type="hidden" name="PAYGATE_ID" id="PAYGATE_ID" value="10011072130"/>
                           <input type="hidden" name="REFERENCE" id="REFERENCE" value="<?php echo $theUserReference; ?>"/>
						   <?php //The upgrade amount
						   //We need to know the monetory value of the current package 
						   $currentPackage = $whichPackage;
						   $CurrentPackageCost = ($subscriptionCheck[0]->AMOUNT)/100;
						   $businessPackageCost = $countryPricesRow->bn_price;
						   $packagesBusDifference = $businessPackageCost - $CurrentPackageCost;
							   $PAYNOW_AMOUNT = $packagesBusDifference;
						   //The logic below should happen in the confirmation page
						 /*  if($packagesBusDifference > 0){
							   //the user needs to pay a certain amount
						   }
						   if($packagesBusDifference < 0){
							   //the user needs to be refunded
						   }*/
						   //To know whether the subscription is an upgrade or a downgrade, we will know by the existance of a package already in the database
						   ?>
                           <input type="hidden" name="AMOUNT" id="AMOUNT" value="<?php echo $countryPricesRow->bn_price; ?>"/>
                           <input type="hidden" name="CURRENCY" id="CURRENCY" value="<?php echo $countryPricesRow->currency_code; ?>"/>
                           <input type="hidden" name="RETURN_URL" id="RETURN_URL" value="<?php echo $fullPath['protocol'] . $fullPath['host'] . '/' . $root . '/dmmx/public/payresult-employer'; ?>"/>
                           <input type="hidden" name="TRANSACTION_DATE" id="TRANSACTION_DATE" value="<?php echo getDateTime('Y-m-d H:i'); ?>"/>
                           <!--<input type="hidden" name="EMAIL" id="EMAIL" value="<?php //echo $userEMail; ?>"/>-->
                           <input type="hidden" name="SUBS_START_DATE" value="<?php echo getDateTime('Y-m-d'); ?>">
                           <input type="hidden" name="SUBS_FREQUENCY" value="229">
                           <input type="hidden" name="SUBS_END_DATE" value="2018-05-04">
                           <input type="hidden" name="PROCESS_NOW" value="YES">
                           <input type="hidden" name="VERSION" value="21">
                           <input type="hidden" name="PROCESS_NOW_AMOUNT" value="<?php echo $PAYNOW_AMOUNT ; ?>">
                           <input type="hidden" name="LOCALE" id="LOCALE" value="<?php echo $locale; ?>"/>
                           <input type="hidden" name="COUNTRY" id="COUNTRY" value="<?php echo $userCountryCode; ?>"/>
                           <input type="hidden" name="standard_category" id="standard_category" value="business"/>
                           <input type="hidden" name="downupgrade" id="downupgrade" value="null"/>
                           <input type="hidden" name="sub_countryid" id="sub_countryid" value="<?php echo $countryPricesRow->id; ?>"/>
                          
                           <div class="form-group {{ $errors->first('basicContracts', 'has-error') }}">
                              <label class="control-label  col-md-2">Period: </label>
                              <div class="col-md-6">
                                 {!! Form::select('subperiod', $subperiod, null,['class' => 'form-control select2', 'id' => 'subperiod']) !!}
                                 <span class="help-block">{{ $errors->first('subperiod', ':message') }}</span>
                              </div>
                           </div>
                           <div class="form-group {{ $errors->first('basicContracts', 'has-error') }}">
                              <label class="control-label  col-md-2">Price: </label>
                              <div class="col-md-6">
                                 <div>
                                    <h4 class="text-primary" id="basicPrice"><?php echo $countryPricesRow->bn_price; ?><?php echo " " .$countryPricesRow->currency_code; ?></h4>
                                 </div>
                              </div>
                           </div>
                           <!--<div class="form-group {{ $errors->first('basicContracts', 'has-error') }}">
                              <label class="control-label  col-md-2">Additional Amount Required: </label>
                              <div class="col-md-6">
                                 <div>
                                    <h4 class="text-primary" id="basicPrice"><?php //echo $PAYNOW_AMOUNT; ?><?php //echo " " .$countryPricesRow->currency_code; ?></h4>
                                 </div>
                              </div>
                           </div>-->
                           <div class="form-group {{ $errors->first('basicContracts', 'has-error') }}">
                              <label class="control-label  col-md-2">Employees: </label>
                              <div class="col-md-6">
                                 <div>
                                    <h4 class="text-primary" id="basicPrice"><?php echo $countryPricesRow->bn_employees; ?></h4>
                                 </div>
                              </div>
                           </div>
                           <div class="form-group {{ $errors->first('basicContracts', 'has-error') }}">
                              <label class="control-label  col-md-2">Base: </label>
                              <div class="col-md-6">
                                 <div>
                                    <h4 class="text-primary" id="basicPrice"><?php echo $countryPricesRow->bn_base; ?></h4>
                                 </div>
                              </div>
                           </div>
                           <div class="form-group {{ $errors->first('basicContracts', 'has-error') }}">
                              <label class="control-label  col-md-2">Annual Payment Discount: </label>
                              <div class="col-md-6">
                                 <div>
                                    <h4 class="text-primary" id="basicPrice"><?php echo $countryPricesRow->bn_discount; ?></h4>
                                 </div>
                              </div>
                           </div>
                           <div class="form-group {{ $errors->first('basicContracts', 'has-error') }}">
                              <label class="control-label  col-md-2">Terms Forms (Active & checks): </label>
                              <div class="col-md-6">
                                 <div>
                                    <h4 class="text-primary" id="basicPrice"><?php echo $countryPricesRow->bn_terms; ?></h4>
                                 </div>
                              </div>
                           </div>
                           <div class="form-group {{ $errors->first('basicContracts', 'has-error') }}">
                              <label class="control-label  col-md-2">Cost per employee or check $: </label>
                              <div class="col-md-6">
                                 <div>
                                    <h4 class="text-primary" id="basicPrice"><?php echo $countryPricesRow->bn_employee_cost; ?></h4>
                                 </div>
                              </div>
                           </div>
                           <div class="form-group {{ $errors->first('basicContracts', 'has-error') }}">
                              <label class="control-label  col-md-2">Support: </label>
                              <div class="col-md-6">
                                 <div>
                                    <h4 class="text-primary" id="basicPrice"><?php echo $countryPricesRow->bn_support; ?></h4>
                                 </div>
                              </div>
                           </div>
                           <div class="form-group {{ $errors->first('basicContracts', 'has-error') }}">
                              <label class="control-label  col-md-2">Users(admins): </label>
                              <div class="col-md-6">
                                 <div>
                                    <h4 class="text-primary" id="basicPrice"><?php echo $countryPricesRow->bn_users; ?></h4>
                                 </div>
                              </div>
                           </div>
                           <div class="form-group">
                              <div class="col-lg-offset-2 col-lg-10">
                                 <button class="btn btn-primary" type="submit">Upgrade</button>
                              </div>
                           </div>
                        </form>
                        {{--{!!  Form::close()  !!}--}}

                            <?php }
                        }
                    }
                    ?>
                     
                            </div>
                        </div>
                    </div>
                    <div id="tab3" class="tab-pane fade">
                        <div class="row">
                            <div class="col-md-12 pd-top">


                          <?php if($whichPackage == $professionalNum){?>

                      <!--professional package details -->
                         <div class="form-group">
                              <label class="control-label  col-md-2">Package:  </label>
                              <div class="col-md-6">
                                 <div>
                                     <p class="text-primary">Professional</p>
                                 </div>
                              </div>
                           </div>
                            <br>
                           <div class="form-group">
                              <label class="control-label  col-md-2">Reference:  </label>
                              <div class="col-md-6">
                                 <div>
                                     <p class="text-primary"><?php echo $subscriptionCheck[0]->REFERENCE ?></p>
                                 </div>
                              </div>
                           </div>
                           <br>
                           <div class="form-group">
                              <label class="control-label  col-md-2">Amount:  </label>
                              <div class="col-md-6">
                                 <div>
                                     <p class="text-primary"><?php echo ($subscriptionCheck[0]->AMOUNT)/100  ." " .$subscriptionCheck[0]->sub_currencycode ?></p>
                                 </div>
                              </div>
                           </div>
                           <br>
                           <div class="form-group">
                              <label class="control-label  col-md-2">Number of Allowed Admins:  </label>
                              <div class="col-md-6">
                                 <div>
                                     <p class="text-primary"><?php echo $subscriptionCheck[0]->quantity_admins ?></p>
                                 </div>
                              </div>
                           </div>
                           <br>
                           <div class="form-group">
                              <label class="control-label  col-md-2">Admins Available:  </label>
                              <div class="col-md-6">
                                 <div>
                                     <p class="text-primary"><?php echo $subscriptionCheck[0]->admins_avail ?></p>
                                 </div>
                              </div>
                           </div>
                           <br>
                           <div class="form-group">
                              <label class="control-label  col-md-2">Employees:  </label>
                              <div class="col-md-6">
                                 <div>
                                     <p class="text-primary"><?php echo $subscriptionCheck[0]->employees	 ?></p>
                                 </div>
                              </div>
                           </div>
                           <br>
                           <div class="form-group">
                              <label class="control-label  col-md-2">Employees Available:  </label>
                              <div class="col-md-6">
                                 <div>
                                     <p class="text-primary"><?php echo $subscriptionCheck[0]->employees_avail	 ?></p>
                                 </div>
                              </div>
                           </div>
                           <br>
                           <div class="form-group">
                              <label class="control-label  col-md-2">Support:  </label>
                              <div class="col-md-6">
                                 <div>
                                     <p class="text-primary"><?php echo $subscriptionCheck[0]->support	 ?></p>
                                 </div>
                              </div>
                           </div>
                           <br>
                           <div class="form-group">
                              <label class="control-label  col-md-2">Membership Start date:  </label>
                              <div class="col-md-6">
                                 <div>
                                     <p class="text-primary"><?php echo $subscriptionCheck[0]->SUBS_START_DATE	 ?></p>
                                 </div>
                              </div>
                           </div>
                           <br>
                           <div class="form-group">
                              <label class="control-label  col-md-2">Membership expiry date:  </label>
                              <div class="col-md-6">
                                 <div>
                                     <p class="text-primary"><?php echo $subscriptionCheck[0]->SUBS_END_DATE	 ?></p>
                                 </div>
                              </div>
                           </div>
                           <br>
                           <div class="form-group">
                              <label class="control-label  col-md-2">Membership Frequency:  </label>
                              <div class="col-md-6">
                                 <div>
                                     <p class="text-primary"><?php echo $subscriptionCheck[0]->SUBS_FREQUENCY	 ?></p>
                                 </div>
                              </div>
                           </div>

                    <?php }else{
                        if(!$whichPackage){ ?>

                            <form role="form" id="professionalForm" class="form-horizontal"
                           action="{{ route('subscribe') }}" method="POST">
                           <input type="hidden" name="_method" value="PUT">
                           <input type="hidden" name="_token" value="{{ csrf_token() }}">
                           <input type="hidden" name="category" value="professional">
                           <input type="hidden" name="subscription_amount" value="">
                           <input type="hidden" name="PAYGATE_ID" id="PAYGATE_ID" value="10011072130"/>
                           <input type="hidden" name="REFERENCE" id="REFERENCE" value="<?php echo $theUserReference; ?>"/>
                           <input type="hidden" name="AMOUNT" id="AMOUNT" value="<?php echo $countryPricesRow->pro_price; ?>"/>
                           <input type="hidden" name="CURRENCY" id="CURRENCY" value="<?php echo $countryPricesRow->currency_code; ?>"/>
                           <input type="hidden" name="RETURN_URL" id="RETURN_URL" value="<?php echo $fullPath['protocol'] . $fullPath['host'] . '/' . $root . '/dmmx/public/payresult-employer'; ?>"/>
                           <input type="hidden" name="TRANSACTION_DATE" id="TRANSACTION_DATE" value="<?php echo getDateTime('Y-m-d H:i'); ?>"/>
                           <!--<input type="hidden" name="EMAIL" id="EMAIL" value="<?php //echo $userEMail; ?>"/>-->
                           <input type="hidden" name="SUBS_START_DATE" value="<?php echo getDateTime('Y-m-d'); ?>">
                           <input type="hidden" name="SUBS_FREQUENCY" value="229">
                           <input type="hidden" name="SUBS_END_DATE" value="2018-05-04">
                           <input type="hidden" name="PROCESS_NOW" value="YES">
                           <input type="hidden" name="VERSION" value="21">
                           <input type="hidden" name="PROCESS_NOW_AMOUNT" value="<?php echo $countryPricesRow->pro_price; ?>">
                           <input type="hidden" name="LOCALE" id="LOCALE" value="en-za"/>
                           <input type="hidden" name="COUNTRY" id="COUNTRY" value="<?php echo $countryPricesRow->country_code; ?>"/>
                           <input type="hidden" name="standard_category" id=standard_category value="professional"/>
                           <input type="hidden" name="downupgrade" id="downupgrade" value="null"/>
                           <input type="hidden" name="sub_countryid" id="sub_countryid" value="<?php echo $countryPricesRow->id; ?>"/>
                           <div class="form-group {{ $errors->first('standardContracts', 'has-error') }}">
                              <label class="control-label  col-md-2">Period: </label>
                              <div class="col-md-6">
                                 {!! Form::select('subperiod', $subperiod, null,['class' => 'form-control select2', 'id' => 'subperiod']) !!}
                                 <span class="help-block">{{ $errors->first('subperiod', ':message') }}</span>
                              </div>
                           </div>
                           <div class="form-group {{ $errors->first('basicContracts', 'has-error') }}">
                              <label class="control-label  col-md-2">Price: </label>
                              <div class="col-md-6">
                                 <div>
                                    <h4 class="text-primary" id="basicPrice"><?php echo $countryPricesRow->pro_price; ?><?php echo " " .$countryPricesRow->currency_code; ?></h4>
                                 </div>
                              </div>
                           </div>
                           <div class="form-group {{ $errors->first('basicContracts', 'has-error') }}">
                              <label class="control-label  col-md-2">Employees: </label>
                              <div class="col-md-6">
                                 <div>
                                    <h4 class="text-primary" id="basicPrice"><?php echo $countryPricesRow->pro_employees; ?></h4>
                                 </div>
                              </div>
                           </div>
                           <div class="form-group {{ $errors->first('basicContracts', 'has-error') }}">
                              <label class="control-label  col-md-2">Base: </label>
                              <div class="col-md-6">
                                 <div>
                                    <h4 class="text-primary" id="basicPrice"><?php echo $countryPricesRow->pro_base; ?></h4>
                                 </div>
                              </div>
                           </div>
                           <div class="form-group {{ $errors->first('basicContracts', 'has-error') }}">
                              <label class="control-label  col-md-2">Annual Payment Discount</label>
                              <div class="col-md-6">
                                 <div>
                                    <h4 class="text-primary" id="basicPrice"><?php echo $countryPricesRow->pro_discount; ?></h4>
                                 </div>
                              </div>
                           </div>
                           <div class="form-group {{ $errors->first('basicContracts', 'has-error') }}">
                              <label class="control-label  col-md-2">Terms Forms (Active & checks): </label>
                              <div class="col-md-6">
                                 <div>
                                    <h4 class="text-primary" id="basicPrice"><?php echo $countryPricesRow->pro_terms; ?></h4>
                                 </div>
                              </div>
                           </div>
                           <div class="form-group {{ $errors->first('basicContracts', 'has-error') }}">
                              <label class="control-label  col-md-2">Cost per employee or check $: </label>
                              <div class="col-md-6">
                                 <div>
                                    <h4 class="text-primary" id="basicPrice"><?php echo $countryPricesRow->pro_employee_cost; ?></h4>
                                 </div>
                              </div>
                           </div>
                           <div class="form-group {{ $errors->first('basicContracts', 'has-error') }}">
                              <label class="control-label  col-md-2">Support: </label>
                              <div class="col-md-6">
                                 <div>
                                    <h4 class="text-primary" id="basicPrice"><?php echo $countryPricesRow->pro_support; ?></h4>
                                 </div>
                              </div>
                           </div>
                           <div class="form-group {{ $errors->first('basicContracts', 'has-error') }}">
                              <label class="control-label  col-md-2">Users(admins): </label>
                              <div class="col-md-6">
                                 <div>
                                    <h4 class="text-primary" id="basicPrice"><?php echo $countryPricesRow->pro_users; ?></h4>
                                 </div>
                              </div>
                           </div>

                            @if(Sentinel::guest())
                           <h3 class="text-primary"><strong> We realized that you are not logged in or you do not have an account, please quickly fill in the fields below to sign up or <a href="{{ route('login') }}">signin</a></strong></h3>
                           <div class="form-group {{ $errors->first('companyname', 'has-error') }}">
                              <label class="control-label  col-md-2">Company Name: </label>
                              <div class="col-md-6">
                                 <div>
                                    <input type="text" class="form-control" id="companyname" name="companyname" placeholder="Company Name*"
                                       value="{!! old('companyname') !!}" >
                                 </div>
                              </div>
                           </div>
                           <div class="form-group {{ $errors->first('companyname', 'has-error') }}">
                              <label class="control-label  col-md-2"> Company Registration Number:</label>
                              <div class="col-md-6">
                                 <div>
                                    <input type="text" class="form-control" id="registrationnumber" name="registrationnumber" placeholder="Company Registration*"
                                       value="{!! old('registrationnumber') !!}" >
                                 </div>
                              </div>
                              {!! $errors->first('registrationnumber', '<span class="help-block">:message</span>') !!}
                           </div>
                           <div class="form-group {{ $errors->first('first_name', 'has-error') }}">
                              <label class="control-label  col-md-2"> Account Admin First Name</label>
                              <div class="col-md-6">
                                 <div>
                                    <input type="text" class="form-control" id="first_name" name="first_name" placeholder="Account Admin First Name*"
                                       value="{!! old('first_name') !!}" >
                                 </div>
                              </div>
                              {!! $errors->first('first_name', '<span class="help-block">:message</span>') !!}
                           </div>
                           <div class="form-group {{ $errors->first('last_name', 'has-error') }}">
                              <label class="control-label  col-md-2"> Account Admin Last Name</label>
                              <div class="col-md-6">
                                 <div>
                                    <input type="text" class="form-control" id="last_name" name="last_name" placeholder="Account Admin Last Name*"
                                       value="{!! old('last_name') !!}" >
                                 </div>
                              </div>
                              {!! $errors->first('last_name', '<span class="help-block">:message</span>') !!}
                           </div>
                           <div class="form-group {{ $errors->first('email', 'has-error') }}">
                              <label class="control-label  col-md-2"> Email</label>
                              <div class="col-md-6">
                                 <div>
                                    <input type="email" class="form-control" id="Email" name="email" placeholder="Email*"
                                       value="{!! old('Email') !!}" >
                                 </div>
                              </div>
                              {!! $errors->first('email', '<span class="help-block">:message</span>') !!}
                           </div>
                           <div class="form-group {{ $errors->first('password', 'has-error') }}">
                              <label class="control-label  col-md-2"> Password</label>
                              <div class="col-md-6">
                                 <div>
                                    <input type="password" class="form-control" id="Password1" name="password" placeholder="Password*">
                                    {!! $errors->first('password', '<span class="help-block">:message</span>') !!}
                                 </div>
                              </div>
                           </div>
                           <div class="form-group {{ $errors->first('password_confirm', 'has-error') }}">
                              <label class="control-label  col-md-2">  Confirm Password</label>
                              <div class="col-md-6">
                                 <div>
                                    <input type="password" class="form-control" id="Password2" name="password_confirm"
                                       placeholder="Confirm Password*">
                                    {!! $errors->first('password_confirm', '<span class="help-block">:message</span>') !!}
                                 </div>
                              </div>
                           </div>
                           @endif

                           <div class="form-group">
                              <div class="col-lg-offset-2 col-lg-10">
                                 <button class="btn btn-primary" type="submit">Subscribe</button>
                              </div>
                           </div>
                        </form>
                        {{--{!!  Form::close()  !!}--}}

                        <?php }else{
                            //check whether it is an option for downgrade or for upgrade
                            if($whichPackage > $professionalNum){ ?>

                             <!--downgrade to professional-->
                           <!--<p>Details of the process are yet to be given </p>-->

                                            <?php 
						   ///When you downgrade, a check of whether you can downgrade or not is performed
						   //get the number of available employees
						   $employeesAvailStandC = $subscriptionCheck[0]->employees_avail;
						   //get the number of available admins
						   $adminsAvailStandC = $subscriptionCheck[0]->admins_avail;
						   $standardEmployessLimit = str_replace(' ', '',substr($countryPricesRow->pro_employees, strpos($countryPricesRow->pro_employees, "-")+1));
						   $standardAdminsLimit = $countryPricesRow->pro_users;
                           if((($employeesAvailStandC+1) <  $standardEmployessLimit || $adminsAvailStandC < $standardAdminsLimit) && $employeesAvailStandC >= 0){
							   echo "You cannot downgrade to this package";
						   }else{ 
							$PAYNOW_AMOUNT = ($subscriptionCheck[0]->AMOUNT)/100 - ($countryPricesRow->pro_price);
				      ?>
				 <form role="form" id="standardDowngrade" class="form-horizontal"
                           action="{{ route('subscribe') }}" method="POST">
                           <input type="hidden" name="_method" value="PUT">
                           <input type="hidden" name="_token" value="{{ csrf_token() }}">
                           <input type="hidden" name="category" value="professional">
                           <input type="hidden" name="subscription_amount" value="">
                           <input type="hidden" name="PAYGATE_ID" id="PAYGATE_ID" value="10011072130"/>
                           <input type="hidden" name="REFERENCE" id="REFERENCE" value="<?php echo $theUserReference; ?>"/>
                           <input type="hidden" name="AMOUNT" id="AMOUNT" value="<?php echo $countryPricesRow->pro_price; ?>"/>
                           <input type="hidden" name="CURRENCY" id="CURRENCY" value="<?php echo $countryPricesRow->currency_code; ?>"/>
                           <input type="hidden" name="RETURN_URL" id="RETURN_URL" value="<?php echo $fullPath['protocol'] . $fullPath['host'] . '/' . $root . '/dmmx/public/payresult-employer'; ?>"/>
                           <input type="hidden" name="TRANSACTION_DATE" id="TRANSACTION_DATE" value="<?php echo getDateTime('Y-m-d H:i'); ?>"/>
                           <!--<input type="hidden" name="EMAIL" id="EMAIL" value="<?php //echo $userEMail; ?>"/>-->
                           <input type="hidden" name="SUBS_START_DATE" value="<?php echo getDateTime('Y-m-d'); ?>">
                           <input type="hidden" name="SUBS_FREQUENCY" value="229">
                           <input type="hidden" name="SUBS_END_DATE" value="2018-05-04">
                           <input type="hidden" name="PROCESS_NOW" value="YES">
                           <input type="hidden" name="VERSION" value="21">
                           <input type="hidden" name="PROCESS_NOW_AMOUNT" value="<?php echo $PAYNOW_AMOUNT ; ?>">
                           <input type="hidden" name="LOCALE" id="LOCALE" value="<?php echo $locale; ?>"/>
                           <input type="hidden" name="COUNTRY" id="COUNTRY" value="<?php echo $userCountryCode; ?>"/>
                           <input type="hidden" name="standard_category" id="standard_category" value="professional"/>
                           <input type="hidden" name="downupgrade" id="downupgrade" value="downgrade"/>
                           <input type="hidden" name="sub_countryid" id="sub_countryid" value="<?php echo $countryPricesRow->id; ?>"/>
                          
                           <div class="form-group {{ $errors->first('basicContracts', 'has-error') }}">
                              <label class="control-label  col-md-2">Period: </label>
                              <div class="col-md-6">
                                 {!! Form::select('subperiod', $subperiod, null,['class' => 'form-control select2', 'id' => 'subperiod']) !!}
                                 <span class="help-block">{{ $errors->first('subperiod', ':message') }}</span>
                              </div>
                           </div>
                           <div class="form-group {{ $errors->first('basicContracts', 'has-error') }}">
                              <label class="control-label  col-md-2">Price: </label>
                              <div class="col-md-6">
                                 <div>
                                    <h4 class="text-primary" id="basicPrice"><?php echo $countryPricesRow->pro_price; ?><?php echo " " .$countryPricesRow->currency_code; ?></h4>
                                 </div>
                              </div>
                           </div>
                           <!--<div class="form-group {{ $errors->first('basicContracts', 'has-error') }}">
                              <label class="control-label  col-md-2">Refund Amount: </label>
                              <div class="col-md-6">
                                 <div>
                                    <h4 class="text-primary" id="basicPrice"><?php echo $PAYNOW_AMOUNT ; ?><?php echo " " .$countryPricesRow->currency_code; ?></h4>
                                 </div>
                              </div>
                           </div>-->
                           <div class="form-group {{ $errors->first('basicContracts', 'has-error') }}">
                              <label class="control-label  col-md-2">Employees: </label>
                              <div class="col-md-6">
                                 <div>
                                    <h4 class="text-primary" id="basicPrice"><?php echo $countryPricesRow->pro_employees; ?></h4>
                                 </div>
                              </div>
                           </div>
                           <div class="form-group {{ $errors->first('basicContracts', 'has-error') }}">
                              <label class="control-label  col-md-2">Base: </label>
                              <div class="col-md-6">
                                 <div>
                                    <h4 class="text-primary" id="basicPrice"><?php echo $countryPricesRow->pro_base; ?></h4>
                                 </div>
                              </div>
                           </div>
                           <div class="form-group {{ $errors->first('basicContracts', 'has-error') }}">
                              <label class="control-label  col-md-2">Annual Payment Discount: </label>
                              <div class="col-md-6">
                                 <div>
                                    <h4 class="text-primary" id="basicPrice"><?php echo $countryPricesRow->pro_discount; ?></h4>
                                 </div>
                              </div>
                           </div>
                           <div class="form-group {{ $errors->first('basicContracts', 'has-error') }}">
                              <label class="control-label  col-md-2">Terms Forms (Active & checks): </label>
                              <div class="col-md-6">
                                 <div>
                                    <h4 class="text-primary" id="basicPrice"><?php echo $countryPricesRow->pro_terms; ?></h4>
                                 </div>
                              </div>
                           </div>
                           <div class="form-group {{ $errors->first('basicContracts', 'has-error') }}">
                              <label class="control-label  col-md-2">Cost per employee or check $: </label>
                              <div class="col-md-6">
                                 <div>
                                    <h4 class="text-primary" id="basicPrice"><?php echo $countryPricesRow->pro_employees; ?></h4>
                                 </div>
                              </div>
                           </div>
                           <div class="form-group {{ $errors->first('basicContracts', 'has-error') }}">
                              <label class="control-label  col-md-2">Support: </label>
                              <div class="col-md-6">
                                 <div>
                                    <h4 class="text-primary" id="basicPrice"><?php echo $countryPricesRow->pro_support; ?></h4>
                                 </div>
                              </div>
                           </div>
                           <div class="form-group {{ $errors->first('basicContracts', 'has-error') }}">
                              <label class="control-label  col-md-2">Users(admins): </label>
                              <div class="col-md-6">
                                 <div>
                                    <h4 class="text-primary" id="basicPrice"><?php echo $countryPricesRow->pro_users; ?></h4>
                                 </div>
                              </div>
                           </div>
                           <div class="form-group">
                              <div class="col-lg-offset-2 col-lg-10">
                                 <button class="btn btn-primary" type="submit">Downgrade</button>
                              </div>
                           </div>
                        </form>
                        {{--{!!  Form::close()  !!}--}}
						
						   <?php } ?>


                           <?php  }else{ ?>

                               <!--upgrade to professional-->
                           <!--<p>Details of the process are yet to be given </p>-->
                                            <form role="form" id="businessUpgrade" class="form-horizontal"
                           action="{{ route('subscribe') }}" method="POST">
                           <input type="hidden" name="_method" value="PUT">
                           <input type="hidden" name="_token" value="{{ csrf_token() }}">
                           <input type="hidden" name="category" value="professional">
                           <input type="hidden" name="subscription_amount" value="">
                           <input type="hidden" name="PAYGATE_ID" id="PAYGATE_ID" value="10011072130"/>
                           <input type="hidden" name="REFERENCE" id="REFERENCE" value="<?php echo $theUserReference; ?>"/>
						   <?php //The upgrade amount
						   //We need to know the monetory value of the current package 
						   $currentPackage = $whichPackage;
						   $CurrentPackageCost = ($subscriptionCheck[0]->AMOUNT)/100;
						   $professionalPackageCost = $countryPricesRow->pro_price;
						   $packagesProDifference = $professionalPackageCost - $CurrentPackageCost;
							$B_PAYNOW_AMOUNT = $packagesProDifference;
						   //The logic below should happen in the confirmation page
						 /*  if($packagesBusDifference > 0){
							   //the user needs to pay a certain amount
						   }
						   if($packagesBusDifference < 0){
							   //the user needs to be refunded
						   }*/
						   //To know whether the subscription is an upgrade or a downgrade, we will know by the existance of a package already in the database
						   ?>
                           <input type="hidden" name="AMOUNT" id="AMOUNT" value="<?php echo $countryPricesRow->pro_price; ?>"/>
                           <input type="hidden" name="CURRENCY" id="CURRENCY" value="<?php echo $countryPricesRow->currency_code; ?>"/>
                           <input type="hidden" name="RETURN_URL" id="RETURN_URL" value="<?php echo $fullPath['protocol'] . $fullPath['host'] . '/' . $root . '/dmmx/public/payresult-employer'; ?>"/>
                           <input type="hidden" name="TRANSACTION_DATE" id="TRANSACTION_DATE" value="<?php echo getDateTime('Y-m-d H:i'); ?>"/>
                           <!--<input type="hidden" name="EMAIL" id="EMAIL" value="<?php //echo $userEMail; ?>"/>-->
                           <input type="hidden" name="SUBS_START_DATE" value="<?php echo getDateTime('Y-m-d'); ?>">
                           <input type="hidden" name="SUBS_FREQUENCY" value="229">
                           <input type="hidden" name="SUBS_END_DATE" value="2018-05-04">
                           <input type="hidden" name="PROCESS_NOW" value="YES">
                           <input type="hidden" name="VERSION" value="21">
                           <input type="hidden" name="PROCESS_NOW_AMOUNT" value="<?php echo $B_PAYNOW_AMOUNT ; ?>">
                           <input type="hidden" name="LOCALE" id="LOCALE" value="<?php echo $locale; ?>"/>
                           <input type="hidden" name="COUNTRY" id="COUNTRY" value="<?php echo $userCountryCode; ?>"/>
                           <input type="hidden" name="standard_category" id="standard_category" value="professional"/>
                           <input type="hidden" name="downupgrade" id="downupgrade" value="null"/>
                           <input type="hidden" name="sub_countryid" id="sub_countryid" value="<?php echo $countryPricesRow->id; ?>"/>
                          
                           <div class="form-group {{ $errors->first('basicContracts', 'has-error') }}">
                              <label class="control-label  col-md-2">Period: </label>
                              <div class="col-md-6">
                                 {!! Form::select('subperiod', $subperiod, null,['class' => 'form-control select2', 'id' => 'subperiod']) !!}
                                 <span class="help-block">{{ $errors->first('subperiod', ':message') }}</span>
                              </div>
                           </div>
                           <div class="form-group {{ $errors->first('basicContracts', 'has-error') }}">
                              <label class="control-label  col-md-2">Price: </label>
                              <div class="col-md-6">
                                 <div>
                                    <h4 class="text-primary" id="basicPrice"><?php echo $countryPricesRow->pro_price; ?><?php echo " " .$countryPricesRow->currency_code; ?></h4>
                                 </div>
                              </div>
                           </div>
                           <!--<div class="form-group {{ $errors->first('basicContracts', 'has-error') }}">
                              <label class="control-label  col-md-2">Additional Amount Required: </label>
                              <div class="col-md-6">
                                 <div>
                                    <h4 class="text-primary" id="basicPrice"><?php //echo $B_PAYNOW_AMOUNT; ?><?php //echo " " .$countryPricesRow->currency_code; ?></h4>
                                 </div>
                              </div>
                           </div>-->
                           <div class="form-group {{ $errors->first('basicContracts', 'has-error') }}">
                              <label class="control-label  col-md-2">Employees: </label>
                              <div class="col-md-6">
                                 <div>
                                    <h4 class="text-primary" id="basicPrice"><?php echo $countryPricesRow->pro_employees; ?></h4>
                                 </div>
                              </div>
                           </div>
                           <div class="form-group {{ $errors->first('basicContracts', 'has-error') }}">
                              <label class="control-label  col-md-2">Base: </label>
                              <div class="col-md-6">
                                 <div>
                                    <h4 class="text-primary" id="basicPrice"><?php echo $countryPricesRow->pro_base; ?></h4>
                                 </div>
                              </div>
                           </div>
                           <div class="form-group {{ $errors->first('basicContracts', 'has-error') }}">
                              <label class="control-label  col-md-2">Annual Payment Discount: </label>
                              <div class="col-md-6">
                                 <div>
                                    <h4 class="text-primary" id="basicPrice"><?php echo $countryPricesRow->pro_discount; ?></h4>
                                 </div>
                              </div>
                           </div>
                           <div class="form-group {{ $errors->first('basicContracts', 'has-error') }}">
                              <label class="control-label  col-md-2">Terms Forms (Active & checks): </label>
                              <div class="col-md-6">
                                 <div>
                                    <h4 class="text-primary" id="basicPrice"><?php echo $countryPricesRow->pro_terms; ?></h4>
                                 </div>
                              </div>
                           </div>
                           <div class="form-group {{ $errors->first('basicContracts', 'has-error') }}">
                              <label class="control-label  col-md-2">Cost per employee or check $: </label>
                              <div class="col-md-6">
                                 <div>
                                    <h4 class="text-primary" id="basicPrice"><?php echo $countryPricesRow->pro_employee_cost; ?></h4>
                                 </div>
                              </div>
                           </div>
                           <div class="form-group {{ $errors->first('basicContracts', 'has-error') }}">
                              <label class="control-label  col-md-2">Support: </label>
                              <div class="col-md-6">
                                 <div>
                                    <h4 class="text-primary" id="basicPrice"><?php echo $countryPricesRow->pro_support; ?></h4>
                                 </div>
                              </div>
                           </div>
                           <div class="form-group {{ $errors->first('basicContracts', 'has-error') }}">
                              <label class="control-label  col-md-2">Users(admins): </label>
                              <div class="col-md-6">
                                 <div>
                                    <h4 class="text-primary" id="basicPrice"><?php echo $countryPricesRow->pro_users; ?></h4>
                                 </div>
                              </div>
                           </div>
                           <div class="form-group">
                              <div class="col-lg-offset-2 col-lg-10">
                                 <button class="btn btn-primary" type="submit">Upgrade</button>
                              </div>
                           </div>
                        </form>
                        {{--{!!  Form::close()  !!}--}}

                            <?php }
                        }
                    }
                    ?>


                                 
                            </div>
                        </div>
                    </div>
                    <div id="tab4" class="tab-pane fade">
                        <div class="row">
                            <div class="col-md-12 pd-top">

                                 
                                 <?php if($whichPackage == $enterpriseNum){ ?>
                      
                              <!--Enterprise package details -->
                         <div class="form-group">
                              <label class="control-label  col-md-2">Package:  </label>
                              <div class="col-md-6">
                                 <div>
                                     <p class="text-primary">Enterprise</p>
                                 </div>
                              </div>
                           </div>
                            <br>
                           <div class="form-group">
                              <label class="control-label  col-md-2">Reference:  </label>
                              <div class="col-md-6">
                                 <div>
                                     <p class="text-primary"><?php echo $subscriptionCheck[0]->REFERENCE ?></p>
                                 </div>
                              </div>
                           </div>
                           <br>
                           <div class="form-group">
                              <label class="control-label  col-md-2">Amount:  </label>
                              <div class="col-md-6">
                                 <div>
                                     <p class="text-primary"><?php echo ($subscriptionCheck[0]->AMOUNT)/100  ." " .$subscriptionCheck[0]->sub_currencycode ?></p>
                                 </div>
                              </div>
                           </div>
                           <br>
                           <div class="form-group">
                              <label class="control-label  col-md-2">Number of Allowed Admins:  </label>
                              <div class="col-md-6">
                                 <div>
                                     <p class="text-primary"><?php echo $subscriptionCheck[0]->quantity_admins ?></p>
                                 </div>
                              </div>
                           </div>
                           <br>
                           <div class="form-group">
                              <label class="control-label  col-md-2">Admins Available:  </label>
                              <div class="col-md-6">
                                 <div>
                                     <p class="text-primary"><?php echo $subscriptionCheck[0]->admins_avail ?></p>
                                 </div>
                              </div>
                           </div>
                           <br>
                           <div class="form-group">
                              <label class="control-label  col-md-2">Employees:  </label>
                              <div class="col-md-6">
                                 <div>
                                     <p class="text-primary"><?php echo $subscriptionCheck[0]->employees	 ?></p>
                                 </div>
                              </div>
                           </div>
                           <br>
                           <div class="form-group">
                              <label class="control-label  col-md-2">Employees Available:  </label>
                              <div class="col-md-6">
                                 <div>
                                     <p class="text-primary"><?php echo $subscriptionCheck[0]->employees_avail	 ?></p>
                                 </div>
                              </div>
                           </div>
                           <br>
                           <div class="form-group">
                              <label class="control-label  col-md-2">Support:  </label>
                              <div class="col-md-6">
                                 <div>
                                     <p class="text-primary"><?php echo $subscriptionCheck[0]->support	 ?></p>
                                 </div>
                              </div>
                           </div>
                           <br>
                           <div class="form-group">
                              <label class="control-label  col-md-2">Membership Start date:  </label>
                              <div class="col-md-6">
                                 <div>
                                     <p class="text-primary"><?php echo $subscriptionCheck[0]->SUBS_START_DATE	 ?></p>
                                 </div>
                              </div>
                           </div>
                           <br>
                           <div class="form-group">
                              <label class="control-label  col-md-2">Membership expiry date:  </label>
                              <div class="col-md-6">
                                 <div>
                                     <p class="text-primary"><?php echo $subscriptionCheck[0]->SUBS_END_DATE	 ?></p>
                                 </div>
                              </div>
                           </div>
                           <br>
                           <div class="form-group">
                              <label class="control-label  col-md-2">Membership Frequency:  </label>
                              <div class="col-md-6">
                                 <div>
                                     <p class="text-primary"><?php echo $subscriptionCheck[0]->SUBS_FREQUENCY	 ?></p>
                                 </div>
                              </div>
                           </div>

                    <?php }else{
                        if(!$whichPackage){ ?>

                            <!-- enterprise subscription form -->
                             <form role="form" id="enterpriseForm" class="form-horizontal"
                           action="{{ route('subscribe') }}" method="POST">
                           <input type="hidden" name="_method" value="PUT">
                           <input type="hidden" name="_token" value="{{ csrf_token() }}">
                           <input type="hidden" name="category" value="enterprise">
                           <input type="hidden" name="subscription_amount" value="">
                           <input type="hidden" name="PAYGATE_ID" id="PAYGATE_ID" value="10011072130"/>
                           <input type="hidden" name="REFERENCE" id="REFERENCE" value="<?php echo $theUserReference; ?>"/>
                           <input type="hidden" name="AMOUNT" id="AMOUNT" value="<?php echo $countryPricesRow->ent_price; ?>"/>
                           <input type="hidden" name="CURRENCY" id="CURRENCY" value="<?php echo $countryPricesRow->currency_code; ?>"/>
                           <input type="hidden" name="RETURN_URL" id="RETURN_URL" value="<?php echo $fullPath['protocol'] . $fullPath['host'] . '/' . $root . '/dmmx/public/payresult-employer'; ?>"/>
                           <input type="hidden" name="TRANSACTION_DATE" id="TRANSACTION_DATE" value="<?php echo getDateTime('Y-m-d H:i'); ?>"/>
                           <!--<input type="hidden" name="EMAIL" id="EMAIL" value="<?php //echo $userEMail; ?>"/>-->
                           <input type="hidden" name="SUBS_START_DATE" value="<?php echo getDateTime('Y-m-d'); ?>">
                           <input type="hidden" name="SUBS_FREQUENCY" value="229">
                           <input type="hidden" name="SUBS_END_DATE" value="2018-05-04">
                           <input type="hidden" name="PROCESS_NOW" value="YES">
                           <input type="hidden" name="VERSION" value="21">
                           <input type="hidden" name="PROCESS_NOW_AMOUNT" value="<?php echo $countryPricesRow->ent_price; ?>">
                           <input type="hidden" name="LOCALE" id="LOCALE" value="en-za"/>
                           <input type="hidden" name="COUNTRY" id="COUNTRY" value="<?php echo $countryPricesRow->country_code; ?>"/>
                           <input type="hidden" name="standard_category" id=standard_category value="enterprise"/>
                           <input type="hidden" name="downupgrade" id="downupgrade" value="null"/>
                           <input type="hidden" name="sub_countryid" id="sub_countryid" value="<?php echo $countryPricesRow->id; ?>"/>
                           <div class="form-group {{ $errors->first('premiumContracts', 'has-error') }}">
                              <label class="control-label  col-md-2">Period: </label>
                              <div class="col-md-6">
                                 {!! Form::select('subperiod', $subperiod, null,['class' => 'form-control select2', 'id' => 'subperiod']) !!}
                                 <span class="help-block">{{ $errors->first('subperiod', ':message') }}</span>
                              </div>
                           </div>
                           <div class="form-group {{ $errors->first('basicContracts', 'has-error') }}">
                              <label class="control-label  col-md-2">Price: </label>
                              <div class="col-md-6">
                                 <div>
                                    <h4 class="text-primary" id="basicPrice"><?php echo $countryPricesRow->ent_price; ?><?php echo " " .$countryPricesRow->currency_code; ?></h4>
                                 </div>
                              </div>
                           </div>
                           <div class="form-group {{ $errors->first('basicContracts', 'has-error') }}">
                              <label class="control-label  col-md-2">Employees: </label>
                              <div class="col-md-6">
                                 <div>
                                    <h4 class="text-primary" id="basicPrice"><?php echo $countryPricesRow->ent_employees; ?></h4>
                                 </div>
                              </div>
                           </div>
                           <div class="form-group {{ $errors->first('basicContracts', 'has-error') }}">
                              <label class="control-label  col-md-2">Base: </label>
                              <div class="col-md-6">
                                 <div>
                                    <h4 class="text-primary" id="basicPrice"><?php echo $countryPricesRow->ent_base; ?></h4>
                                 </div>
                              </div>
                           </div>
                           <div class="form-group {{ $errors->first('basicContracts', 'has-error') }}">
                              <label class="control-label  col-md-2">Annual Payment Discount</label>
                              <div class="col-md-6">
                                 <div>
                                    <h4 class="text-primary" id="basicPrice"><?php echo $countryPricesRow->ent_discount; ?></h4>
                                 </div>
                              </div>
                           </div>
                           <div class="form-group {{ $errors->first('basicContracts', 'has-error') }}">
                              <label class="control-label  col-md-2">Terms Forms (Active & checks): </label>
                              <div class="col-md-6">
                                 <div>
                                    <h4 class="text-primary" id="basicPrice"><?php echo $countryPricesRow->ent_terms; ?></h4>
                                 </div>
                              </div>
                           </div>
                           <div class="form-group {{ $errors->first('basicContracts', 'has-error') }}">
                              <label class="control-label  col-md-2">Cost per employee or check $: </label>
                              <div class="col-md-6">
                                 <div>
                                    <h4 class="text-primary" id="basicPrice"><?php echo $countryPricesRow->ent_employee_cost; ?></h4>
                                 </div>
                              </div>
                           </div>
                           <div class="form-group {{ $errors->first('basicContracts', 'has-error') }}">
                              <label class="control-label  col-md-2">Support: </label>
                              <div class="col-md-6">
                                 <div>
                                    <h4 class="text-primary" id="basicPrice"><?php echo $countryPricesRow->ent_support; ?></h4>
                                 </div>
                              </div>
                           </div>
                           <div class="form-group {{ $errors->first('basicContracts', 'has-error') }}">
                              <label class="control-label  col-md-2">Users(admins): </label>
                              <div class="col-md-6">
                                 <div>
                                    <h4 class="text-primary" id="basicPrice"><?php echo $countryPricesRow->ent_users; ?></h4>
                                 </div>
                              </div>
                           </div>

                            @if(Sentinel::guest())
                           <h3 class="text-primary"><strong> We realized that you are not logged in or you do not have an account, please quickly fill in the fields below to sign up or <a href="{{ route('login') }}">signin</a></strong></h3>
                           <div class="form-group {{ $errors->first('companyname', 'has-error') }}">
                              <label class="control-label  col-md-2">Company Name: </label>
                              <div class="col-md-6">
                                 <div>
                                    <input type="text" class="form-control" id="companyname" name="companyname" placeholder="Company Name*"
                                       value="{!! old('companyname') !!}" >
                                 </div>
                              </div>
                           </div>
                           <div class="form-group {{ $errors->first('companyname', 'has-error') }}">
                              <label class="control-label  col-md-2"> Company Registration Number:</label>
                              <div class="col-md-6">
                                 <div>
                                    <input type="text" class="form-control" id="registrationnumber" name="registrationnumber" placeholder="Company Registration*"
                                       value="{!! old('registrationnumber') !!}" >
                                 </div>
                              </div>
                              {!! $errors->first('registrationnumber', '<span class="help-block">:message</span>') !!}
                           </div>
                           <div class="form-group {{ $errors->first('first_name', 'has-error') }}">
                              <label class="control-label  col-md-2"> Account Admin First Name</label>
                              <div class="col-md-6">
                                 <div>
                                    <input type="text" class="form-control" id="first_name" name="first_name" placeholder="Account Admin First Name*"
                                       value="{!! old('first_name') !!}" >
                                 </div>
                              </div>
                              {!! $errors->first('first_name', '<span class="help-block">:message</span>') !!}
                           </div>
                           <div class="form-group {{ $errors->first('last_name', 'has-error') }}">
                              <label class="control-label  col-md-2"> Account Admin Last Name</label>
                              <div class="col-md-6">
                                 <div>
                                    <input type="text" class="form-control" id="last_name" name="last_name" placeholder="Account Admin Last Name*"
                                       value="{!! old('last_name') !!}" >
                                 </div>
                              </div>
                              {!! $errors->first('last_name', '<span class="help-block">:message</span>') !!}
                           </div>
                           <div class="form-group {{ $errors->first('email', 'has-error') }}">
                              <label class="control-label  col-md-2"> Email</label>
                              <div class="col-md-6">
                                 <div>
                                    <input type="email" class="form-control" id="Email" name="email" placeholder="Email*"
                                       value="{!! old('Email') !!}" >
                                 </div>
                              </div>
                              {!! $errors->first('email', '<span class="help-block">:message</span>') !!}
                           </div>
                           <div class="form-group {{ $errors->first('password', 'has-error') }}">
                              <label class="control-label  col-md-2"> Password</label>
                              <div class="col-md-6">
                                 <div>
                                    <input type="password" class="form-control" id="Password1" name="password" placeholder="Password*">
                                    {!! $errors->first('password', '<span class="help-block">:message</span>') !!}
                                 </div>
                              </div>
                           </div>
                           <div class="form-group {{ $errors->first('password_confirm', 'has-error') }}">
                              <label class="control-label  col-md-2">  Confirm Password</label>
                              <div class="col-md-6">
                                 <div>
                                    <input type="password" class="form-control" id="Password2" name="password_confirm"
                                       placeholder="Confirm Password*">
                                    {!! $errors->first('password_confirm', '<span class="help-block">:message</span>') !!}
                                 </div>
                              </div>
                           </div>
                           @endif

                           <div class="form-group">
                              <div class="col-lg-offset-2 col-lg-10">
                                 <button class="btn btn-primary" type="submit">Subscribe</button>
                              </div>
                           </div>
                        </form>
                        {{--{!!  Form::close()  !!}--}}

                        <?php }else{
                            //check whether it is an option for downgrade or for upgrade
                            if($whichPackage > $enterpriseNum){ ?>


                            <!--downgrade process -->
                            <!--<p>Details of the process are yet to be given </p>-->
                                             <?php 
						   ///When you downgrade, a check of whether you can downgrade or not is performed
						   //get the number of available employees
						   $employeesAvailStandC = $subscriptionCheck[0]->employees_avail;
						   //get the number of available admins
						   $adminsAvailStandC = $subscriptionCheck[0]->admins_avail;
						   $standardEmployessLimit = str_replace(' ', '',substr($countryPricesRow->pro_employees, strpos($countryPricesRow->pro_employees, "-")+1));
						   $standardAdminsLimit = $countryPricesRow->pro_users;
                           if((($employeesAvailStandC+1) <  $standardEmployessLimit || $adminsAvailStandC < $standardAdminsLimit) && $employeesAvailStandC >= 0){
							   echo "You cannot downgrade to this package";
						   }else{
							$PAYNOW_AMOUNT = ($subscriptionCheck[0]->AMOUNT)/100 - ($countryPricesRow->ent_price);
				      ?>
				 <form role="form" id="standardDowngrade" class="form-horizontal"
                           action="{{ route('subscribe') }}" method="POST">
                           <input type="hidden" name="_method" value="PUT">
                           <input type="hidden" name="_token" value="{{ csrf_token() }}">
                           <input type="hidden" name="category" value="enterprise">
                           <input type="hidden" name="subscription_amount" value="">
                           <input type="hidden" name="PAYGATE_ID" id="PAYGATE_ID" value="10011072130"/>
                           <input type="hidden" name="REFERENCE" id="REFERENCE" value="<?php echo $theUserReference; ?>"/>
                           <input type="hidden" name="AMOUNT" id="AMOUNT" value="<?php echo $countryPricesRow->ent_price; ?>"/>
                           <input type="hidden" name="CURRENCY" id="CURRENCY" value="<?php echo $countryPricesRow->currency_code; ?>"/>
                           <input type="hidden" name="RETURN_URL" id="RETURN_URL" value="<?php echo $fullPath['protocol'] . $fullPath['host'] . '/' . $root . '/dmmx/public/payresult-employer'; ?>"/>
                           <input type="hidden" name="TRANSACTION_DATE" id="TRANSACTION_DATE" value="<?php echo getDateTime('Y-m-d H:i'); ?>"/>
                           <!--<input type="hidden" name="EMAIL" id="EMAIL" value="<?php //echo $userEMail; ?>"/>-->
                           <input type="hidden" name="SUBS_START_DATE" value="<?php echo getDateTime('Y-m-d'); ?>">
                           <input type="hidden" name="SUBS_FREQUENCY" value="229">
                           <input type="hidden" name="SUBS_END_DATE" value="2018-05-04">
                           <input type="hidden" name="PROCESS_NOW" value="YES">
                           <input type="hidden" name="VERSION" value="21">
                           <input type="hidden" name="PROCESS_NOW_AMOUNT" value="<?php echo $PAYNOW_AMOUNT ; ?>">
                           <input type="hidden" name="LOCALE" id="LOCALE" value="<?php echo $locale; ?>"/>
                           <input type="hidden" name="COUNTRY" id="COUNTRY" value="<?php echo $userCountryCode; ?>"/>
                           <input type="hidden" name="standard_category" id="standard_category" value="enterprise"/>
                           <input type="hidden" name="downupgrade" id="downupgrade" value="downgrade"/>
                           <input type="hidden" name="sub_countryid" id="sub_countryid" value="<?php echo $countryPricesRow->id; ?>"/>
                          
                           <div class="form-group {{ $errors->first('basicContracts', 'has-error') }}">
                              <label class="control-label  col-md-2">Period: </label>
                              <div class="col-md-6">
                                 {!! Form::select('subperiod', $subperiod, null,['class' => 'form-control select2', 'id' => 'subperiod']) !!}
                                 <span class="help-block">{{ $errors->first('subperiod', ':message') }}</span>
                              </div>
                           </div>
                           <div class="form-group {{ $errors->first('basicContracts', 'has-error') }}">
                              <label class="control-label  col-md-2">Price: </label>
                              <div class="col-md-6">
                                 <div>
                                    <h4 class="text-primary" id="basicPrice"><?php echo $countryPricesRow->ent_price; ?><?php echo " " .$countryPricesRow->currency_code; ?></h4>
                                 </div>
                              </div>
                           </div>
                           <!--<div class="form-group {{ $errors->first('basicContracts', 'has-error') }}">
                              <label class="control-label  col-md-2">Refund Amount: </label>
                              <div class="col-md-6">
                                 <div>
                                    <h4 class="text-primary" id="basicPrice"><?php //echo $PAYNOW_AMOUNT; ?><?php //echo " " .$countryPricesRow->currency_code; ?></h4>
                                 </div>
                              </div>
                           </div>-->
                           <div class="form-group {{ $errors->first('basicContracts', 'has-error') }}">
                              <label class="control-label  col-md-2">Employees: </label>
                              <div class="col-md-6">
                                 <div>
                                    <h4 class="text-primary" id="basicPrice"><?php echo $countryPricesRow->ent_employees; ?></h4>
                                 </div>
                              </div>
                           </div>
                           <div class="form-group {{ $errors->first('basicContracts', 'has-error') }}">
                              <label class="control-label  col-md-2">Base: </label>
                              <div class="col-md-6">
                                 <div>
                                    <h4 class="text-primary" id="basicPrice"><?php echo $countryPricesRow->ent_base; ?></h4>
                                 </div>
                              </div>
                           </div>
                           <div class="form-group {{ $errors->first('basicContracts', 'has-error') }}">
                              <label class="control-label  col-md-2">Annual Payment Discount: </label>
                              <div class="col-md-6">
                                 <div>
                                    <h4 class="text-primary" id="basicPrice"><?php echo $countryPricesRow->ent_discount; ?></h4>
                                 </div>
                              </div>
                           </div>
                           <div class="form-group {{ $errors->first('basicContracts', 'has-error') }}">
                              <label class="control-label  col-md-2">Terms Forms (Active & checks): </label>
                              <div class="col-md-6">
                                 <div>
                                    <h4 class="text-primary" id="basicPrice"><?php echo $countryPricesRow->ent_terms; ?></h4>
                                 </div>
                              </div>
                           </div>
                           <div class="form-group {{ $errors->first('basicContracts', 'has-error') }}">
                              <label class="control-label  col-md-2">Cost per employee or check $: </label>
                              <div class="col-md-6">
                                 <div>
                                    <h4 class="text-primary" id="basicPrice"><?php echo $countryPricesRow->ent_employees; ?></h4>
                                 </div>
                              </div>
                           </div>
                           <div class="form-group {{ $errors->first('basicContracts', 'has-error') }}">
                              <label class="control-label  col-md-2">Support: </label>
                              <div class="col-md-6">
                                 <div>
                                    <h4 class="text-primary" id="basicPrice"><?php echo $countryPricesRow->ent_support; ?></h4>
                                 </div>
                              </div>
                           </div>
                           <div class="form-group {{ $errors->first('basicContracts', 'has-error') }}">
                              <label class="control-label  col-md-2">Users(admins): </label>
                              <div class="col-md-6">
                                 <div>
                                    <h4 class="text-primary" id="basicPrice"><?php echo $countryPricesRow->ent_users; ?></h4>
                                 </div>
                              </div>
                           </div>
                           <div class="form-group">
                              <div class="col-lg-offset-2 col-lg-10">
                                 <button class="btn btn-primary" type="submit">Downgrade</button>
                              </div>
                           </div>
                        </form>
                        {{--{!!  Form::close()  !!}--}}
						
						   <?php } ?>


                            <?php }else{ ?>

                               <!--upgrade process -->
                            <!--<p>Details of the process are yet to be given </p>-->
                                             <form role="form" id="businessUpgrade" class="form-horizontal"
                           action="{{ route('subscribe') }}" method="POST">
                           <input type="hidden" name="_method" value="PUT">
                           <input type="hidden" name="_token" value="{{ csrf_token() }}">
                           <input type="hidden" name="category" value="enterprise">
                           <input type="hidden" name="subscription_amount" value="">
                           <input type="hidden" name="PAYGATE_ID" id="PAYGATE_ID" value="10011072130"/>
                           <input type="hidden" name="REFERENCE" id="REFERENCE" value="<?php echo $theUserReference; ?>"/>
						   <?php //The upgrade amount
						   //We need to know the monetory value of the current package 
						   $currentPackage = $whichPackage;
						   $CurrentPackageCost = ($subscriptionCheck[0]->AMOUNT)/100;
						   $enterprisePackageCost = $countryPricesRow->ent_price;
						   $packagesEntDifference = $enterprisePackageCost - $CurrentPackageCost;
							$PAYNOW_AMOUNT = $packagesEntDifference;
						   //The logic below should happen in the confirmation page
						 /*  if($packagesBusDifference > 0){
							   //the user needs to pay a certain amount
						   }
						   if($packagesBusDifference < 0){
							   //the user needs to be refunded
						   }*/
						   //To know whether the subscription is an upgrade or a downgrade, we will know by the existance of a package already in the database
						   ?>
                           <input type="hidden" name="AMOUNT" id="AMOUNT" value="<?php echo $countryPricesRow->ent_price; ?>"/>
                           <input type="hidden" name="CURRENCY" id="CURRENCY" value="<?php echo $countryPricesRow->currency_code; ?>"/>
                           <input type="hidden" name="RETURN_URL" id="RETURN_URL" value="<?php echo $fullPath['protocol'] . $fullPath['host'] . '/' . $root . '/dmmx/public/payresult-employer'; ?>"/>
                           <input type="hidden" name="TRANSACTION_DATE" id="TRANSACTION_DATE" value="<?php echo getDateTime('Y-m-d H:i'); ?>"/>
                           <!--<input type="hidden" name="EMAIL" id="EMAIL" value="<?php //echo $userEMail; ?>"/>-->
                           <input type="hidden" name="SUBS_START_DATE" value="<?php echo getDateTime('Y-m-d'); ?>">
                           <input type="hidden" name="SUBS_FREQUENCY" value="229">
                           <input type="hidden" name="SUBS_END_DATE" value="2018-05-04">
                           <input type="hidden" name="PROCESS_NOW" value="YES">
                           <input type="hidden" name="VERSION" value="21">
                           <input type="hidden" name="PROCESS_NOW_AMOUNT" value="<?php echo $PAYNOW_AMOUNT ; ?>">
                           <input type="hidden" name="LOCALE" id="LOCALE" value="<?php echo $locale; ?>"/>
                           <input type="hidden" name="COUNTRY" id="COUNTRY" value="<?php echo $userCountryCode; ?>"/>
                           <input type="hidden" name="standard_category" id="standard_category" value="enterprise"/>
                           <input type="hidden" name="downupgrade" id="downupgrade" value="null"/>
                           <input type="hidden" name="sub_countryid" id="sub_countryid" value="<?php echo $countryPricesRow->id; ?>"/>
                          
                           <div class="form-group {{ $errors->first('basicContracts', 'has-error') }}">
                              <label class="control-label  col-md-2">Period: </label>
                              <div class="col-md-6">
                                 {!! Form::select('subperiod', $subperiod, null,['class' => 'form-control select2', 'id' => 'subperiod']) !!}
                                 <span class="help-block">{{ $errors->first('subperiod', ':message') }}</span>
                              </div>
                           </div>
                           <div class="form-group {{ $errors->first('basicContracts', 'has-error') }}">
                              <label class="control-label  col-md-2">Price: </label>
                              <div class="col-md-6">
                                 <div>
                                    <h4 class="text-primary" id="basicPrice"><?php echo $countryPricesRow->ent_price; ?><?php echo " " .$countryPricesRow->currency_code; ?></h4>
                                 </div>
                              </div>
                           </div>
                           <!--<div class="form-group {{ $errors->first('basicContracts', 'has-error') }}">
                              <label class="control-label  col-md-2">Additional Amount Required: </label>
                              <div class="col-md-6">
                                 <div>
                                    <h4 class="text-primary" id="basicPrice"><?php// echo $PAYNOW_AMOUNT; ?><?php //echo " " .$countryPricesRow->currency_code; ?></h4>
                                 </div>
                              </div>
                           </div>-->
                           <div class="form-group {{ $errors->first('basicContracts', 'has-error') }}">
                              <label class="control-label  col-md-2">Employees: </label>
                              <div class="col-md-6">
                                 <div>
                                    <h4 class="text-primary" id="basicPrice"><?php echo $countryPricesRow->ent_employees; ?></h4>
                                 </div>
                              </div>
                           </div>
                           <div class="form-group {{ $errors->first('basicContracts', 'has-error') }}">
                              <label class="control-label  col-md-2">Base: </label>
                              <div class="col-md-6">
                                 <div>
                                    <h4 class="text-primary" id="basicPrice"><?php echo $countryPricesRow->ent_base; ?></h4>
                                 </div>
                              </div>
                           </div>
                           <div class="form-group {{ $errors->first('basicContracts', 'has-error') }}">
                              <label class="control-label  col-md-2">Annual Payment Discount: </label>
                              <div class="col-md-6">
                                 <div>
                                    <h4 class="text-primary" id="basicPrice"><?php echo $countryPricesRow->ent_discount; ?></h4>
                                 </div>
                              </div>
                           </div>
                           <div class="form-group {{ $errors->first('basicContracts', 'has-error') }}">
                              <label class="control-label  col-md-2">Terms Forms (Active & checks): </label>
                              <div class="col-md-6">
                                 <div>
                                    <h4 class="text-primary" id="basicPrice"><?php echo $countryPricesRow->ent_terms; ?></h4>
                                 </div>
                              </div>
                           </div>
                           <div class="form-group {{ $errors->first('basicContracts', 'has-error') }}">
                              <label class="control-label  col-md-2">Cost per employee or check $: </label>
                              <div class="col-md-6">
                                 <div>
                                    <h4 class="text-primary" id="basicPrice"><?php echo $countryPricesRow->ent_employee_cost; ?></h4>
                                 </div>
                              </div>
                           </div>
                           <div class="form-group {{ $errors->first('basicContracts', 'has-error') }}">
                              <label class="control-label  col-md-2">Support: </label>
                              <div class="col-md-6">
                                 <div>
                                    <h4 class="text-primary" id="basicPrice"><?php echo $countryPricesRow->ent_support; ?></h4>
                                 </div>
                              </div>
                           </div>
                           <div class="form-group {{ $errors->first('basicContracts', 'has-error') }}">
                              <label class="control-label  col-md-2">Users(admins): </label>
                              <div class="col-md-6">
                                 <div>
                                    <h4 class="text-primary" id="basicPrice"><?php echo $countryPricesRow->ent_users; ?></h4>
                                 </div>
                              </div>
                           </div>
                           <div class="form-group">
                              <div class="col-lg-offset-2 col-lg-10">
                                 <button class="btn btn-primary" type="submit">Upgrade</button>
                              </div>
                           </div>
                        </form>
                        {{--{!!  Form::close()  !!}--}}


                            <?php }
                        }
                    }
                    ?>
                     
                            </div>
                        </div>
                    </div>

                    <div id="tab5" class="tab-pane fade">
                        <div class="row">
                            <div class="col-md-12 pd-top">

                                 
                                 <?php if($whichPackage == $eliteNum){ ?>

                        <!-- elite details -->
                        <div class="form-group">
                              <label class="control-label  col-md-2">Package:  </label>
                              <div class="col-md-6">
                                 <div>
                                     <p class="text-primary">Elite</p>
                                 </div>
                              </div>
                           </div>
                            <br>
                           <div class="form-group">
                              <label class="control-label  col-md-2">Reference:  </label>
                              <div class="col-md-6">
                                 <div>
                                     <p class="text-primary"><?php echo $subscriptionCheck[0]->REFERENCE ?></p>
                                 </div>
                              </div>
                           </div>
                           <br>
                           <div class="form-group">
                              <label class="control-label  col-md-2">Amount:  </label>
                              <div class="col-md-6">
                                 <div>
                                     <p class="text-primary"><?php echo ($subscriptionCheck[0]->AMOUNT)/100  ." " .$subscriptionCheck[0]->sub_currencycode ?></p>
                                 </div>
                              </div>
                           </div>
                           <br>
                           <div class="form-group">
                              <label class="control-label  col-md-2">Number of Allowed Admins:  </label>
                              <div class="col-md-6">
                                 <div>
                                     <p class="text-primary"><?php echo $subscriptionCheck[0]->quantity_admins ?></p>
                                 </div>
                              </div>
                           </div>
                           <br><br>
                           <div class="form-group">
                              <label class="control-label  col-md-2">Admins Available:  </label>
                              <div class="col-md-6">
                                 <div>
                                     <p class="text-primary"><?php echo $subscriptionCheck[0]->admins_avail ?></p>
                                 </div>
                              </div>
                           </div>
                           <br>
                           <div class="form-group">
                              <label class="control-label  col-md-2">Employees:  </label>
                              <div class="col-md-6">
                                 <div>
                                     <p class="text-primary"><?php echo $subscriptionCheck[0]->employees	 ?></p>
                                 </div>
                              </div>
                           </div>
                           <br>
                           <div class="form-group">
                              <label class="control-label  col-md-2">Employees Available:  </label>
                              <div class="col-md-6">
                                 <div>
                                     <p class="text-primary"><?php echo $subscriptionCheck[0]->employees_avail	 ?></p>
                                 </div>
                              </div>
                           </div>
                           <br>
                           <div class="form-group">
                              <label class="control-label  col-md-2">Support:  </label>
                              <div class="col-md-6">
                                 <div>
                                     <p class="text-primary"><?php echo $subscriptionCheck[0]->support	 ?></p>
                                 </div>
                              </div>
                           </div>
                           <br>
                           <div class="form-group">
                              <label class="control-label  col-md-2">Membership Start date:  </label>
                              <div class="col-md-6">
                                 <div>
                                     <p class="text-primary"><?php echo $subscriptionCheck[0]->SUBS_START_DATE	 ?></p>
                                 </div>
                              </div>
                           </div>
                           <br><br>
                           <div class="form-group">
                              <label class="control-label  col-md-2">Membership expiry date:  </label>
                              <div class="col-md-6">
                                 <div>
                                     <p class="text-primary"><?php echo $subscriptionCheck[0]->SUBS_END_DATE	 ?></p>
                                 </div>
                              </div>
                           </div>
                           <br><br>
                           <div class="form-group">
                              <label class="control-label  col-md-2">Membership Frequency:  </label>
                              <div class="col-md-6">
                                 <div>
                                     <p class="text-primary"><?php echo $subscriptionCheck[0]->SUBS_FREQUENCY	 ?></p>
                                 </div>
                              </div>
                           </div>
                        

                    <?php }else{
                        if(!$whichPackage){ ?>

                            
                            <!-- Elite Subscription form -->
                              <form role="form" id="eliteForm" class="form-horizontal"
                           action="{{ route('subscribe') }}" method="POST">
                           <input type="hidden" name="_method" value="PUT">
                           <input type="hidden" name="_token" value="{{ csrf_token() }}">
                           <input type="hidden" name="category" value="elite">
                           <input type="hidden" name="subscription_amount" value="">
                           <input type="hidden" name="PAYGATE_ID" id="PAYGATE_ID" value="10011072130"/>
                           <input type="hidden" name="REFERENCE" id="REFERENCE" value="<?php echo $theUserReference; ?>"/>
                           <input type="hidden" name="AMOUNT" id="AMOUNT" value="<?php echo str_replace(' ', '',$countryPricesRow->el_price); ?>"/>
                           <input type="hidden" name="CURRENCY" id="CURRENCY" value="<?php echo $countryPricesRow->currency_code; ?>"/>
                           <input type="hidden" name="RETURN_URL" id="RETURN_URL" value="<?php echo $fullPath['protocol'] . $fullPath['host'] . '/' . $root . '/dmmx/public/payresult-employer'; ?>"/>
                           <input type="hidden" name="TRANSACTION_DATE" id="TRANSACTION_DATE" value="<?php echo getDateTime('Y-m-d H:i'); ?>"/>
                           <!--<input type="hidden" name="EMAIL" id="EMAIL" value="<?php //echo $userEMail; ?>"/>-->
                           <input type="hidden" name="SUBS_START_DATE" value="<?php echo getDateTime('Y-m-d'); ?>">
                           <input type="hidden" name="SUBS_FREQUENCY" value="229">
                           <input type="hidden" name="SUBS_END_DATE" value="2018-05-04">
                           <input type="hidden" name="PROCESS_NOW" value="YES">
                           <input type="hidden" name="VERSION" value="21">
                           <input type="hidden" name="PROCESS_NOW_AMOUNT" value="<?php echo str_replace(' ', '',$countryPricesRow->el_price); ?>">
                           <input type="hidden" name="LOCALE" id="LOCALE" value="<?php echo $locale; ?>"/>
                           <input type="hidden" name="COUNTRY" id="COUNTRY" value="<?php echo $userCountryCode; ?>"/>
                           <input type="hidden" name="standard_category" id="standard_category" value="elite"/>
                           <input type="hidden" name="downupgrade" id="downupgrade" value="null"/>
                           <input type="hidden" name="sub_countryid" id="sub_countryid" value="<?php echo $countryPricesRow->id; ?>"/>
                           <div class="form-group {{ $errors->first('premiumContracts', 'has-error') }}">
                              <label class="control-label  col-md-2">Period: </label>
                              <div class="col-md-6">
                                 {!! Form::select('subperiod', $subperiod, null,['class' => 'form-control select2', 'id' => 'subperiod']) !!}
                                 <span class="help-block">{{ $errors->first('subperiod', ':message') }}</span>
                              </div>
                           </div>
                           <div class="form-group {{ $errors->first('basicContracts', 'has-error') }}">
                              <label class="control-label  col-md-2">Price: </label>
                              <div class="col-md-6">
                                 <div>
                                    <h4 class="text-primary" id="basicPrice"><?php echo $countryPricesRow->el_price; ?><?php echo " " .$countryPricesRow->currency_code; ?></h4>
                                 </div>
                              </div>
                           </div>
                           <div class="form-group {{ $errors->first('basicContracts', 'has-error') }}">
                              <label class="control-label  col-md-2">Employees: </label>
                              <div class="col-md-6">
                                 <div>
                                    <h4 class="text-primary" id="basicPrice"><?php echo $countryPricesRow->el_employees; ?></h4>
                                 </div>
                              </div>
                           </div>
                           <div class="form-group {{ $errors->first('basicContracts', 'has-error') }}">
                              <label class="control-label  col-md-2">Base: </label>
                              <div class="col-md-6">
                                 <div>
                                    <h4 class="text-primary" id="basicPrice"><?php echo $countryPricesRow->el_base; ?></h4>
                                 </div>
                              </div>
                           </div>
                           <div class="form-group {{ $errors->first('basicContracts', 'has-error') }}">
                              <label class="control-label  col-md-2">Annual Payment Discount</label>
                              <div class="col-md-6">
                                 <div>
                                    <h4 class="text-primary" id="basicPrice"><?php echo $countryPricesRow->el_discount; ?></h4>
                                 </div>
                              </div>
                           </div>
                           <div class="form-group {{ $errors->first('basicContracts', 'has-error') }}">
                              <label class="control-label  col-md-2">Terms Forms (Active & checks): </label>
                              <div class="col-md-6">
                                 <div>
                                    <h4 class="text-primary" id="basicPrice"><?php echo $countryPricesRow->el_terms; ?></h4>
                                 </div>
                              </div>
                           </div>
                           <div class="form-group {{ $errors->first('basicContracts', 'has-error') }}">
                              <label class="control-label  col-md-2">Cost per employee or check $: </label>
                              <div class="col-md-6">
                                 <div>
                                    <h4 class="text-primary" id="basicPrice"><?php echo $countryPricesRow->el_employee_cost; ?></h4>
                                 </div>
                              </div>
                           </div>
                           <div class="form-group {{ $errors->first('basicContracts', 'has-error') }}">
                              <label class="control-label  col-md-2">Support: </label>
                              <div class="col-md-6">
                                 <div>
                                    <h4 class="text-primary" id="basicPrice"><?php echo $countryPricesRow->el_support; ?></h4>
                                 </div>
                              </div>
                           </div>
                           <div class="form-group {{ $errors->first('basicContracts', 'has-error') }}">
                              <label class="control-label  col-md-2">Users(admins): </label>
                              <div class="col-md-6">
                                 <div>
                                    <h4 class="text-primary" id="basicPrice"><?php echo $countryPricesRow->el_users; ?></h4>
                                 </div>
                              </div>
                           </div>

                           @if(Sentinel::guest())
                           <h3 class="text-primary"><strong> We realized that you are not logged in or you do not have an account, please quickly fill in the fields below to sign up or <a href="{{ route('login') }}">signin</a></strong></h3>
                           <div class="form-group {{ $errors->first('companyname', 'has-error') }}">
                              <label class="control-label  col-md-2">Company Name: </label>
                              <div class="col-md-6">
                                 <div>
                                    <input type="text" class="form-control" id="companyname" name="companyname" placeholder="Company Name*"
                                       value="{!! old('companyname') !!}" >
                                 </div>
                              </div>
                           </div>
                           <div class="form-group {{ $errors->first('companyname', 'has-error') }}">
                              <label class="control-label  col-md-2"> Company Registration Number:</label>
                              <div class="col-md-6">
                                 <div>
                                    <input type="text" class="form-control" id="registrationnumber" name="registrationnumber" placeholder="Company Registration*"
                                       value="{!! old('registrationnumber') !!}" >
                                 </div>
                              </div>
                              {!! $errors->first('registrationnumber', '<span class="help-block">:message</span>') !!}
                           </div>
                           <div class="form-group {{ $errors->first('first_name', 'has-error') }}">
                              <label class="control-label  col-md-2"> Account Admin First Name</label>
                              <div class="col-md-6">
                                 <div>
                                    <input type="text" class="form-control" id="first_name" name="first_name" placeholder="Account Admin First Name*"
                                       value="{!! old('first_name') !!}" >
                                 </div>
                              </div>
                              {!! $errors->first('first_name', '<span class="help-block">:message</span>') !!}
                           </div>
                           <div class="form-group {{ $errors->first('last_name', 'has-error') }}">
                              <label class="control-label  col-md-2"> Account Admin Last Name</label>
                              <div class="col-md-6">
                                 <div>
                                    <input type="text" class="form-control" id="last_name" name="last_name" placeholder="Account Admin Last Name*"
                                       value="{!! old('last_name') !!}" >
                                 </div>
                              </div>
                              {!! $errors->first('last_name', '<span class="help-block">:message</span>') !!}
                           </div>
                           <div class="form-group {{ $errors->first('email', 'has-error') }}">
                              <label class="control-label  col-md-2"> Email</label>
                              <div class="col-md-6">
                                 <div>
                                    <input type="email" class="form-control" id="Email" name="email" placeholder="Email*"
                                       value="{!! old('Email') !!}" >
                                 </div>
                              </div>
                              {!! $errors->first('email', '<span class="help-block">:message</span>') !!}
                           </div>
                           <div class="form-group {{ $errors->first('password', 'has-error') }}">
                              <label class="control-label  col-md-2"> Password</label>
                              <div class="col-md-6">
                                 <div>
                                    <input type="password" class="form-control" id="Password1" name="password" placeholder="Password*">
                                    {!! $errors->first('password', '<span class="help-block">:message</span>') !!}
                                 </div>
                              </div>
                           </div>
                           <div class="form-group {{ $errors->first('password_confirm', 'has-error') }}">
                              <label class="control-label  col-md-2">  Confirm Password</label>
                              <div class="col-md-6">
                                 <div>
                                    <input type="password" class="form-control" id="Password2" name="password_confirm"
                                       placeholder="Confirm Password*">
                                    {!! $errors->first('password_confirm', '<span class="help-block">:message</span>') !!}
                                 </div>
                              </div>
                           </div>
                           @endif

                           <div class="form-group">
                              <div class="col-lg-offset-2 col-lg-10">
                                 <button class="btn btn-primary" type="submit">Subscribe</button>
                              </div>
                           </div>
                        </form>
                        {{--{!!  Form::close()  !!}--}}


                        <?php }else{
                            //check whether it is an option for downgrade or for upgrade
                            if($whichPackage > $eliteNum){ ?>

                            <!--downgrade process. Since this is the highest subscription level, this section is unnecessary -->
                            <p>Details of the process are yet to be given </p>

                            <?php }else{ ?>

                               <!--upgrade process -->
                            <!--<p>Details of the process are yet to be given </p>-->
                                             <form role="form" id="businessUpgrade" class="form-horizontal"
                           action="{{ route('subscribe') }}" method="POST">
                           <input type="hidden" name="_method" value="PUT">
                           <input type="hidden" name="_token" value="{{ csrf_token() }}">
                           <input type="hidden" name="category" value="elite">
                           <input type="hidden" name="subscription_amount" value="">
                           <input type="hidden" name="PAYGATE_ID" id="PAYGATE_ID" value="10011072130"/>
                           <input type="hidden" name="REFERENCE" id="REFERENCE" value="<?php echo $theUserReference; ?>"/>
						   <?php //The upgrade amount
						   //We need to know the monetory value of the current package 
						   $currentPackage = $whichPackage;
						   $CurrentPackageCost = ($subscriptionCheck[0]->AMOUNT)/100;
						   $elitePackageCost = str_replace(' ', '',$countryPricesRow->el_price);
						   $packagesElDifference = $elitePackageCost - $CurrentPackageCost;
							$PAYNOW_AMOUNT = $packagesElDifference;
						   //The logic below should happen in the confirmation page
						 /*  if($packagesBusDifference > 0){
							   //the user needs to pay a certain amount
						   }
						   if($packagesBusDifference < 0){
							   //the user needs to be refunded
						   }*/
						   //To know whether the subscription is an upgrade or a downgrade, we will know by the existance of a package already in the database
						   ?>
                           <input type="hidden" name="AMOUNT" id="AMOUNT" value="<?php echo str_replace(' ', '',$countryPricesRow->el_price); ?>"/>
                           <input type="hidden" name="CURRENCY" id="CURRENCY" value="<?php echo $countryPricesRow->currency_code; ?>"/>
                           <input type="hidden" name="RETURN_URL" id="RETURN_URL" value="<?php echo $fullPath['protocol'] . $fullPath['host'] . '/' . $root . '/dmmx/public/payresult-employer'; ?>"/>
                           <input type="hidden" name="TRANSACTION_DATE" id="TRANSACTION_DATE" value="<?php echo getDateTime('Y-m-d H:i'); ?>"/>
                           <!--<input type="hidden" name="EMAIL" id="EMAIL" value="<?php //echo $userEMail; ?>"/>-->
                           <input type="hidden" name="SUBS_START_DATE" value="<?php echo getDateTime('Y-m-d'); ?>">
                           <input type="hidden" name="SUBS_FREQUENCY" value="229">
                           <input type="hidden" name="SUBS_END_DATE" value="2018-05-04">
                           <input type="hidden" name="PROCESS_NOW" value="YES">
                           <input type="hidden" name="VERSION" value="21">
                           <input type="hidden" name="PROCESS_NOW_AMOUNT" value="<?php echo $PAYNOW_AMOUNT ; ?>">
                           <input type="hidden" name="LOCALE" id="LOCALE" value="<?php echo $locale; ?>"/>
                           <input type="hidden" name="COUNTRY" id="COUNTRY" value="<?php echo $userCountryCode; ?>"/>
                           <input type="hidden" name="standard_category" id="standard_category" value="elite"/>
                           <input type="hidden" name="downupgrade" id="downupgrade" value="null"/>
                           <input type="hidden" name="sub_countryid" id="sub_countryid" value="<?php echo $countryPricesRow->id; ?>"/>
                          
                           <div class="form-group {{ $errors->first('basicContracts', 'has-error') }}">
                              <label class="control-label  col-md-2">Period: </label>
                              <div class="col-md-6">
                                 {!! Form::select('subperiod', $subperiod, null,['class' => 'form-control select2', 'id' => 'subperiod']) !!}
                                 <span class="help-block">{{ $errors->first('subperiod', ':message') }}</span>
                              </div>
                           </div>
                           <div class="form-group {{ $errors->first('basicContracts', 'has-error') }}">
                              <label class="control-label  col-md-2">Price: </label>
                              <div class="col-md-6">
                                 <div>
                                    <h4 class="text-primary" id="basicPrice"><?php echo $countryPricesRow->el_price; ?><?php echo " " .$countryPricesRow->currency_code; ?></h4>
                                 </div>
                              </div>
                           </div>
                           <!--<div class="form-group {{ $errors->first('basicContracts', 'has-error') }}">
                              <label class="control-label  col-md-2">Additional Amount Required: </label>
                              <div class="col-md-6">
                                 <div>
                                    <h4 class="text-primary" id="basicPrice"><?php //echo $PAYNOW_AMOUNT; ?><?php //echo " " .$countryPricesRow->currency_code; ?></h4>
                                 </div>
                              </div>
                           </div>-->
                           <div class="form-group {{ $errors->first('basicContracts', 'has-error') }}">
                              <label class="control-label  col-md-2">Employees: </label>
                              <div class="col-md-6">
                                 <div>
                                    <h4 class="text-primary" id="basicPrice"><?php echo $countryPricesRow->el_employees; ?></h4>
                                 </div>
                              </div>
                           </div>
                           <div class="form-group {{ $errors->first('basicContracts', 'has-error') }}">
                              <label class="control-label  col-md-2">Base: </label>
                              <div class="col-md-6">
                                 <div>
                                    <h4 class="text-primary" id="basicPrice"><?php echo $countryPricesRow->el_base; ?></h4>
                                 </div>
                              </div>
                           </div>
                           <div class="form-group {{ $errors->first('basicContracts', 'has-error') }}">
                              <label class="control-label  col-md-2">Annual Payment Discount: </label>
                              <div class="col-md-6">
                                 <div>
                                    <h4 class="text-primary" id="basicPrice"><?php echo $countryPricesRow->el_discount; ?></h4>
                                 </div>
                              </div>
                           </div>
                           <div class="form-group {{ $errors->first('basicContracts', 'has-error') }}">
                              <label class="control-label  col-md-2">Terms Forms (Active & checks): </label>
                              <div class="col-md-6">
                                 <div>
                                    <h4 class="text-primary" id="basicPrice"><?php echo $countryPricesRow->el_terms; ?></h4>
                                 </div>
                              </div>
                           </div>
                           <div class="form-group {{ $errors->first('basicContracts', 'has-error') }}">
                              <label class="control-label  col-md-2">Cost per employee or check $: </label>
                              <div class="col-md-6">
                                 <div>
                                    <h4 class="text-primary" id="basicPrice"><?php echo $countryPricesRow->el_employee_cost; ?></h4>
                                 </div>
                              </div>
                           </div>
                           <div class="form-group {{ $errors->first('basicContracts', 'has-error') }}">
                              <label class="control-label  col-md-2">Support: </label>
                              <div class="col-md-6">
                                 <div>
                                    <h4 class="text-primary" id="basicPrice"><?php echo $countryPricesRow->el_support; ?></h4>
                                 </div>
                              </div>
                           </div>
                           <div class="form-group {{ $errors->first('basicContracts', 'has-error') }}">
                              <label class="control-label  col-md-2">Users(admins): </label>
                              <div class="col-md-6">
                                 <div>
                                    <h4 class="text-primary" id="basicPrice"><?php echo $countryPricesRow->el_users; ?></h4>
                                 </div>
                              </div>
                           </div>
                           <div class="form-group">
                              <div class="col-lg-offset-2 col-lg-10">
                                 <button class="btn btn-primary" type="submit">Upgrade</button>
                              </div>
                           </div>
                        </form>
                        {{--{!!  Form::close()  !!}--}}
                            
                            <?php }
                        }
                    }
                    ?>


                               
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
            //Do the yearly calculations

        });

        $("#subscribe").addClass("active");
    </script>
@stop
