@extends('admin/layouts/defaultx')
{{-- Page title --}}
@section('title')
Subscribe
@stop
{{-- page level styles --}}
@section('header_styles')
<link rel="stylesheet" type="text/css" href="{{ asset('assets/vendors/jasny-bootstrap/css/jasny-bootstrap.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/vendors/iCheck/css/minimal/blue.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/vendors/select2/css/select2.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/vendors/select2/css/select2-bootstrap.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/vendors/datetimepicker/css/bootstrap-datetimepicker.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/frontend/user_account.css') }}">
@stop
{{-- Page content --}}
@section('content')
<?php
 use App\User;
 use Illuminate\Support\Facades\DB;

 use App\Http\Requests;
 use App\Http\Requests\UserRequest;
//check the payment status 
$user = Sentinel::getUser();
$transactionReceivedAl = 0;
if(isset($_REQUEST['credit_card_processed'])){
    if($_REQUEST['credit_card_processed'] == 'Y'){
        //check if the subscription is not there already 
        $subscriptionCheck = DB::table('dmmx_paysubscriptions')->where('invoice_id', $_REQUEST['invoice_id'])->get();
        //update the subscription status 
        if(count($subscriptionCheck) > 0){
            $transactionReceivedAl = 1;
        }else{
            //check if upgrade
            if(isset($_REQUEST['upgrade'])){
                
                 //stop the old billing
                   $ch = curl_init();
	               curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
                   curl_setopt($ch, CURLOPT_USERPWD, "Devfourteen-sl:Testing@123"); //Your credentials goes here
                   curl_setopt_array($ch, array(
                          CURLOPT_RETURNTRANSFER => 1,
                          CURLOPT_URL => 'https://www.2checkout.com/api/sales/stop_lineitem_recurring',
                          CURLOPT_USERAGENT => 'StaffLife',
                          CURLOPT_POST => 1,
                          CURLOPT_POSTFIELDS => array(
                             'lineitem_id' => $_REQUEST['old_order_number']
                          )
                      ));
	             $StopRecurring = curl_exec($ch);
                 curl_close($ch);

                 //update billing based on the current state of data 
                 /*$ch = curl_init();
	               $url = "https://901248156:8CE03B2D-FE41-4C53-9156-52A8ED5A0FA3@2checkout.com/checkout/api/1/103325953/rs/authService?sellerId=&privateKey=&merchantOrderId=&currency=total=&type=&name=&price=&recurrence=&name=&addrLine1=&addrLine2=&city=&state=&zipCode=&country=&email=&phoneNumber&=";
	               curl_setopt($ch, CURLOPT_URL, $url);
	               curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
	             $createSubscription = curl_exec($ch);*/
                  //upgrade the recurring subscription details of the same product that they have just created
                 $billing_period = '1 Month';
                 if(isset($_REQUEST['month_year'])){
                     if($_REQUEST['month_year'] == 1){
                       $billing_period = '1 Year';
                     }
                 }
                  $ch = curl_init();
	               curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
                   curl_setopt($ch, CURLOPT_USERPWD, "Devfourteen-sl:Testing@123"); //Your credentials goes here
                   curl_setopt_array($ch, array(
                          CURLOPT_RETURNTRANSFER => 1,
                          CURLOPT_URL => 'https://www.2checkout.com/api/products/update_product',
                          CURLOPT_USERAGENT => 'StaffLife',
                          CURLOPT_POST => 1,
                          CURLOPT_POSTFIELDS => array(
                             'product_id' => $_REQUEST['order_number'], //This hould be from database
                             'name' => $_REQUEST['name'],
                             'price' => $_REQUEST['package_price'],
                             'vendor_product_id' => $_REQUEST['li_0_product_id'],
                             'recurring' => 1,
                             'recurrence' => $billing_period, //1 month or 1year

                          )
                      ));
	             $createSubscription = curl_exec($ch);
                 //print($createSubscription);
                 curl_close($ch);
                 //print_r($_REQUEST);

                 //update the billing in the database 
                  $upadateSubscription = DB::table('dmmx_paysubscriptions')->where('userid', $user->id)->update(['sub_type'=>$_REQUEST['month_year'],'packageid'=>$_REQUEST['package_id'],'pay_status'=>1,'order_number'=>$_REQUEST['order_number'],'invoice_id'=>$_REQUEST['invoice_id'],'employees_avail'=>$_REQUEST['employees_avail'],'admins_avail'=>$_REQUEST['admins_avail']-1, 'AMOUNT' =>$_REQUEST['package_price']]);

            }else{
              $upadateSubscription = DB::table('dmmx_paysubscriptions')->where('userid', $user->id)->update(['pay_status'=>1,'order_number'=>$_REQUEST['order_number'],'invoice_id'=>$_REQUEST['invoice_id'],'employees_avail'=>$_REQUEST['employees_avail'],'admins_avail'=>$_REQUEST['admins_avail']-1]);
            }
        }
         
    }else{
        //something went wrong
    }
}
?>
   <section class="content-header">
   <h1>Payment Result</h1>
   <ol class="breadcrumb">
      <li>
         <a href="{{ route('admin.dashboard') }}">
         <i class="livicon" data-name="home" data-size="14" data-color="#000"></i>
         Dashboard
         </a>
      </li>
      <li class="active">Payment result</li>
   </ol>
</section>
<div class="container">
   <hr>
   <!-- Accordions Section End -->
   <div class="container">
      <div class="row">
    
      </div>
      <!-- //Accordions Section End -->
      <div class="position-center">
         <form role="form" class="form-horizontal text-left" action="query.php" method="post" name="query_paygate_form">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <div class="form-group">
               <label for="TRANSACTION_STATUS" class="col-sm-3 control-label">Transaction Status</label>
               <p id="TRANSACTION_STATUS" class="form-control-static"><?php 
                 //$ch = curl_init();
	               //$url = "https://superadmin-sl:Testing@123@2checkout.com/checkout/sales/stop_lineitem_recurring?lineitem_id=".$_REQUEST['order_number'];
                   /*$url = "https://superadmin-sl:Testing@123@2checkout.com/api/sales/list_sales";
	               curl_setopt($ch, CURLOPT_URL, $url);*/


	               /*curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
                   curl_setopt($ch, CURLOPT_USERPWD, "Devfourteen-sl:Testing@123"); //Your credentials goes here
                   curl_setopt_array($ch, array(
                          CURLOPT_RETURNTRANSFER => 1,
                          CURLOPT_URL => 'https://www.2checkout.com/api/products/list_products',
                          CURLOPT_USERAGENT => 'Codular Sample cURL Request',
                          CURLOPT_POST => 1,
                          CURLOPT_POSTFIELDS => array(
                             //'lineitem_id' => $_REQUEST['order_number']
                          )
                      ));
	             $StopRecurring = curl_exec($ch);

                 print_r($StopRecurring);
                 die;*/

                 //create a new billing based on the current state of data 
                /* $ch = curl_init();
	               $url = "https://901248156:8CE03B2D-FE41-4C53-9156-52A8ED5A0FA3@2checkout.com/checkout/api/1/103325953/rs/authService?sellerId=&privateKey=&merchantOrderId=&currency=total=&type=&name=&price=&recurrence=&name=&addrLine1=&addrLine2=&city=&state=&zipCode=&country=&email=&phoneNumber&=";
	               curl_setopt($ch, CURLOPT_URL, $url);
	               curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
	             $createSubscription = curl_exec($ch);*/
                                  
                    {
                    if($_REQUEST['credit_card_processed'] == 'Y'){ // && $isValid
                   //Transaction has been approved
                    //Insert the transaction result data into the database 
                    
                      echo "Congratulations, your subscription was succesful. Check your email for details of the payment.";
                      /*print_r($_REQUEST);
                      die;*/
                   }

                    if($transactionReceivedAl){
                      echo "Transaction received already.";
                    }
                    

                    /*if(!$isValid){
                        echo "The results were discarded due to security issues. It looks like the data you received has been modified by an unauthorized entity.";
                    }*/
                    }
        
                    ?>
                </p>
            </div>
            <div class="form-group">
               <!--<div class="col-sm-offset-5 col-sm-2">
                  <a href="{{ route('subscribe', 'default') }}" style="color: #fff;" class="btn btn-primary btn-block">Return to Subscription</a>
               </div>-->
            </div>
         </form>
      </div>
   </div>
   <!-- //Container End -->
</div>
@stop
{{-- page level scripts --}}
@section('footer_scripts')
<script type="text/javascript" src="{{ asset('assets/vendors/moment/js/moment.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/vendors/jasny-bootstrap/js/jasny-bootstrap.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/vendors/iCheck/js/icheck.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/vendors/select2/js/select2.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/vendors/datetimepicker/js/bootstrap-datetimepicker.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/js/frontend/user_account.js') }}"></script>
<script src="{{ asset('assets/vendors/bootstrapvalidator/js/bootstrapValidator.min.js') }}" type="text/javascript"></script>
<script type="text/javascript" src="{{ asset('assets/js/frontend/user_subscribe.js') }}"></script>
@stop