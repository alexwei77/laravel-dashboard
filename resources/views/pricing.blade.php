<?php $og = new OpenGraph(); 
$og->title('Pricing - StaffLife.com')
        ->image("")
        ->description("Stafflife provides pricing options to suit any business - from a home office to the largest corporations. Simple plans with no hidden fees, contracts, or setup.")
        ->url();
?>
<!DOCTYPE html>
<html lang="en">
<head>
{!! $og->renderTags() !!}
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description"
          content="Stafflife provides pricing options to suit any business - from a home office to the largest corporations. Simple plans with no hidden fees, contracts, or setup.">
    <link rel="shortcut icon" href="{{ asset('assets/images/favicon.png') }}" type="image/x-icon">
    <link rel="icon" href="{{ asset('assets/images/favicon.png') }}" type="image/x-icon">
    @include('layouts/csp')
</head>

@extends('layouts/defaultboth')
{{-- Page title --}}
@section('title')
    Pricing
    @parent
@stop
{{-- page level styles --}}
@section('header_styles')
    <link rel="shortcut icon" href="{{ asset('assets/images/favicon.png') }}" type="image/x-icon">
    <link rel="icon" href="{{ asset('assets/images/favicon.png') }}" type="image/x-icon">
    <!--page level css starts-->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/frontend/tabbular.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendors/animate/animate.min.css') }}"/>
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/frontend/jquery.circliful.css') }}">

    <!--end of page level css-->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/frontend/shopping.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/font-awesome.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/frontend/price.css') }}">
    <link href="{{ asset('assets/vendors/animate/animate.min.css') }}" rel="stylesheet" type="text/css"/>
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendors/iCheck/css/all.css') }}"/>
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendors/iCheck/css/line/line.css') }}"/>
    <link rel="stylesheet" type="text/css"
          href="{{ asset('assets/vendors/bootstrap-switch/css/bootstrap-switch.css') }}"/>
    <link rel="stylesheet" type="text/css"
          href="{{ asset('assets/vendors/awesomeBootstrapCheckbox/awesome-bootstrap-checkbox.css') }}"/>
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/pages/formelements.css') }}"/>
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/frontend/indexboth.css') }}">

    <style>

        .bg-default th h4 {
            font-size: 22px;
        }

        .table > tbody > tr > td {
            border-bottom: none;
            border-top: none;
        }

        td p {
            text-align: center;
            /* margin-top: 10px; */
            font-size: 16px;
        }

        .table > tbody > tr > td {
            padding: 8px;
            line-height: 1.42857143;
            vertical-align: middle;
        }

        .box_round_symboll {
            font-size: 30px !important;
        }

        .price-bn-yearly {
            margin-top: 10px;
            background-color: #4caf50;
            width: 100%;
            color: #fff !important;
            font-size: 16px;
        }

        .orange-tooltip + .tooltip > .tooltip-inner {
            background-color: #bababa;
            font-size: 16px;
        }

        .ui-segment {
            color: #ffffff;
            border: 0;
            border-radius: 0;
            display: inline-block;
            margin-bottom: 20px;
        }

        .ui-segment span.option.active {
            color: white;
            background-color: #4caf50;
            pointer-event: none;
        }

        .ui-segment span.option.active:hover {
            background-color: #4caf50;
        }

        .ui-segment span.option {
            background-color: #bababa;
            font-size: 17px;
            text-transform: uppercase;
            padding: 10px;
            min-width: 200px;
            text-align: center;
            display: inline-block;
            line-height: 25px;
            margin: 0px;
            float: left;
            cursor: pointer;
        }

        @media (max-width:486px){
            .ui-segment span.option {
                width: 90% !important;
                margin-left:5%;
            }
        }
        .ui-segment span.option:hover {
            background-color: #ee6f00;
        }

        .ui-segment span.option:last-child {
            border-right: none;
        }

        .segment-select {
            display: none;
        }

        body {
            margin-top: -20px;
        }

        .stattext {
            font-size: 16px;
            text-align: left;
            font-weight: 300;
            line-height: 19px;
        }

        @media screen and (min-width:768px) {
            .mobilepr {
            display:none;
            }
        }
        
        @media screen and (max-width:767px) {
            .desktpr {
            display:none;
            }
        }
        
        @media (min-width: 768px) {
            .modal-dialog {
                width: 760px !important;
            }
        }

        .btn-successpr {
            color: #666666;
            background-color: #ffffff;
            border-color: #ffffff;
            margin-bottom: 10px;
            font-size: 16px;
        }

        .btn-successpr:hover {
            color: #666666;
            background-color: #ffffff;
            border-color: #ffffff;
            margin-bottom: 10px;
            font-size: 16px;
        }

        .btn-successpr:focus {
            color: #666666;
            background-color: #ffffff;
            border-color: #ffffff;
            margin-bottom: 10px;
            font-size: 16px;
        }
    </style>
@stop
{{-- content --}}
@section('content')
    <!--get the subscription packages depending on the user's country -->
    <?php
    /*
     * This is an example page of the form fields required for a PayGate PayWeb 3 transaction.
     */

    /*
     * Sessions used here only because we can't get the PayGate ID, Transaction reference and secret key on the result page.
     *
     * First input so we make sure there is nothing in the session.

     */
    //echo $_SERVER['SERVER_NAME'];

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

    $userCountryCode = 'USA';//just for now
    //Amount depending on the country and currency chosen

    $userEMail = 'dev14@stafflife.com';

    $locale = 'en-za';

    ?>
    <?php
    //Get standard package details
    $countryPricesRow;
    $currencySymbol;
    foreach ($countryPrices as $singleCountryPrices) {
        if ($singleCountryPrices->country_code == $userCountryCode) {
            //echo "subscription is supported in this country";
            //echo $singleCountryPrices->std_price;
            $countryPricesRow = $singleCountryPrices;
            //get currency symbol
            foreach ($currencyInfo as $singlecurrencyInfo) {
                if ($singlecurrencyInfo->code == $countryPricesRow->currency_code) {
                    $currencySymbol = $singlecurrencyInfo->symbol;
                }
            }
        } else {
            //echo "sorry, subscription is not supported in your country";
        }
    }
    $sysmbol2 = '$';
    $currencySymbol = '$';
    ?>
    <div class="font-open-sans">
        <!-- Notifications -->
        @include('notifications')


        <div class="jumbotext text-center">
            <h1>Pricing</h1>
        </div>

        
        <!-- Pricing Tables Section Start -->

        <div class="container">
            <h3 style="text-align:center; padding-bottom:10px;font-size:28px;color:#4caf50;" class="homeheadingb martop">Pricing to suit your business.
                From a home office to the largest corporations.
            </h3>
            <p class="faqtextbig text-center" style="padding-bottom:20px;">Simple packages - no hidden fees, contracts or setup
            </p>
            <div class="row">
                <!-- Accordions Start -->
            </div>
            <div class="row">
                <div class="text-center wow" data-wow-duration="3s">
                    <div class="form-group">
                        <div class="form-group">
                            <select class="segment-select">
                                <option value="yearly">Annual</option>
                                <option value="monthly">Monthly</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <div class="table-responsive">
                        <div class="dskscrn">

                            <!-- Table header Starts -->

                            <table class="table table-bordered">
                                <thead>
                                <tr class="bg-default">
                                    <th width="20%">
                                        <h4>{{ __('pricing.standard') }}</h4>
                                    </th>
                                    <th width="20%">
                                        <h4>{{ __('pricing.professional') }} </h4>
                                    </th>
                                    <th width="20%">
                                        <h4>{{ __('pricing.business') }} </h4>
                                    </th>
                                    <th width="20%">
                                        <h4>{{ __('pricing.enterprise') }} </h4>
                                    </th>
                                    <th width="20%">
                                        <h4>{{ __('pricing.elite') }} </h4>
                                    </th>
                                </tr>
                                </thead>

                                <!-- price section start -->

                                <tbody>
                                    <tr>
                                        <td style="border-bottom: 1px solid#dddddd !important; padding-bottom: 30px;">
                                            <!--<del class="text-danger">$1150</del>-->
                                            <br />
                                            <div id="price1" class="box_round_symboll price1">
                                                <?php echo $currencySymbol; ?><?php echo $packages[0]->price; ?>
                                            </div>
                                            <div class="yearly-data">
                                                <p>Per month billed annually <br/><span class="pricegreen">Save <?php echo $packages[0]->percentage_save; ?>%</span></p>
                                                <p><?php echo $currencySymbol; ?><?php echo $packages[0]->monthly_price; ?> billed monthly</p>
                                            </div>
                                            <div class="monthly-data" style="display:none">
                                                <p class="">billed monthly</p>
                                                <p><!--<?php echo $currencySymbol; ?><?php echo $packages[0]->price; ?> Per month billed yearly-->Annual Membership - <span class="pricegreen">Save <?php echo $packages[0]->percentage_save; ?>%</span></p>
                                            </div>
                                        </td>
                                    

                                        <td style="border-bottom: 1px solid#dddddd !important; padding-bottom: 30px;">
                                            <br />
                                            <div id="price2" class="box_round_symboll price2">
                                                <?php echo $currencySymbol; ?><?php echo $packages[1]->price; ?>
                                            </div>
                                            <div class="yearly-data">
                                                <p>Per month billed annually <span class="pricegreen">Save <?php echo $packages[1]->percentage_save; ?>%</span></p>
                                                <p><?php echo $currencySymbol; ?><?php echo $packages[1]->monthly_price; ?> billed monthly</p>
                                            </div>
                                            <div class="monthly-data" style="display:none">
                                                <p class="">billed monthly</p>
                                                <p><!--<?php echo $currencySymbol; ?><?php echo $packages[1]->price; ?> Per month billed yearly-->Annual Membership - <span class="pricegreen">Save <?php echo $packages[1]->percentage_save; ?>%</span></p>
                                            </div>
                                        </td>
                                    
                                    
                                        <td style="border-bottom: 1px solid#dddddd !important; padding-bottom: 30px;">
                                            <br />
                                            <div id="price3" class="box_round_symboll price3">
                                                <?php echo $currencySymbol; ?><?php echo $packages[2]->price; ?>
                                            </div>
                                            <div class="yearly-data">
                                                <p>Per month billed annually <span class="pricegreen">Save <?php echo $packages[2]->percentage_save; ?>%</span></p>
                                                <p><?php echo $currencySymbol; ?><?php echo $packages[2]->monthly_price; ?> billed monthly</p>
                                            </div>
                                            <div class="monthly-data" style="display:none">
                                                <p class="">billed monthly</p>
                                                <p><!--<?php echo $currencySymbol; ?><?php echo $packages[2]->price; ?> Per month billed yearly-->Annual Membership -  <span class="pricegreen">Save <?php echo $packages[2]->percentage_save; ?>%</span></p>
                                            </div>
                                        </td>
                                    
                                    
                                        <td style="border-bottom: 1px solid#dddddd !important; padding-bottom: 30px;">
                                            <br /> 
                                            <div id="price4" class="box_round_symboll price4">
                                                <?php echo $currencySymbol; ?><?php echo $packages[3]->price; ?>
                                            </div>
                                            <div class="yearly-data">
                                                <p>Per month billed annually <span class="pricegreen">Save <?php echo $packages[3]->percentage_save; ?>%</span></p>
                                                <p><?php echo $currencySymbol; ?><?php echo $packages[3]->monthly_price; ?> billed monthly</p>
                                            </div>
                                            <div class="monthly-data" style="display:none">
                                                <p class="">billed monthly</p>
                                                <p><!--<?php echo $currencySymbol; ?><?php echo $packages[3]->price; ?> Per month billed yearly-->Annual Membership -  <span class="pricegreen">Save <?php echo $packages[3]->percentage_save; ?>%</span></p>
                                            </div>
                                        </td>
                                        
                                        
                                        <td style="border-bottom: 1px solid#dddddd !important; padding-bottom: 30px;">
                                            <br /> 
                                            <div id="price5" class="box_round_symboll price5">
                                                <?php echo $currencySymbol; ?><?php echo $packages[4]->price; ?>
                                            </div>
                                            <div class="yearly-data">
                                                <p>Per month billed annually <span class="pricegreen">Save <?php echo $packages[4]->percentage_save; ?>%</span></p>
                                                <p><?php echo $currencySymbol; ?><?php echo $packages[4]->monthly_price; ?> billed monthly</p>
                                            </div>
                                            <div class="monthly-data" style="display:none">
                                                <p class="">billed monthly</p>
                                                <p><!--<?php echo $currencySymbol; ?><?php echo $packages[4]->price; ?> Per month billed yearly-->Annual Membership -  <span class="pricegreen">Save <?php echo $packages[4]->percentage_save; ?>%</span></p>
                                            </div>
                                        </td>
                                    </tr>
                                
    <!-- //price section end -->

    <!-- rating section start -->
                    
                                    <tr>
                                    <td style="padding-top:20px;">
                                        <img src="{{ asset('assets/images/tick-mark-grn.png') }}" class="tickimage">
                                        <p data-toggle="tooltip" class="orange-tooltip pleft" data-placement="top"
                                        title="Each time a Consent form (SLIP) is drawn, a unit is charged. The SLIP entitles you to view an applicant's history and to submit employee data."><?php echo $packages[0]->terms_forms; ?>
                                            employees</p>
                                        </td>
                                    
                                    
                                        <td style="padding-top:20px;">
                                        <!-- <td> -->
                                        <img src="{{ asset('assets/images/tick-mark-grn.png') }}" class="tickimage">
                                        <p data-toggle="tooltip" class="orange-tooltip pleft" data-placement="top"
                                        title="Each time a Consent form (SLIP) is drawn, a unit is charged. The SLIP entitles you to view an applicant's history and to submit employee data."><?php echo $packages[1]->terms_forms; ?>
                                            employees</p>
                                        </td>
                                    
                                    
                                        <td style="padding-top:20px;">
                                        <!-- <td> -->
                                        <img src="{{ asset('assets/images/tick-mark-grn.png') }}" class="tickimage">
                                        <p data-toggle="tooltip" class="orange-tooltip pleft" data-placement="top"
                                        title="Each time a Consent form (SLIP) is drawn, a unit is charged. The SLIP entitles you to view an applicant's history and to submit employee data."><?php echo $packages[2]->terms_forms; ?>
                                            employees</p>
                                        </td>
                                    
                                    
                                        <td style="padding-top:20px;">
                                        <!-- <td> -->
                                        <img src="{{ asset('assets/images/tick-mark-grn.png') }}" class="tickimage">
                                        <p data-toggle="tooltip" class="orange-tooltip pleft" data-placement="top"
                                        title="Each time a Consent form (SLIP) is drawn, a unit is charged. The SLIP entitles you to view an applicant's history and to submit employee data."><?php echo $packages[3]->terms_forms; ?>
                                            employees</p>
                                        </td>
                                    
                                    
                                        <td style="padding-top:20px;">
                                        <!-- <td> -->
                                        <img src="{{ asset('assets/images/tick-mark-grn.png') }}" class="tickimage">
                                        <p data-toggle="tooltip" class="orange-tooltip pleft" data-placement="top"
                                        title="Each time a Consent form (SLIP) is drawn, a unit is charged. The SLIP entitles you to view an applicant's history and to submit employee data."><?php echo $packages[4]->terms_forms; ?>
                                            employees</p>
                                        </td>
                                    </tr>
                    
    <!-- //rating section end -->

    <!-- HR Users section end -->                  
                    
                                    <tr>
                                        <td>
                                        <img src="{{ asset('assets/images/tick-mark-grn.png') }}" class="tickimage">
                                        <p data-toggle="tooltip" class="orange-tooltip pleft" data-placement="top"
                                        title="Admin users add employees to the StaffLife system, view and submit data. Typically it is your HR manager/s."><?php echo $packages[0]->admins; ?>
                                            admin user</p>
                                        </td>
                                    
                                    
                                        <td>
                                        <img src="{{ asset('assets/images/tick-mark-grn.png') }}" class="tickimage">
                                        <p data-toggle="tooltip" class="orange-tooltip pleft" data-placement="top"
                                        title="Admin users add employees to the StaffLife system, view and submit data. Typically it is your HR manager/s."><?php echo $packages[1]->admins; ?>
                                            admin users</p>
                                        </td>
                                    
                                    
                                        <td>
                                        <img src="{{ asset('assets/images/tick-mark-grn.png') }}" class="tickimage">
                                        <p data-toggle="tooltip" class="orange-tooltip pleft" data-placement="top"
                                        title="Admin users add employees to the StaffLife system, view and submit data. Typically it is your HR manager/s."><?php echo $packages[2]->admins; ?>
                                            admin users</p>
                                        </td>
                                    
                                    
                                        <td>
                                        <img src="{{ asset('assets/images/tick-mark-grn.png') }}" class="tickimage">
                                        <p  data-toggle="tooltip" class="orange-tooltip pleft" data-placement="top"
                                        title="Admin users add employees to the StaffLife system, view and submit data. Typically it is your HR manager/s."><?php echo $packages[3]->admins; ?>
                                            admin users</p>
                                        </td>
                                    
                                    
                                        <td>
                                        <img src="{{ asset('assets/images/tick-mark-grn.png') }}" class="tickimage">
                                        <p data-toggle="tooltip" class="orange-tooltip pleft" data-placement="top"
                                        title="Admin users add employees to the StaffLife system, view and submit data. Typically it is your HR manager/s."><?php echo $packages[4]->admins; ?>
                                            admin users (additional at $25/user)</p>
                                        </td>
                                    </tr>


                                    <!-- Support section Start -->
                    
                                    <tr>
                                        <td>
                                        <img src="{{ asset('assets/images/tick-mark-grn.png') }}" class="tickimage">
                                        <p class="pleft"><?php echo $packages[0]->support; ?> support</p>
                                        </td>
                                    
                                    
                                        <td>
                                        <img src="{{ asset('assets/images/tick-mark-grn.png') }}" class="tickimage">
                                        <p class="pleft"><?php echo $packages[1]->support; ?> support</p>
                                        </td>
                                    
                                    
                                        <td>
                                        <img src="{{ asset('assets/images/tick-mark-grn.png') }}" class="tickimage">
                                        <p class="pleft"><?php echo $packages[2]->support; ?> support</p>
                                        </td>
                                    
                                    
                                        <td>
                                        <img src="{{ asset('assets/images/tick-mark-grn.png') }}" class="tickimage">
                                        <p class="pleft"><?php echo $packages[3]->support; ?> support</p>
                                        </td>
                                    
                                    
                                        <td>
                                        <img src="{{ asset('assets/images/tick-mark-grn.png') }}" class="tickimage">
                                        <p class="pleft"><?php echo $packages[4]->support; ?> support</p>
                                        </td>
                                    </tr>
                                
    <!-- Support section end -->

                                    <tr>
                                        <td>
                                            
                                        </td>
                                    
                                    
                                        <td>
                                            
                                        </td>
                                    
                                    
                                        <td>
                                        <img src="{{ asset('assets/images/tick-mark-grn.png') }}" class="tickimage">
                                        <p class="pleft"><?php echo $packages[2]->account_manager; ?>
                                            (<?php echo $packages[2]->hours_limit; ?>)</p>
                                        </td>
                                    
                                    
                                        <td>
                                        <img src="{{ asset('assets/images/tick-mark-grn.png') }}" class="tickimage">
                                        <p class="pleft"><?php echo $packages[3]->account_manager; ?>
                                            (<?php echo $packages[3]->hours_limit; ?>)</p>
                                        </td>
                                    
                                    
                                        <td>
                                        <img src="{{ asset('assets/images/tick-mark-grn.png') }}" class="tickimage">
                                        <p class="pleft"><?php echo $packages[4]->account_manager; ?>
                                            (<?php echo $packages[4]->hours_limit; ?>)</p>
                                        </td>
                                    </tr>
                                
    <!-- add cart section start -->
                    
                                    <tr>
                                        <td style="padding-bottom:20px;">
                                            <a type="button" class="btn btn-successpr btn-lg" data-toggle="modal" data-target="#myModal"><span class="glyphicon">&#xe086;</span>&nbsp;&nbsp;Our guarantee
                                            </a>
                                            <a class="btn price-btn link1 prcbutton" id="link1" href="{{ route('/business/subscribe', [session('custom_lang'),'package' => 'standard', 'yearly' => 'yearly']) }}"> {{ __('button.subscribe') }}</a>
                                        </td>
                                        
                                        
                                        <td style="padding-bottom:20px;">
                                            <a type="button" class="btn btn-successpr btn-lg" data-toggle="modal" data-target="#myModal"><span class="glyphicon">&#xe086;</span>&nbsp;&nbsp;Our guarantee
                                            </a>
                                            <a class="btn price-btn link2 prcbutton" id="link2" href="{{ route('/business/subscribe', [session('custom_lang'),'package' => 'professional', 'yearly' => 'yearly']) }}"> {{ __('button.subscribe') }}</a>
                                        </td>
                                    
                                    
                                        <td style="padding-bottom:20px;">
                                            <a type="button" class="btn btn-successpr btn-lg" data-toggle="modal" data-target="#myModal"><span class="glyphicon">&#xe086;</span>&nbsp;&nbsp;Our guarantee
                                            </a>
                                            <a class="btn price-btn link3 prcbutton" id="link3" href="{{ route('/business/subscribe', [session('custom_lang'),'package' => 'business', 'yearly' => 'yearly']) }}"> {{ __('button.subscribe') }}</a>
                                        </td>
                                    
                                    
                                        <td style="padding-bottom:20px;">
                                            <a type="button" class="btn btn-successpr btn-lg" data-toggle="modal" data-target="#myModal"><span class="glyphicon">&#xe086;</span>&nbsp;&nbsp;Our guarantee
                                            </a>
                                            <a class="btn price-btn link4 prcbutton" id="link4" href="{{ route('/business/subscribe', [session('custom_lang'),'package' => 'enterprise', 'yearly' => 'yearly']) }}"> {{ __('button.subscribe') }}</a>
                                        </td>
                                    
                                    
                                        <td style="padding-bottom:20px;">
                                            <a type="button" class="btn btn-successpr btn-lg" data-toggle="modal" data-target="#myModal"><span class="glyphicon">&#xe086;</span>&nbsp;&nbsp;Our guarantee
                                            </a>
                                            <a class="btn price-btn link5 prcbutton" id="link5" href="{{ route('/business/subscribe', [session('custom_lang'),'package' => 'elite', 'yearly' => 'yearly']) }}"> {{ __('button.subscribe') }}</a>
                                        </td>
                                    </tr>
                                
    <!-- //add cart section end -->
                
                                </tbody>
                            </table>
                        </div>

                        <!-- Mobile Screen Section Starts -->


                        <div class="mobscrn">
                            <table class="table table-bordered ">
                                <thead>
                                <tr class="bg-default">
                                    <th width="100%">
                                        <h4>{{ __('pricing.standard') }}</h4>
                                    </th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td>
                                        <br/>
                                        <div id="price1" class="box_round_symboll price1">
                                            <?php echo $currencySymbol; ?><?php echo $packages[0]->price; ?>
                                        </div>

                                        <div class="yearly-data">
                                            <p>Per month billed annually <span
                                                        class="pricegreen">Save <?php echo $packages[0]->percentage_save; ?>
                                                    %</span></p>
                                            <p><?php echo $currencySymbol; ?><?php echo $packages[0]->monthly_price; ?>
                                                billed monthly</p>
                                        </div>

                                        <div class="monthly-data" style="display:none">
                                            <p class="">billed monthly</p>
                                            <p><!--<?php echo $currencySymbol; ?><?php echo $packages[0]->price; ?> Per month
                                                billed yearly-->Annual Membership - <span
                                                        class="pricegreen">Save <?php echo $packages[0]->percentage_save; ?>
                                                    %</span></p>
                                        </div>
                                        <div style="display:inline-block;">
                                        <img src="{{ asset('assets/images/tick-mark-grn.png') }}" class="tickimage">
                                        <p data-toggle="tooltip" class="orange-tooltip pleft" data-placement="top"
                                        title="Each time a Consent form (SLIP) is drawn, a unit is charged. The SLIP entitles you to view an applicant's history and to submit employee data."><?php echo $packages[0]->terms_forms; ?>
                                            employees</p>
                                        
                                        <img src="{{ asset('assets/images/tick-mark-grn.png') }}" class="tickimage">
                                        <p class="pleft"><?php echo $packages[0]->support; ?> support</p>

                                        <img src="{{ asset('assets/images/tick-mark-grn.png') }}" class="tickimage">
                                        <p data-toggle="tooltip" class="orange-tooltip pleft" data-placement="top"
                                        title="Admin users add employees to the StaffLife system, view and submit data. Typically it is your HR manager/s."><?php echo $packages[0]->admins; ?>
                                            admin users</p></div>

                                        <br/><br/>

                                            <a type="button" class="btn btn-successpr btn-lg" data-toggle="modal" data-target="#myModal"><span class="glyphicon">&#xe086;</span>&nbsp;&nbsp;Our guarantee
                                            </a><br/>
                                        <a class="btn price-btn link1 prcbutton" id="link1"
                                        href="{{ route('/business/subscribe', [session('custom_lang'),'package' => 'standard', 'yearly' => 'yearly']) }}"> {{ __('button.subscribe') }}</a>
                                        <!-- end1 -->

                                    </td>
                                </tr>
                                </tbody>
                            </table>


                            <table class="table table-bordered ">
                                <thead>
                                <tr class="bg-default">
                                    <th width="100%">
                                        <h4>{{ __('pricing.professional') }} </h4>
                                    </th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td>
                                        <br/>
                                        <div id="price2" class="box_round_symboll price2">
                                            <?php echo $currencySymbol; ?><?php echo $packages[1]->price; ?>
                                        </div>

                                        <div class="yearly-data">
                                            <p>Per month billed annually <span
                                                        class="pricegreen">Save <?php echo $packages[1]->percentage_save; ?>
                                                    %</span></p>
                                            <p><?php echo $currencySymbol; ?><?php echo $packages[1]->monthly_price; ?>
                                                billed monthly</p>
                                        </div>

                                        <div class="monthly-data" style="display:none">
                                            <p class="">billed monthly</p>
                                            <p><!--<?php echo $currencySymbol; ?><?php echo $packages[1]->price; ?> Per month
                                                billed yearly-->Annual Membership -  <span
                                                        class="pricegreen">Save <?php echo $packages[1]->percentage_save; ?>
                                                    %</span></p>
                                        </div>
                                        <div style="display:inline-block;">
                                        <img src="{{ asset('assets/images/tick-mark-grn.png') }}" class="tickimage">
                                        <p data-toggle="tooltip" class="orange-tooltip pleft" data-placement="top"
                                        title="Each time a Consent form (SLIP) is drawn, a unit is charged. The SLIP entitles you to view an applicant's history and to submit employee data."><?php echo $packages[1]->terms_forms; ?>
                                            employees</p>

                                        <img src="{{ asset('assets/images/tick-mark-grn.png') }}" class="tickimage">
                                        <p class="pleft"><?php echo $packages[1]->support; ?> support</p>

                                        <img src="{{ asset('assets/images/tick-mark-grn.png') }}" class="tickimage">
                                        <p data-toggle="tooltip" class="orange-tooltip pleft" data-placement="top"
                                        title="Admin users add employees to the StaffLife system, view and submit data. Typically it is your HR manager/s."><?php echo $packages[1]->admins; ?>
                                            admin users</p></div>

                                        <br/><br/>

                                            <a type="button" class="btn btn-successpr btn-lg" data-toggle="modal" data-target="#myModal"><span class="glyphicon">&#xe086;</span>&nbsp;&nbsp;Our guarantee
                                            </a><br/>
                                        <a class="btn price-btn link2 prcbutton" id="link2"
                                        href="{{ route('/business/subscribe', [session('custom_lang'),'package' => 'professional', 'yearly' => 'yearly']) }}"> {{ __('button.subscribe') }}</a>


                                        <!-- end2 -->

                                    </td>
                                </tr>
                                </tbody>
                            </table>


                            <table class="table table-bordered ">
                                <thead>
                                <tr class="bg-default">
                                    <th width="100%">
                                        <h4>{{ __('pricing.business') }} </h4>
                                    </th>
                                </tr>
                                </thead>


                                <tbody>
                                    <tr>
                                        <td>
                                            <br />
                                            <div id="price3" class="box_round_symboll price3">
                                                <?php echo $currencySymbol; ?><?php echo $packages[2]->price; ?>
                                            </div>
                                        
                                            <div class="yearly-data">
                                                <p>Per month billed annually <span class="pricegreen">Save <?php echo $packages[2]->percentage_save; ?>%</span></p>
                                                <p><?php echo $currencySymbol; ?><?php echo $packages[2]->monthly_price; ?> billed monthly</p>
                                            </div>
                                            
                                            <div class="monthly-data" style="display:none">
                                                <p class="">billed monthly</p>
                                                <p><!--<?php echo $currencySymbol; ?><?php echo $packages[2]->price; ?> Per month billed yearly-->Annual Membership -  <span class="pricegreen">Save <?php echo $packages[2]->percentage_save; ?>%</span></p>
                                            </div>
                                        <div style="display:inline-block;"> 
                                        <img src="{{ asset('assets/images/tick-mark-grn.png') }}" class="tickimage">
                                        <p data-toggle="tooltip" class="orange-tooltip pleft" data-placement="top"
                                        title="Each time a Consent form (SLIP) is drawn, a unit is charged. The SLIP entitles you to view an applicant's history and to submit employee data."> <?php echo $packages[2]->terms_forms; ?>
                                            employees</p>
                            
                                        <img src="{{ asset('assets/images/tick-mark-grn.png') }}" class="tickimage">
                                        <p class="pleft"><?php echo $packages[2]->support; ?> support</p>
                            
                                        <img src="{{ asset('assets/images/tick-mark-grn.png') }}" class="tickimage">
                                        <p data-toggle="tooltip" class="orange-tooltip pleft" data-placement="top"
                                        title="Admin users add employees to the StaffLife system, view and submit data. Typically it is your HR manager/s."><?php echo $packages[2]->admins; ?>
                                            admin users</p>

                                        <img src="{{ asset('assets/images/tick-mark-grn.png') }}" class="tickimage">
                                        <p data-toggle="tooltip" class="orange-tooltip pleft"
                                        data-placement="top"><?php echo $packages[2]->account_manager; ?>
                                            (<?php echo $packages[2]->hours_limit; ?>)</p></div>
                                        
                                            <br/><br/>
                                        
                                            <a type="button" class="btn btn-successpr btn-lg" data-toggle="modal" data-target="#myModal"><span class="glyphicon">&#xe086;</span>&nbsp;&nbsp;Our guarantee
                                            </a><br/>
                                            <a class="btn price-btn link3 prcbutton" id="link3" href="{{ route('/business/subscribe', [session('custom_lang'),'package' => 'business', 'yearly' => 'yearly']) }}"> {{ __('button.subscribe') }}</a>
                                        

    <!-- end3 -->

                                        </td>
                                    </tr>
                                </tbody>
                            </table>


                            <table class="table table-bordered ">
                                <thead>
                                <tr class="bg-default">
                                    <th width="100%">
                                        <h4>{{ __('pricing.enterprise') }} </h4>
                                    </th>
                                </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            <br /> 
                                            <div id="price4" class="box_round_symboll price4">
                                                <?php echo $currencySymbol; ?><?php echo $packages[3]->price; ?>
                                            </div>
                                        
                                            <div class="yearly-data">
                                                <p>Per month billed annually <span class="pricegreen">Save <?php echo $packages[3]->percentage_save; ?>%</span></p>
                                                <p><?php echo $currencySymbol; ?><?php echo $packages[3]->monthly_price; ?> billed monthly</p>
                                            </div>
                                            
                                            <div class="monthly-data" style="display:none">
                                                <p class="">billed monthly</p>
                                                <p><!--<?php echo $currencySymbol; ?><?php echo $packages[3]->price; ?> Per month billed yearly-->Annual Membership -  <span class="pricegreen">Save <?php echo $packages[3]->percentage_save; ?>%</span>)</p>
                                            </div>
                                        <div style="display:inline-block;">
                                        <img src="{{ asset('assets/images/tick-mark-grn.png') }}" class="tickimage">
                                        <p data-toggle="tooltip" class="orange-tooltip pleft" data-placement="top"
                                        title="Each time a Consent form (SLIP) is drawn, a unit is charged. The SLIP entitles you to view an applicant's history and to submit employee data."><?php echo $packages[3]->terms_forms; ?>
                                            employees</p>
                                        
                                        <img src="{{ asset('assets/images/tick-mark-grn.png') }}" class="tickimage">
                                        <p class="pleft"><?php echo $packages[3]->support; ?> support</p>
                                        
                                        <img src="{{ asset('assets/images/tick-mark-grn.png') }}" class="tickimage">
                                        <p data-toggle="tooltip" class="orange-tooltip pleft" data-placement="top"
                                        title="Admin users add employees to the StaffLife system, view and submit data. Typically it is your HR manager/s.">
                                            Up to <?php echo $packages[3]->admins; ?> admin users</p>

                                        <img src="{{ asset('assets/images/tick-mark-grn.png') }}" class="tickimage">
                                        <p data-toggle="tooltip" class="orange-tooltip pleft"
                                        data-placement="top"><?php echo $packages[3]->account_manager; ?>
                                            (<?php echo $packages[3]->hours_limit; ?>)</p></div>
                                        
                                            <br/><br/>
                                            <a type="button" class="btn btn-successpr btn-lg" data-toggle="modal" data-target="#myModal"><span class="glyphicon">&#xe086;</span>&nbsp;&nbsp;Our guarantee
                                            </a><br/>
                                            <a class="btn price-btn link4 prcbutton" id="link4" href="{{ route('/business/subscribe', [session('custom_lang'),'package' => 'enterprise', 'yearly' => 'yearly']) }}"> {{ __('button.subscribe') }}</a>
    <!-- end4 -->
                                        </td>       
                                    </tr>
                                </tbody>
                            </table>


                            <table class="table table-bordered ">
                                <thead>
                                <tr class="bg-default">
                                    <th width="100%">
                                        <h4>{{ __('pricing.elite') }} </h4>
                                    </th>
                                </tr>
                                </thead>

                                <tbody>
                                <tr>
                                    <td>
                                        <br /> 
                                            <div id="price5" class="box_round_symboll price5">
                                                <?php echo $currencySymbol; ?><?php echo $packages[4]->price; ?>
                                            </div>
                            
                                            <div class="yearly-data">
                                                <p>Per month billed annually <span class="pricegreen">Save <?php echo $packages[4]->percentage_save; ?>%</span></p>
                                                <p><?php echo $currencySymbol; ?><?php echo $packages[4]->monthly_price; ?> billed monthly</p>
                                            </div>
                            
                                            <div class="monthly-data" style="display:none">
                                                <p class="">billed monthly</p>
                                                <p><!--<?php echo $currencySymbol; ?><?php echo $packages[4]->price; ?> Per month billed yearly-->Annual Membership -  <span class="pricegreen">Save <?php echo $packages[4]->percentage_save; ?>%</span></p>
                                            </div>
                                        <div style="display:inline-block;">
                                        <img src="{{ asset('assets/images/tick-mark-grn.png') }}" class="tickimage">
                                        <p data-toggle="tooltip" class="orange-tooltip pleft" data-placement="top"
                                        title="Each time a Consent form (SLIP) is drawn, a unit is charged. The SLIP entitles you to view an applicant's history and to submit employee data."><?php echo $packages[4]->terms_forms; ?>
                                            employees</p>
                                        
                                        <img src="{{ asset('assets/images/tick-mark-grn.png') }}" class="tickimage">
                                        <p class="pleft"><?php echo $packages[4]->support; ?> support</p>
                                        
                                        <img src="{{ asset('assets/images/tick-mark-grn.png') }}" class="tickimage">
                                        <p data-toggle="tooltip" class="orange-tooltip pleft" data-placement="top"
                                        title="Admin users add employees to the StaffLife system, view and submit data. Typically it is your HR manager/s."><?php echo $packages[4]->admins; ?>
                                            admin users (additional at $25 per user)</p>

                                        <img src="{{ asset('assets/images/tick-mark-grn.png') }}" class="tickimage">
                                        <p data-toggle="tooltip" class="orange-tooltip pleft"
                                        data-placement="top"><?php echo $packages[4]->account_manager; ?>
                                            (<?php echo $packages[4]->hours_limit; ?>)</p></div>
                                        
                                            <br/><br/>
                                        
                                            <a type="button" class="btn btn-successpr btn-lg" data-toggle="modal" data-target="#myModal"><span class="glyphicon">&#xe086;</span>&nbsp;&nbsp;Our guarantee
                                            </a><br/>
                                            <a class="btn price-btn link5 prcbutton" id="link5" href="{{ route('/business/subscribe', [session('custom_lang'),'package' => 'elite', 'yearly' => 'yearly']) }}"> {{ __('button.subscribe') }}</a>
    <!-- end5 -->
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="text-center">
                <a class="btn success" href="{{ route(session('nav_section').'.contacts', session('custom_lang')) }}" style="margin-top:20px; margin-bottom:10px; background-color: #ee6f00 !important;padding:12px 35px;">I have a question</a>
            </div>
        </div>
    <div style="height:30px;"></div>

    <!-- Modal -->
    <div class="modal fade" id="myModal" role="dialog">
        <div class="modal-dialog">
    
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header" style="background-color:#f0f0f0; border-radius:10px;">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h3 style="text-align:center;" class="homeheading">Guarantee Policy</h3>
                </div>
                <div class="modal-body">

                    <div class="mobilepr">
                    <h4 style="padding-bottom:10px;" class="homeheadingb">Subject to the following terms and conditions, StaffLife will reimburse any Member triple of all paid fees to SL, up to USD35 000.</h4>
                            
                                    <p>The claim must reach StaffLife in writing (email or via the SL dashboard), between month 6 and 7 after the initial payment made to StaffLife. </p>
                                    <p>The Member is required to setup at least 25% of employees (active) permitted within their Package (on average over the six month period). </p>
                                    <p>Members who claim will no longer be able to participate in any way within the StaffLife system. This is to prevent Members who benefit from StaffLife but abuse our Guarantee Policy. </p>
                                    <p>Members who have claimed from StaffLife and attempt to join again using an alias or a different company, will be reported to the local authorities for fraud, and liable for repayment of the full reimbursement received, with interest and adjusted for inflation. </p>
                                    <p>Members who are found to abuse the Guarantee Policy, by creating fictitious documentation or accounts, will not be reimbursed and will be reported to the local authorities for fraud.</p>
                                    <p>StaffLife reserves the right to ban any Member from the StaffLife system, without notice. </p>
                                    <p>No reimbursement shall exceed USD35 000. </p>
                                    <p>Processing of claims may take up to 30 days from the date upon which the claim reaches StaffLife. </p>
                                    <div style="height:10px;"></div>
                    </div>

                    <div class="desktpr">
                        <h4 style="padding-bottom:10px;" class="homeheadingb">Subject to the following terms and conditions, StaffLife will reimburse any Member triple of all paid fees to SL, up to USD35 000.</h4>
                            
                                    <p>The claim must reach StaffLife in writing (email or via the SL dashboard), between month 6 and 7 after the initial payment made to StaffLife. </p>
                                    <p>The Member is required to setup at least 25% of employees (active) permitted within their Package (on average over the six month period). </p>
                                    <p>Members who claim will no longer be able to participate in any way within the StaffLife system. This is to prevent Members who benefit from StaffLife but abuse our Guarantee Policy. </p>
                                    <p>Members who have claimed from StaffLife and attempt to join again using an alias or a different company, will be reported to the local authorities for fraud, and liable for repayment of the full reimbursement received, with interest and adjusted for inflation. </p>
                                    <p>Members who are found to abuse the Guarantee Policy, by creating fictitious documentation or accounts, will not be reimbursed and will be reported to the local authorities for fraud.</p>
                                    <p>StaffLife reserves the right to ban any Member from the StaffLife system, without notice. </p>
                                    <p>No reimbursement shall exceed USD35 000. </p>
                                    <p>Processing of claims may take up to 30 days from the date upon which the claim reaches StaffLife. </p>
                                    <div style="height:10px;"></div>
                    </div>
        
                
                </div>
                <div class="modal-footer" style="background-color:#f0f0f0; border-radius:10px;">
                    <p style="text-align:center;">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>

    <!-- //Container End -->
@stop
{{-- footer scripts --}}
@section('footer_scripts')
    <!-- page level js starts-->
    <script type="text/javascript" src="{{ asset('assets/js/frontend/jquery.circliful.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/vendors/wow/js/wow.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/frontend/index.js') }}"></script>
    <!--page level js ends-->
    <!--for the radio button-->
    <script language="javascript" type="text/javascript"
            src="{{ asset('assets/vendors/iCheck/js/icheck.js') }}"></script>
    <script language="javascript" type="text/javascript"
            src="{{ asset('assets/vendors/bootstrap-switch/js/bootstrap-switch.js') }}"></script>
    <script language="javascript" type="text/javascript"
            src="{{ asset('assets/vendors/bootstrap-maxlength/js/bootstrap-maxlength.js') }}"></script>
    <script language="javascript" type="text/javascript"
            src="{{ asset('assets/vendors/card/lib/js/jquery.card.js') }}"></script>
    <script src="http://www.jqueryscript.net/demo/jQuery-Plugin-To-Create-iOS-Style-Segmented-Controls-Segment-js/segment.js"></script>
    <script>

        $(document).ready(function () {
            $('[data-toggle="tooltip"]').tooltip();
        });

        jQuery( ".prcbutton" ).on("click", function() {
            ga('send', 'event', 'button', 'subscribe', 'Member Subscription');
        });

        var currencySymbol = '<?php echo $currencySymbol; ?>';

        $(document).ready(function () {

            $(".segment-select").Segment();

            var options = {
                monthly: [
                    {price: 25, link: 'link1'},
                    {price: 45, link: 'link2'},
                ],
                yearly: [
                    {price: 300, link: 'link3'},
                    {price: 540, link: 'link4'},
                ]
            }

            function fillContent(interval) {
                var data = options[interval];

                $('.content').each(function (index) {
                    var content = $(this);

                    content.find('.price').text('$' + data[index].price);
                    content.find('.interval').text(interval);
                    content.find('.link').attr('href', data[index].link);
                });
            }

            // initialization

            fillContent("monthly");

            $('.ui-segment').on("click", '.option', function () {
                var interval = $(this).attr('value');

                //alert(interval);

                //fillContent(interval);

                if (interval == "yearly") {
                    //alert(currencySymbol);
                    //This means the package is now yearly
                    //Multiply the prices by 10
                    jQuery(".monthly-data").hide();
                    jQuery(".yearly-data").show();
                    jQuery(".price1").text(currencySymbol + '<?php echo $packages[0]->price; ?>');
                    jQuery(".link1").attr('href', "{{ route('/business/subscribe', [session('custom_lang'),'package' => 'standard', 'yearly' => 'yearly']) }}");
                    jQuery(".price2").text(currencySymbol + '<?php echo $packages[1]->price; ?>');
                    jQuery(".link2").attr('href', "{{ route('/business/subscribe', [session('custom_lang'),'package' => 'professional', 'yearly' => 'yearly']) }}");
                    jQuery(".price3").text(currencySymbol + '<?php echo $packages[2]->price; ?>');
                    jQuery(".link3").attr('href', "{{ route('/business/subscribe', [session('custom_lang'),'package' => 'business', 'yearly' => 'yearly']) }}");
                    jQuery(".price4").text(currencySymbol + '<?php echo $packages[3]->price; ?>');
                    jQuery(".link4").attr('href', "{{ route('/business/subscribe', [session('custom_lang'),'package' => 'enterprise', 'yearly' => 'yearly']) }}");
                    jQuery(".price5").text(currencySymbol + '<?php echo $packages[4]->price; ?>');
                    jQuery(".link5").attr('href', "{{ route('/business/subscribe', [session('custom_lang'),'package' => 'elite', 'yearly' => 'yearly']) }}");
                } else {
                    jQuery(".yearly-data").hide();
                    jQuery(".monthly-data").show();
                    jQuery(".price1").text(currencySymbol + '<?php echo $packages[0]->monthly_price; ?>');
                    jQuery(".link1").attr('href', "{{ route('/business/subscribe', [session('custom_lang'),'package' => 'standard', 'yearly' => 'monthly']) }}");
                    jQuery(".price2").text(currencySymbol + '<?php echo $packages[1]->monthly_price; ?>');
                    jQuery(".link2").attr('href', "{{ route('/business/subscribe', [session('custom_lang'),'package' => 'professional', 'yearly' => 'monthly']) }}");
                    jQuery(".price3").text(currencySymbol + '<?php echo $packages[2]->monthly_price; ?>');
                    jQuery(".link3").attr('href', "{{ route('/business/subscribe', [session('custom_lang'),'package' => 'business', 'yearly' => 'monthly']) }}");
                    jQuery(".price4").text(currencySymbol + '<?php echo $packages[3]->monthly_price; ?>');
                    jQuery(".link4").attr('href', "{{ route('/business/subscribe', [session('custom_lang'),'package' => 'enterprise', 'yearly' => 'monthly']) }}");
                    jQuery(".price5").text(currencySymbol + '<?php echo $packages[4]->monthly_price; ?>');
                    jQuery(".link5").attr('href', "{{ route('/business/subscribe', [session('custom_lang'),'package' => 'elite', 'yearly' => 'monthly']) }}");
                }

            });

        });
    </script>
@stop