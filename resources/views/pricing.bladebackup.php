@extends('layouts/defaultboth')
{{-- Page title --}}
@section('title')
Home
@parent
@stop
{{-- page level styles --}}
@section('header_styles')
<link rel="icon" href="{{ asset('assets/images/favicon.png') }}" type="image/x-icon">
<!--page level css starts-->
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/frontend/tabbular.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/vendors/animate/animate.min.css') }}" />
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/frontend/jquery.circliful.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/vendors/owl_carousel/css/owl.carousel.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/vendors/owl_carousel/css/owl.theme.css') }}">
<!--end of page level css-->
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/frontend/shopping.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/font-awesome.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/frontend/price.css') }}">
<link href="{{ asset('assets/vendors/animate/animate.min.css') }}" rel="stylesheet" type="text/css"/>
<link rel="stylesheet" type="text/css" href="{{ asset('assets/vendors/iCheck/css/all.css') }}"/>
<link rel="stylesheet" type="text/css" href="{{ asset('assets/vendors/iCheck/css/line/line.css') }}"/>
<link rel="stylesheet" type="text/css" href="{{ asset('assets/vendors/bootstrap-switch/css/bootstrap-switch.css') }}"/>
<link rel="stylesheet" type="text/css" href="{{ asset('assets/vendors/switchery/css/switchery.css') }}"/>
<link rel="stylesheet" type="text/css" href="{{ asset('assets/vendors/awesomeBootstrapCheckbox/awesome-bootstrap-checkbox.css') }}"/>
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/pages/formelements.css') }}"/>
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/frontend/indexboth.css') }}">

<style>
   .box_round_symboll{
   font-size: 20px !important; 
   }
   .price-bn-yearly{
   margin-top: 10px;
   background-color: #4caf50;
   width: 100%;
   color:#fff !important;
   font-size: 16px;
   }
   .orange-tooltip + .tooltip > .tooltip-inner {background-color: #4caf50;}
   .ui-segment {
   color: rgb(0, 122, 255);
   border: 1px solid rgb(0, 122, 255);
   border-radius: 4px;
   display: inline-block;
   font-family: 'Lato', Georgia, Serif;
   }
   .ui-segment span.option.active {
   background-color: rgb(0, 122, 255);
   color: white;
   }
   .ui-segment span.option {
   font-size: 13px;
   padding-left: 23px;
   padding-right: 23px;
   height: 25px;
   text-align: center;
   display: inline-block;
   line-height: 25px;
   margin: 0px;
   float: left;
   cursor: pointer;
   border-right: 1px solid rgb(0, 122, 255);
   }
   .ui-segment span.option:last-child {
   border-right: none;
   }
   .segment-select {
   display: none;
   }
</style>
@stop
{{-- breadcrumb --}}
@section('top')
<!--<div class="breadcum">
   <div class="container">
      <ol class="breadcrumb">
         <li>
            <a href="{{ route('home') }}"> <i class="livicon icon3 icon4" data-name="home" data-size="18" data-loop="true" data-c="#3d3d3d" data-hc="#3d3d3d"></i>{{ __('home.home') }}
            </a>
         </li>
         <li class="hidden-xs">
            <i class="livicon icon3" data-name="angle-double-right" data-size="18" data-loop="true" data-c="#4caf50" data-hc="#4caf50"></i>
            <a href="{{ route('blog') }}">{{ __('home.pricing') }}</a>
         </li>
      </ol>
      <div class="pull-right">
         <i class="livicon icon3" data-name="edit" data-size="20" data-loop="true" data-c="#3d3d3d" data-hc="#3d3d3d"></i> {{ __('home.pricing') }}
      </div>
   </div>
</div>-->
@stop
{{-- content --}}
@section('content')
<!--get the subscription packages depedning on the user's country -->
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
   //echo $_SERVER['SERVER_NAME'];
   
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
   $currencySymbol;
   foreach($countryPrices as $singleCountryPrices){
   if($singleCountryPrices->country_code == $userCountryCode){
   //echo "subscription is supported in this country";
   //echo $singleCountryPrices->std_price;
   $countryPricesRow = $singleCountryPrices;
   //get currency symbol
          foreach($currencyInfo as $singlecurrencyInfo){
              if($singlecurrencyInfo->code == $countryPricesRow->currency_code){
                  $currencySymbol = $singlecurrencyInfo->symbol;
              }
          }
   }else{
       //echo "sorry, subscription is not supported in your country";
        }
    }
    $sysmbol2 = '$';
   ?>
<!-- Notifications -->
@include('notifications')
<div class="container">
   <div class="row">
      <!-- Accordions Start -->
      <div class="text-center wow" data-wow-duration="3s">
         <h3 class="border-success"><span class="heading_border bg-success">Pricing to suit your business. From a home office to the largest corporations.</span></h3>
         <label class=" text-center"> Simple plans - no hidden fees, contracts or setup</label>
      </div>
   </div>
   <div class="row">
      <div class="text-center wow" data-wow-duration="3s">
         <div class="form-group">
            <div class="form-group">
               <select class="segment-select">
                  <option value="yearly">Yearly</option>
                  <option value="monthly">Monthly</option>
               </select>
            </div>
         </div>
      </div>
   </div>
   <div class="row">
      <div class="col-sm-12">
         <div class="table-responsive">
            <table class="table table-bordered">
               <thead>
                  <tr class="bg-default">
                     <th>
                        <h4></h4>
                     </th>
                     <th>
                        <h4>{{ __('pricing.standard') }}</h4>
                     </th>
                     <th>
                        <h4>{{ __('pricing.professional') }} </h4>
                     </th>
                     <th>
                        <h4>{{ __('pricing.business') }} </h4>
                     </th>
                     <th>
                        <h4>{{ __('pricing.enterprise') }} </h4>
                     </th>
                     <th>
                        <h4>{{ __('pricing.elite') }} </h4>
                     </th>
                  </tr>
               </thead>
               <tbody>
                  <!-- price section start -->
                  <tr>
                     <td style="vertical-align: middle; text-align: left">
                        <p class="orange-tooltip" data-toggle="tooltip" data-placement="top"  title="This price is different depending on which period you choose.">{{ __('pricing.price') }}</p>
                     </td>
                     <td>
                        <!--<del class="text-danger">$1150</del>-->
                        <br />
                        <div id="price6" class="box_round_symboll">
                           <?php echo $currencySymbol; ?><?php echo $packages[0]->price; ?>
                        </div>
                        <div class="yearly-data">
                        <p>Per user/month billed annually (save <?php echo $packages[0]->percentage_save; ?>%)</p>
                        <hr>
                        <p><?php echo $currencySymbol; ?><?php echo $packages[0]->monthly_price; ?> billed monthly</p>
                        </div>
                        <div class="monthly-data" style="display:none">
                            <p class="">billed monthly</p>
                            <hr>
                            <p><?php echo $currencySymbol; ?><?php echo $packages[0]->price; ?> Per user/month billed yearly (save <?php echo $packages[0]->percentage_save; ?>%)</p>
                        </div>
                     </td>
                     <td>
                        <br />
                        <div id="price2" class="box_round_symboll">
                           <?php echo $currencySymbol; ?><?php echo $packages[1]->price; ?>
                        </div>
                        <div class="yearly-data">
                        <p>Per user/month billed annually (save <?php echo $packages[1]->percentage_save; ?>%)</p>
                        <hr>
                        <p><?php echo $currencySymbol; ?><?php echo $packages[1]->monthly_price; ?> billed monthly</p>
                        </div>
                        <div class="monthly-data" style="display:none">
                            <p class="">billed monthly</p>
                            <hr>
                            <p><?php echo $currencySymbol; ?><?php echo $packages[1]->price; ?> Per user/month billed yearly (save <?php echo $packages[1]->percentage_save; ?>%)</p>
                        </div>
                     </td>
                     <td>
                        <br />
                        <div id="price3" class="box_round_symboll">
                           <?php echo $currencySymbol; ?><?php echo $packages[2]->price; ?>
                        </div>
                        <div class="yearly-data">
                        <p>Per user/month billed annually (save <?php echo $packages[2]->percentage_save; ?>%)</p>
                        <hr>
                        <p><?php echo $currencySymbol; ?><?php echo $packages[2]->monthly_price; ?> billed monthly</p>
                        </div>
                        <div class="monthly-data" style="display:none">
                            <p class="">billed monthly</p>
                            <hr>
                            <p><?php echo $currencySymbol; ?><?php echo $packages[2]->price; ?> Per user/month billed yearly (save <?php echo $packages[2]->percentage_save; ?>%)</p>
                        </div>
                     </td>
                     <td>
                        <br /> 
                        <div id="price4" class="box_round_symboll">
                           <?php echo $currencySymbol; ?><?php echo $packages[3]->price; ?>
                        </div>
                        <div class="yearly-data">
                        <p>Per user/month billed annually (save <?php echo $packages[3]->percentage_save; ?>%)</p>
                        <hr>
                        <p><?php echo $currencySymbol; ?><?php echo $packages[3]->monthly_price; ?> billed monthly</p>
                        </div>
                        <div class="monthly-data" style="display:none">
                            <p class="">billed monthly</p>
                            <hr>
                            <p><?php echo $currencySymbol; ?><?php echo $packages[3]->price; ?> Per user/month billed yearly (save <?php echo $packages[3]->percentage_save; ?>%)</p>
                        </div>
                     </td>
                     <td>
                        <br /> 
                        <div id="price5" class="box_round_symboll">
                           <?php echo $currencySymbol; ?><?php echo $packages[4]->price; ?>
                        </div>
                        <div class="yearly-data">
                        <p>Per user/month billed annually (save <?php echo $packages[4]->percentage_save; ?>%)</p>
                        <hr>
                        <p><?php echo $currencySymbol; ?><?php echo $packages[4]->monthly_price; ?> billed monthly</p>
                        </div>
                        <div class="monthly-data" style="display:none">
                            <p class="">billed monthly</p>
                            <hr>
                            <p><?php echo $currencySymbol; ?><?php echo $packages[4]->monthly_price; ?> Per user/month billed yearly (save <?php echo $packages[4]->percentage_save; ?>%)</p>
                        </div>
                     </td>
                  </tr>
                  <!-- //price section end -->
                  <!-- Availbility section start -->
                  <!--<tr>
                     <td style="vertical-align: middle;">Annual Payment Discount</td>
                     <td><?php //echo $countryPricesRow->std_discount; ?></td>
                     <td><?php //echo $countryPricesRow->bn_discount; ?></td>
                     <td><?php //echo $countryPricesRow->pro_discount; ?></td>
                     <td><?php //echo $countryPricesRow->ent_discount; ?></td>
                     <td><?php //echo $countryPricesRow->el_discount; ?></td>
                     </tr>-->
                  <!-- //Availbility section end -->
                  <!-- rating section start -->
                  <tr>
                     <td style="vertical-align: middle; text-align: left" >
                        <p data-toggle="tooltip" class="orange-tooltip" data-placement="top"  title="This is the number of employees that you can view their data and generate data for.">{{ __('pricing.termforms') }}</p>
                     </td>
                     <td>
                        Up to <?php echo $packages[0]->terms_forms; ?> employees / reports
                     </td>
                     <td>
                        Up to <?php echo $packages[1]->terms_forms; ?> employees / reports
                     </td>
                     <td>
                        Up to <?php echo $packages[2]->terms_forms; ?> employees / reports
                     </td>
                     <td>
                        Up to <?php echo $packages[3]->terms_forms; ?> employees / reports
                     </td>
                     <td>
                        Up to <?php echo $packages[4]->terms_forms; ?> employees / reports
                     </td>
                  </tr>
                  <!-- //rating section end -->
                  <!-- description section start -->
                  <tr>
                     <td style="vertical-align: middle; text-align: left">
                        <p data-toggle="tooltip" class="orange-tooltip" data-placement="top"  title="This is how much it would cost you per employee if you utilize the package fully">{{ __('pricing.costemplyee') }}</p>
                     </td>
                     <td class="description">
                        <?php echo $currencySymbol; ?><?php echo $packages[0]->cost_per_employee; ?>
                     </td>
                     <td class="description">
                        <?php echo $currencySymbol; ?><?php echo $packages[1]->cost_per_employee; ?>
                     </td>
                     <td class="description">
                        <?php echo $currencySymbol; ?><?php echo $packages[2]->cost_per_employee; ?>
                     </td>
                     <td class="description">
                        <?php echo $currencySymbol; ?><?php echo $packages[3]->cost_per_employee; ?>
                     </td>
                     <td class="description">
                        <?php echo $currencySymbol; ?><?php echo $packages[4]->cost_per_employee; ?> (additional at $2 per unit)
                     </td>
                  </tr>
                  <!-- description section end -->
                  <tr>
                     <td style="vertical-align: middle; text-align: left">
                        <p data-toggle="tooltip" class="orange-tooltip" data-placement="top"  title="This is the method of support that you can use to communicate with us with regard to any issue that you may have.">{{ __('pricing.support') }}</p>
                     </td>
                     <td>
                        <?php echo $packages[0]->support; ?>
                     </td>
                     <td>
                        <?php echo $packages[1]->support; ?>
                     </td>
                     <td>
                        <?php echo $packages[2]->support; ?>
                     </td>
                     <td>
                        <?php echo $packages[3]->support; ?>
                     </td>
                     <td>
                        <?php echo $packages[4]->support; ?>
                     </td>
                  </tr>
                  <tr>
                     <td style="vertical-align: middle; text-align: left">
                        <p data-toggle="tooltip" class="orange-tooltip" data-placement="top"  title="This is the number of admins that can be in your account.">{{ __('pricing.users') }}</p>
                     </td>
                      <td>
                        Up to <?php echo $packages[0]->admins; ?> HR users
                     </td>
                     <td>
                        Up to <?php echo $packages[1]->admins; ?> HR users
                     </td>
                     <td>
                        Up to <?php echo $packages[2]->admins; ?> HR users
                     </td>
                     <td>
                        Up to <?php echo $packages[3]->admins; ?> HR users
                     </td>
                     <td>
                        Up to <?php echo $packages[4]->admins; ?> HR users  (additional at $25 per user)
                     </td>
                  </tr>
                  <!-- add cart section start -->
                  <tr>
                     <td></td>
                     <td>
                        <a class="btn price-btn" id="link1" href=""> {{ __('button.subscribe') }}
                        </a>
                     </td>
                     <td>
                        <a class="btn price-btn" id="link2" href="./subscribe/professional/1"> {{ __('button.subscribe') }}
                        </a>
                     </td>
                     <td>
                        <a class="btn price-btn" id="link3" href="./subscribe/business/1"> {{ __('button.subscribe') }}
                        </a>
                     </td>
                     <td>
                        <a class="btn price-btn" id="link4" href="./subscribe/enterprise/1"> {{ __('button.subscribe') }}
                        </a>
                     </td>
                     <td>
                        <a class="btn price-btn" id="link5" href="./subscribe/elite/1"> {{ __('button.subscribe') }}
                        </a>
                     </td>
                  </tr>
                  <!-- //add cart section end -->
               </tbody>
            </table>
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
<script type="text/javascript" src="{{ asset('assets/vendors/wow/js/wow.min.js') }}" ></script>
<script type="text/javascript" src="{{ asset('assets/vendors/owl_carousel/js/owl.carousel.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/js/frontend/carousel.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/js/frontend/index.js') }}"></script>
<!--page level js ends-->
<!--for the radio button-->
<script language="javascript" type="text/javascript" src="{{ asset('assets/vendors/iCheck/js/icheck.js') }}"></script>
<script language="javascript" type="text/javascript" src="{{ asset('assets/vendors/bootstrap-switch/js/bootstrap-switch.js') }}"></script>
<script language="javascript" type="text/javascript" src="{{ asset('assets/vendors/switchery/js/switchery.js') }}" ></script>
<script language="javascript" type="text/javascript" src="{{ asset('assets/vendors/bootstrap-maxlength/js/bootstrap-maxlength.js') }}"></script>
<script language="javascript" type="text/javascript" src="{{ asset('assets/vendors/card/lib/js/jquery.card.js') }}"></script>
<script language="javascript" type="text/javascript" src="{{ asset('assets/js/pages/radio_checkbox.js') }}"></script>
<script src="http://www.jqueryscript.net/demo/jQuery-Plugin-To-Create-iOS-Style-Segmented-Controls-Segment-js/segment.js"></script>
<script>
   $(document).ready(function(){
       $('[data-toggle="tooltip"]').tooltip();   
   });
   
   
   //Monthly yearly switch
   
    var currencySymbol = <?php echo "'" .$currencySymbol ."'"; ?>;
    var amount1 = <?php echo $countryPricesRow->std_price; ?>;
    var amount2 = <?php echo $countryPricesRow->bn_price; ?>;
    var amount3 = <?php echo $countryPricesRow->pro_price; ?>;
    var amount4 = <?php echo $countryPricesRow->ent_price; ?>;
    var amount5 = <?php echo $countryPricesRow->el_price; ?>;
   
   
   $(document).ready(function(){
   
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
       
   	$('.content').each(function(index) {
       	var content = $(this);
           
           content.find('.price').text('$' + data[index].price);
           content.find('.interval').text(interval);
           content.find('.link').attr('href', data[index].link);
       });
   }
   
   // initialization 
   
   fillContent("monthly");
   
   $('.ui-segment').on("click", '.option', function() {
   	var interval = $(this).attr('value');
   
       //alert(interval);
       
       //fillContent(interval);
   
       if(interval == "yearly"){
               //alert(currencySymbol);
               //This means the package is now yearly 
               //Multiply the prices by 10
                  jQuery(".monthly-data").hide();
                   jQuery(".yearly-data").show();
                   jQuery("#price1").text(currencySymbol+<?php echo $packages[0]->price; ?>);
                   jQuery("#link1").attr('href','subscribe/standard/1');
                   jQuery("#price2").text(currencySymbol+<?php echo $packages[1]->price; ?>);
                   jQuery("#link2").attr('href','subscribe/professional/1');
                   jQuery("#price3").text(currencySymbol+<?php echo $packages[2]->price; ?>);
                   jQuery("#link3").attr('href','subscribe/business/1');
                   jQuery("#price4").text(currencySymbol+<?php echo $packages[3]->price; ?>);
                   jQuery("#link4").attr('href','subscribe/enterprise/1');
                   jQuery("#price5").text(currencySymbol+<?php echo $packages[4]->price; ?>);
                   jQuery("#link5").attr('href','subscribe/elite/1');
           }else{
               jQuery(".yearly-data").hide();
               jQuery(".monthly-data").show();
              jQuery("#price1").text(currencySymbol+<?php echo $packages[0]->monthly_price; ?>);
                   jQuery("#link1").attr('href','subscribe/standard/0');
                   jQuery("#price2").text(currencySymbol+<?php echo $packages[1]->monthly_price; ?>);
                   jQuery("#link2").attr('href','subscribe/professional/0');
                   jQuery("#price3").text(currencySymbol+<?php echo $packages[2]->monthly_price; ?>);
                   jQuery("#link3").attr('href','subscribe/business/0');
                   jQuery("#price4").text(currencySymbol+<?php echo $packages[3]->monthly_price; ?>);
                   jQuery("#link4").attr('href','subscribe/enterprise/0');
                   jQuery("#price5").text(currencySymbol+<?php echo $packages[4]->monthly_price; ?>);
                   jQuery("#link5").attr('href','subscribe/elite/0');
           }
   
   });
   
   });
</script>
<script>
       
    $( document ).ready(function() {
         
         $("#choose-country2").show();
         
         $(".hide-home").show();
        
      });

    
 </script>
@stop