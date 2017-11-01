@extends('layouts/defaultx')
{{-- Page title --}}
@section('title')
Home
@parent
@stop
{{-- page level styles --}}
@section('header_styles')
<!--page level css starts-->
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/frontend/tabbular.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/vendors/animate/animate.min.css') }}" />
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/frontend/jquery.circliful.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/vendors/owl_carousel/css/owl.carousel.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/vendors/owl_carousel/css/owl.theme.css') }}">
<!--end of page level css-->
<!--ratings -->
<link href="{{ asset('assets/vendors/starability/starability-all.1.css') }}" rel="stylesheet" type="text/css"/>
<!--ratings-->
<link href="{{ asset('assets/vendors/select2/css/select2.min.css') }}" type="text/css" rel="stylesheet">
    <link href="{{ asset('assets/vendors/select2/css/select2-bootstrap.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendors/bootstrapvalidator/css/bootstrapValidator.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendors/iCheck/css/all.css') }}"  rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/pages/wizard.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendors/bootstrapStarRating/css/star-rating.min.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('assets/css/pages/custom_rating.css') }}" rel="stylesheet" type="text/css"/>

   <!--page level css starts-->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/frontend/price.css') }}">
<link href="{{ asset('assets/vendors/animate/animate.min.css') }}" rel="stylesheet" type="text/css"/>
    <!--end of page level css-->

    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/frontend/shopping.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/font-awesome.min.css') }}">

<style>
   .rating-container .clear-rating{
      display: none !important;
    }

  .rating-container .caption{
    display:none !important;
   }



   #sync1 .item{
    padding: 0px 0px;
    margin: 5px;
    color: #FFF;
    -webkit-border-radius: 3px;
    -moz-border-radius: 3px;
    border-radius: 3px;
    text-align: center;
}
#sync2 .item{
    background: #ee6f00;
    padding: 10px 0px;
    margin: 5px;
    color: #FFF;
    -webkit-border-radius: 3px;
    -moz-border-radius: 3px;
    border-radius: 3px;
    text-align: center;
    cursor: pointer;
}
#sync2 .item h1{
  font-size: 18px;
}
#sync2 .synced .item{
  background: #4caf50;
}

.box{
    margin-top: 0px !important;
}

#standard1{
    background-color: #4caf50;
}

/*This is temporary*/
#sync2 .synced .item {
    background: #ee6f00;
}

.package-info{
    color: #757b87;
}

.box_round_symboll{
 font-size: 20px !important; 
}
</style>
@stop
{{-- slider --}}
@section('top')
<!--Carousel Start -->
<div id="owl-demo" class="owl-carousel owl-theme">
   <!--<div class="item"><img src="{{ asset('assets/images/slide_1.jpg') }}" alt="slider-image">
   </div>-->
   <div class="item"><img src="{{ asset('assets/images/slide_2.jpg') }}" alt="slider-image">
   </div>
  
</div>
<!-- //Carousel End -->
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

?>


<div class="container">
   @if(!Sentinel::guest())
   <?php if(!empty($user->permissions2)){ ?>
   <section class="purchas-main">
      <div class="container bg-border" data-wow-duration="2.5s">
         <div class="row">
            <div class="col-md-7 col-sm-7 col-xs-12">
               <h1 class="purchae-hed">Create Employee Rating</h1>
            </div>
            <div class="col-md-5 col-sm-5 col-xs-12"><a href="{{ route('create-rating') }}" class="btn btn-primary purchase-styl pull-right">Create</a></div>
         </div>
      </div>
   </section>
   <?php }?>
   @endif


<!--<form action="<?php //{{ route('sendmail')}} ?>" method="post">
     <input type="email" name="mail" placeholder="mail address">
     <input type="text" name="title" placeholder="title">
     <button type="submit">Send me A Mail</button>
     {{ csrf_field() }}
</form>-->

   <!-- Service Section Start-->
   <?php if(!empty($user->permissions2)){ ?>
   <div class="row">
      <!-- Responsive Section Start -->
      @if($activitiesCount > 0)
      @if(!Sentinel::guest())
      <div class="text-center">
         <h3 class="border-primary"><span class="heading_border bg-primary">Recent Activities</span></h3>
      </div>
      @endif
      @if(!Sentinel::guest())

      <!--Get all the Ratings that the user has right to view (using blade template) -->
      <!--start of ratings loop-->
       @foreach ($activities as $activity)

         <div class="col-sm-6 col-md-3 wow" data-wow-duration="3s" data-wow-delay="0.4s">
         <!-- Box Start -->
         <div class="box">
            <!--<div class="box-icon box-icon1" style="background-image: url('http://localhost/dmmx/dmmx/public/assets/images/authors/img1.jpg'); -webkit-background-size: cover; -moz-background-size: cover; -o-background-size: cover; background-size: cover;">
              
            </div>-->
            <div class="info">
               <div class="text-center">{{ $activity->title }} <br>{{ $activity->created_at }}</div>
               <!--limit the number of characters in here for consistency purposes-->
               <h5 class="primary text-center">{{ $activity->creator_name }}</h5>
               <!--<div class="text-center">{{ $activity->activity_kind }}</div>-->
               <div class="text-center">{{ $activity->summary }}</div>
            </div>
            <div class="text-center primary"><a href="{{ $activity->link }}">view</a>
            </div>
            <!--end of box-->
         </div>
      </div>
             
       @endforeach
       <!-- end of ratings loop-->
     
      @endif
      <!-- //20+ Page Section End -->
      @endif <!--end activities count is greater than zero-->
   </div>
   <?php }?>
   <!-- //Services Section End -->

<!-- Layout Section Start -->
<!-- //Layout Section Start -->
<!-- Accordions Section End -->
<?php if(empty($user->permissions2)){ ?>

<!--the section below should not be accessible to employees-->
<?php if(!$employeeCheck){ ?>
<div class="container">
   <div class="row">
      <!-- Accordions Start -->
      <div class="text-center wow" data-wow-duration="3s">
         <h3 class="border-success"><span class="heading_border bg-success">Membership Packages</span></h3>
         <label class=" text-center"> Below are details of how the membership works</label>
      </div>
      
   </div>
   <!-- //Accordions Section End -->

<div class="row">
            <div class="col-sm-12">
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr class="bg-default">
                                <th>
                                    <h4></h4></th>
                                <th>
                                    <h4>Standard</h4></th>
                                <th>
                                    <h4>Business </h4></th>
                                <th>
                                    <h4>Professional </h4></th>
                                <th>
                                    <h4>Enterprise </h4></th>
                                <th>
                                    <h4>Elite </h4></th>
                            </tr>
                        </thead>
                        <tbody>
                           
                            <!-- price section start -->
                            <tr>
                                <td style="vertical-align: middle;">Price</td>
                                <td>
                                    <!--<del class="text-danger">$1150</del>-->
                                    <br /><div class="box_round_symboll">
                                         <?php echo $currencySymbol; ?><?php echo $countryPricesRow->std_price; ?>
                                        </div></td>
                                <td>
                                <br />
                                <div class="box_round_symboll">
                                  <?php echo $currencySymbol; ?><?php echo $countryPricesRow->bn_price; ?>
                                 </div>
                                    </td>
                                <td>
                                <br />
                                <div class="box_round_symboll">
                                  <?php echo $currencySymbol; ?><?php echo $countryPricesRow->pro_price; ?>
                                  </div>
                                    </td>
                                <td>
                                    <br /> 
                                    <div class="box_round_symboll">
                                      <?php echo $currencySymbol; ?><?php echo $countryPricesRow->ent_price; ?>
                                     </div>
                                    </td>
                                <td>
                                    <br /> 
                                    <div class="box_round_symboll">
                                     <?php echo $currencySymbol; ?><?php echo $countryPricesRow->el_price; ?>
                                    </div>
                                    </td>
                            </tr>
                            <!-- //price section end -->
                            <!-- model section start -->
                            <tr>
                                <td style="vertical-align: middle;">Employees</td>
                                <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $countryPricesRow->std_employees; ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                                <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $countryPricesRow->bn_employees; ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                                <td><?php echo $countryPricesRow->pro_employees; ?></td>
                                <td><?php echo $countryPricesRow->ent_employees; ?></td>
                                <td><?php echo $countryPricesRow->el_employees; ?></td>
                            </tr>
                            <!-- //model section end -->
                            <!-- brand section start -->
                            <tr>
                                <td style="vertical-align: middle;">Base</td>
                                <td><?php echo $countryPricesRow->std_base; ?></td>
                                <td><?php echo $countryPricesRow->bn_base; ?></td>
                                <td><?php echo $countryPricesRow->pro_base; ?></td>
                                <td><?php echo $countryPricesRow->ent_base; ?></td>
                                <td><?php echo $countryPricesRow->el_base; ?></td>
                            </tr>
                            <!-- //brand section start -->
                            <!-- Availbility section start -->
                            <tr>
                                <td style="vertical-align: middle;">Annual Payment Discount</td>
                                <td><?php echo $countryPricesRow->std_discount; ?></td>
                                <td><?php echo $countryPricesRow->bn_discount; ?></td>
                                <td><?php echo $countryPricesRow->pro_discount; ?></td>
                                <td><?php echo $countryPricesRow->ent_discount; ?></td>
                                <td><?php echo $countryPricesRow->el_discount; ?></td>
                            </tr>
                            <!-- //Availbility section end -->
                            <!-- rating section start -->
                            <tr>
                                <td style="vertical-align: middle;">Terms Forms(Active&Checks)</td>
                                <td>
                                    <?php echo $countryPricesRow->std_terms; ?>
                                </td>
                                <td>
                                    <?php echo $countryPricesRow->bn_terms; ?>
                                </td>
                                <td>
                                    <?php echo $countryPricesRow->pro_terms; ?>
                                </td>
                                <td>
                                    <?php echo $countryPricesRow->ent_terms; ?>
                                </td>
                                <td>
                                    Unlimited
                                </td>
                            </tr>
                            <!-- //rating section end -->
                            <!-- description section start -->
                            <tr>
                                <td style="vertical-align: middle;">Cost per employee or check</td>
                                <td class="description">
                                    <?php echo $currencySymbol; ?><?php echo $countryPricesRow->std_cost_employee; ?>
                                </td>
                                <td class="description">
                                    <?php echo $currencySymbol; ?><?php echo $countryPricesRow->bn_employee_cost; ?>
                                </td>
                                <td class="description">
                                    <?php echo $currencySymbol; ?><?php echo $countryPricesRow->pro_employee_cost; ?>
                                </td>
                                <td class="description">
                                   <?php echo $currencySymbol; ?><?php echo $countryPricesRow->ent_employee_cost; ?>
                                </td>
                                <td class="description">
                                    <?php echo $countryPricesRow->el_employee_cost; ?>
                                </td>
                            </tr>
                            <!-- description section end -->
                            <tr>
                                <td style="vertical-align: middle;">Support</td>
                                <td class="description">
                                    <?php echo $countryPricesRow->std_support; ?>
                                </td>
                                <td class="description">
                                    <?php echo $countryPricesRow->bn_support; ?>
                                </td>
                                <td class="description">
                                    <?php echo $countryPricesRow->pro_support; ?>
                                </td>
                                <td class="description">
                                    <?php echo $countryPricesRow->ent_support; ?>
                                </td>
                                <td class="description">
                                    <?php echo $countryPricesRow->el_support; ?>
                                </td>
                            </tr>

                            <tr>
                                <td style="vertical-align: middle;">Users(admins)</td>
                                <td class="description">
                                    <?php echo $countryPricesRow->std_users; ?>
                                </td>
                                <td class="description">
                                    <?php echo $countryPricesRow->bn_users; ?>
                                </td>
                                <td class="description">
                                    <?php echo $countryPricesRow->pro_users; ?>
                                </td>
                                <td class="description">
                                    <?php echo $countryPricesRow->ent_users; ?>
                                </td>
                                <td class="description">
                                    Unlimited
                                </td>
                            </tr>
                            <!-- add cart section start -->
                            <tr>
                                <td></td>
                                <td>
                                 @if(!Sentinel::guest())
                        <a class="btn price-btn" href="{{ URL::to('subscribe', 'standard') }}"> Subscribe
                        </a>
                        @endif
                        @if(Sentinel::guest())
                        <a class="btn price-btn" href="{{ URL::to('subscribe', 'standard') }}"> Subscribe
                        </a>
                        @endif
                               </td>
                                <td>
                                @if(!Sentinel::guest())
                        <a class="btn price-btn" href="{{ URL::to('subscribe', 'business') }}"> Subscribe
                        </a>
                        @endif
                        @if(Sentinel::guest())
                        <a class="btn price-btn" href="{{ URL::to('subscribe', 'business') }}"> Subscribe
                        </a>
                        @endif
                                </td>
                                <td>
                                @if(!Sentinel::guest())
                        <a class="btn price-btn" href="{{ URL::to('subscribe', 'professional') }}"> Subscribe
                        </a>
                        @endif
                        @if(Sentinel::guest())
                        <a class="btn price-btn" href="{{ URL::to('subscribe', 'professional') }}"> Subscribe
                        </a>
                        @endif
                                </td>
                                <td>
                                @if(!Sentinel::guest())
                        <a class="btn price-btn" href="{{ URL::to('subscribe', 'enterprise') }}"> Subscribe
                        </a>
                        @endif
                        @if(Sentinel::guest())
                        <a class="btn price-btn" href="{{ URL::to('subscribe', 'enterprise') }}"> Subscribe
                        </a>
                        @endif
                                </td>
                                <td>
                                @if(!Sentinel::guest())
                        <a class="btn price-btn" href="{{ URL::to('subscribe', 'elite') }}"> Subscribe
                        </a>
                        @endif
                        @if(Sentinel::guest())
                        <a class="btn price-btn" href="{{ URL::to('subscribe', 'elite') }}"> Subscribe
                        </a>
                        @endif
                                </td>
                            </tr>
                            <!-- //add cart section end -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>



</div>
<?php }?>

<?php }?>

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
<!-- begining of page level js -->
<!-- end of page level js -->
<script src="{{ asset('assets/vendors/bootstrapStarRating/js/star-rating.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/js/pages/custom_rating.js') }}" type="text/javascript"></script>
 <script src="{{ asset('assets/vendors/wow/js/wow.min.js') }}" type="text/javascript"></script>
    <script>
        jQuery(document).ready(function () {
            new WOW().init();
        });
    </script>

    <script>
          $(document).ready(function() {
 
  var sync1 = $("#sync1"); //this is the banners
  var sync2 = $("#sync2"); //this is the tab
 
  sync1.owlCarousel({
    singleItem : false,
    items : 3,
    slideSpeed : 1000,
    navigation: false,
    pagination:false,
    afterAction : syncPosition,
    responsiveRefreshRate : 200,
  });
 
  sync2.owlCarousel({
    items : 5,
    itemsDesktop      : [1199,10],
    itemsDesktopSmall     : [979,10],
    itemsTablet       : [768,8],
    itemsMobile       : [479,4],
    pagination:false,
    responsiveRefreshRate : 100,
    afterInit : function(el){
      el.find(".owl-item").eq(0).addClass("synced");
    }
  });
 
  function syncPosition(el){
    var current = this.currentItem;
    $("#sync2")
      .find(".owl-item")
      .removeClass("synced")
      .eq(current)
      .addClass("synced")
    if($("#sync2").data("owlCarousel") !== undefined){
      center(current)
    }
  }
 
  $("#sync2").on("click", ".owl-item", function(e){
    e.preventDefault();
    var number = $(this).data("owlItem");
    sync1.trigger("owl.goTo",number);
  });
 
  function center(number){
    var sync2visible = sync2.data("owlCarousel").owl.visibleItems;
    var num = number;
    var found = false;
    for(var i in sync2visible){
      if(num === sync2visible[i]){
        var found = true;
      }
    }
 
    if(found===false){
      if(num>sync2visible[sync2visible.length-1]){
        sync2.trigger("owl.goTo", num - sync2visible.length+2)
      }else{
        if(num - 1 === -1){
          num = 0;
        }
        sync2.trigger("owl.goTo", num);
      }
    } else if(num === sync2visible[sync2visible.length-1]){
      sync2.trigger("owl.goTo", sync2visible[1])
    } else if(num === sync2visible[0]){
      sync2.trigger("owl.goTo", num-1)
    }
    
  }

  //highlight business and dehighlight the rest 
   $("#standard").on("click",function(){
       $("#standard1").css('background-color', '#4caf50');
       $("#professional1").css('background-color', '#fff');
       $("#enterprise1").css('background-color', '#fff');
       $("#elite1").css('background-color', '#fff');
       $("#business1").css('background-color', '#fff');
   });
   $("#business").on("click",function(){
       $("#standard1").css('background-color', '#fff');
       $("#professional1").css('background-color', '#fff');
       $("#enterprise1").css('background-color', '#fff');
       $("#elite1").css('background-color', '#fff');
       $("#business1").css('background-color', '#4caf50');
   });
   $("#professional").on("click",function(){
       $("#standard1").css('background-color', '#fff');
       $("#professional1").css('background-color', '#4caf50');
       $("#enterprise1").css('background-color', '#fff');
       $("#elite1").css('background-color', '#fff');
       $("#business1").css('background-color', '#fff');
   });
   $("#enterprise").on("click",function(){
       $("#standard1").css('background-color', '#fff');
       $("#professional1").css('background-color', '#fff');
       $("#enterprise1").css('background-color', '#4caf50');
       $("#elite1").css('background-color', '#fff');
       $("#business1").css('background-color', '#fff');
   });
   $("#elite").on("click",function(){
       $("#standard1").css('background-color', '#fff');
       $("#professional1").css('background-color', '#fff');
       $("#enterprise1").css('background-color', '#fff');
       $("#elite1").css('background-color', '#4caf50');
       $("#business1").css('background-color', '#fff');
   });


   $("#standard1").on("click",function(){
       $("#standard").click();
   });

   $("#business1").on("click",function(){
       $("#business").click();
   });

   $("#professional1").on("click",function(){
       $("#professional").click();
   });

   $("#enterprise1").on("click",function(){
       $("#enterprise").click();
   });

   $("#elite1").on("click",function(){
       $("#elite").click();
   });
 
});
    </script>
@stop