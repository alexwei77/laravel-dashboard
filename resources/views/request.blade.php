<!DOCTYPE html>
<html>
<head>
    <title>Pay Package | StaffLife</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @if (App::environment('prod'))
        <meta http-equiv="Content-Security-Policy" content="default-src 'self'; script-src 'self' 'unsafe-inline' checkout.stripe.com www.google-analytics.com www.googletagmanager.com; connect-src 'self'; img-src 'self' 'unsafe-inline' * data:; style-src 'self' 'unsafe-inline' fonts.googleapis.com; font-src 'self' 'unsafe-inline' fonts.gstatic.com fonts.googleapis.com data:; frame-src 'self' 'unsafe-inline' dmmdev.com;">
        <script>(function(b,m,h,a,g){b[a]=b[a]||[];b[a].push({"gtm.start":new Date().getTime(),event:"gtm.js"});var k=m.getElementsByTagName(h)[0],e=m.createElement(h),c=a!="dataLayer"?"&l="+a:"";e.async=true;e.src="https://www.googletagmanager.com/gtm.js?id="+g+c;k.parentNode.insertBefore(e,k)})(window,document,"script","dataLayer","GTM-K6GM83G");</script>
    @endif
    <!--global css starts-->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/bootstrap.min.css') }}">
    <link rel="shortcut icon" href="{{ asset('assets/images/favicon.png') }}" type="image/x-icon">
    <link rel="icon" href="{{ asset('assets/images/favicon.png') }}" type="image/x-icon">
    <!--end of global css-->
    <!--page level css starts-->
    <link type="text/css" rel="stylesheet" href="{{asset('assets/vendors/iCheck/css/all.css')}}"/>
    <link href="{{ asset('assets/vendors/bootstrapvalidator/css/bootstrapValidator.min.css') }}" rel="stylesheet"/>
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/frontend/login.css') }}">
    <!--end of page level css-->
</head>

<style>
    .stripe-button-el {
        background: #ee6f00 !important;
        padding: 5px 28px !important;
        border-radius: 0 !important;
        border: 0 !important;
        margin-top: 20px !important;
        margin-bottom: 20px !important;
    }

    .stripe-button-el span {
        display: block;
        position: relative;
        font-size: 17px !important;
        color: #ffffff !important;
        font-weight: 400 !important;
        font-family: 'Lato', sans-serif !important;
        text-shadow: none !important;
        box-shadow: none !important;
        background: #ee6f00 !important;
        border-radius: 0 !important;
    }

    .box1 {
        text-align: center;
        margin-top: 30px !important;
    }

    .box {
        margin-top: 30px !important;
    }

    .body {
        padding-top: 20px !important;
    }
</style>

</head>
<body>
@if (App::environment('prod'))
    <!-- Google Tag Manager (noscript) -->
    <noscript>
        <iframe src="https://www.googletagmanager.com/ns.html?id=GTM-K6GM83G" height="0" width="0" style="display:none;visibility:hidden"></iframe>
    </noscript>
    <!-- End Google Tag Manager (noscript) -->
@endif
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

if (count($subdata) > 0) {
    $_SESSION["standard_category"] = $subdata['standard_category'];
    $_SESSION["sub_countryid"] = $subdata['sub_countryid'];
    $_SESSION["AMOUNT"] = $subdata['AMOUNT'];
    //set the user's details in session variable
    $_SESSION["user"] = $subdata['user'];
    $_SESSION["country"] = $subdata['COUNTRY'];
    $_SESSION['requestArray'] = $subdata;
    $_SESSION["sub_countryid"] = $subdata['sub_countryid'];
} else {
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


if (count($subdata) > 0) {
    $mandatoryFields = array(
        'VERSION' => $subdata['VERSION'],
        'PAYGATE_ID' => $subdata['PAYGATE_ID'],
        'REFERENCE' => $subdata['REFERENCE'],
        'AMOUNT' => ($subdata['AMOUNT'] * 100), //cehck if the amount reeived is valid
        'CURRENCY' => $subdata['CURRENCY'],
        'RETURN_URL' => $subdata['RETURN_URL'],  //."/" .$subdata['category'] ."/" .$subdata['contractsQuantity']
        'TRANSACTION_DATE' => $subdata['TRANSACTION_DATE'],
        //'EMAIL'             => "customer@mywebsite.com", //if not given it will be requested in the pages
        'SUBS_START_DATE' => $subdata['SUBS_START_DATE'],
        'SUBS_END_DATE' => $subdata['SUBS_END_DATE'],
        'SUBS_FREQUENCY' => $subdata['SUBS_FREQUENCY'],
        'PROCESS_NOW' => $subdata['PROCESS_NOW'],
        'PROCESS_NOW_AMOUNT' => ($subdata['AMOUNT'] * 100),
    );

    $optionalFields = array();

    $data = array_merge($mandatoryFields, $optionalFields);

    $_SESSION['requestArray'] = $data;
    $_SESSION['COUNTRY'] = $subdata['COUNTRY'];

    $PayWeb3 = new PayGate_PayWeb3();

    $PayWeb3->setEncryptionKey($encryption_key);

    $PayWeb3->setInitiateRequest($data);

    $theChecksum = $PayWeb3->generateChecksum($data);

} else {


    $mandatoryFields1 = array(
        'PAYGATE_ID' => $subdata1['PAYGATE_ID'],
        'REFERENCE' => $subdata1['REFERENCE'],
        'AMOUNT' => ($subdata1['AMOUNT']) * 100, //cehck if the amount reeived is valid
        'CURRENCY' => $subdata1['CURRENCY'],
        'RETURN_URL' => $subdata1['RETURN_URL'],  //."/" .$subdata['category'] ."/" .$subdata['contractsQuantity']
        'TRANSACTION_DATE' => $subdata1['TRANSACTION_DATE'],
        //'EMAIL'             => "customer@mywebsite.com", //if not given it will be requested in the pages
        'LOCALE' => $subdata1['LOCALE'],
        'COUNTRY' => $subdata1['COUNTRY'],
        'EMAIL' => $subdata1['EMAIL'],
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

    $data1 = array_merge($mandatoryFields1, $optionalFields1);
    //print_r($data1);

    $_SESSION['requestArray1'] = $data1;
    $_SESSION['COUNTRY1'] = $subdata1['COUNTRY'];

    $PayWeb31 = new PayGate_PayWeb31();

    $PayWeb31->setEncryptionKey($encryption_key);

    $requestPre = $PayWeb31->setInitiateRequest($data1);

    $theChecksum1 = $PayWeb31->generateChecksum($data1);
    $returnData = $PayWeb31->doInitiate();
    //echo "printing the request ";
    $dataPostedBack = $PayWeb31->processRequest;
    //print_r($dataPostedBack);
    //echo $dataPostedBack['PAY_REQUEST_ID'];

}


?>
<div class="container">
    <!--Content Section Start -->
    <div class="row">
        <div class="box animation">
            <div class="box1">
                <img src="{{ asset('assets/images/logostaff.png') }}" alt="logo" class="img-responsive mar">
                <h3 class="text-primary">{{ __('loginsignup.notice') }}</h3>
                <!-- Notifications -->
                @include('notifications')
                <div style="height:30px;"></div>
                <label class="control-label">{{ __('loginsignup.noticetext') }}</label>
                @if(count($subdata) > 0)
                    <form action="{{ action('SubscriptionsController@saveStripeToken') }}" method="POST">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}"/>
                        <input type='hidden' name='packageid' value='<?php echo $the_package->id; ?>'/>
                        <input type='hidden' name='packagename' value='<?php echo $the_package->name; ?>'/>
                        <input type='hidden' name='month_year' value='0'/>
                        <input type='hidden' name='employees_avail' value='<?php echo $the_package->terms_forms; ?>'/>
                        <input type='hidden' name='admins_avail' value='<?php echo $the_package->admins; ?>'/>
                        <input type='hidden' name='amount' value='<?php echo ($the_package->monthly_price) * 100; ?>'/>
                        <script
                                src="https://checkout.stripe.com/checkout.js"
                                class="stripe-button"
                                data-key="<?=env('STRIPE_KEY', 'pk_test_FY9SDqgyUnVNxwXFKfd0uenR')?>"
                                data-name="StaffLife"
                                data-description="<?php echo $the_package->name . " Subscription Package"; ?>"
                                data-amount="<?php echo ($the_package->monthly_price) * 100; ?>"></script>
                    </form>
                @endif
                @if(count($subdata1) > 0)
                    <form action="{{ action('SubscriptionsController@saveStripeToken') }}" method="POST">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}"/>
                        <input type='hidden' name='packageid' value='<?php echo $the_package->id; ?>'/>
                        <input type='hidden' name='packagename' value='<?php echo $the_package->name; ?>'/>
                        <input type='hidden' name='month_year' value='1'/>
                        <input type='hidden' name='employees_avail' value='<?php echo $the_package->terms_forms; ?>'/>
                        <input type='hidden' name='admins_avail' value='<?php echo $the_package->admins; ?>'/>
                        <input type='hidden' name='amount' value='<?php echo ($the_package->monthly_price) * 100; ?>'/>
                        <script
                                src="https://checkout.stripe.com/checkout.js"
                                class="stripe-button"
                                data-key="<?=env('STRIPE_KEY', 'pk_test_FY9SDqgyUnVNxwXFKfd0uenR')?>"
                                data-name="StaffLife"
                                data-description="<?php echo $the_package->name . " Subscription Package"; ?>"
                                data-amount="<?php echo (($the_package->price) * 12) * 100; ?>"></script>
                    </form>
                    {{--{!!  Form::close()  !!}--}}
                @endif

                <div style="text-align:center;">
                    <hr style="width:80%; color:#dadada; border-top: 1px solid #c5c5c5 !important;">
                    <img src="{{ asset('assets/images/stripe-payment.jpg') }}" style="max-width:200px">
                </div>

            </div>
        </div>
    </div>
    <div>
        <div style="height:50px;"></div>
        <div class="container"
             style="background-color:#ffffff; border:1px solid #dddddd; padding:20px; border-top: 5px solid #ee6f00;">
            <h3 style="text-align:center; font-size: 28px; line-height: 35px; font-weight: 400; color: #4caf50;">We
                guarantee - within 4 months</h3>
            <hr style="width:20%; border-top: 1px solid #dddddd; margin-top:0; margin-bottom:30px;">
            <div class="row">

                <div class="col-sm-4">
                    <table>
                        <tr>
                            <td>
                                <img src="{{  asset('assets/images/productivity.png') }}">
                            </td>
                            <td>
                                <p class="stattext" style="padding-left:20px;">90% + in productivity</p>
                            </td>
                        </tr>
                    </table>
                </div>

                <div class="col-sm-4">
                    <table>
                        <tr>
                            <td>
                                <img src="{{ asset('assets/images/badhires.png') }}">
                            </td>
                            <td>
                                <p class="stattext" style="padding-left:20px;">80% + in lower bad hires</p>
                            </td>
                        </tr>
                    </table>
                </div>

                <div class="col-sm-4">
                    <table>
                        <tr>
                            <td>
                                <img src="{{ asset('assets/images/hrcost.png') }}">
                            </td>
                            <td>
                                <p class="stattext" style="padding-left:20px;">60% + in lower HR admin costs</p>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-4">
                    <table>
                        <tr>
                            <td>
                                <img src="{{ asset('assets/images/bettertalent.png') }}">
                            </td>
                            <td>
                                <p class="stattext" style="padding-left:20px;">15% + in attracting better talent</p>
                            </td>
                        </tr>
                    </table>
                </div>
                <div class="col-sm-4">
                    <table>
                        <tr>
                            <td>
                                <img src="{{ asset('assets/images/morale.png') }}">
                            </td>
                            <td>
                                <p class="stattext" style="padding-left:20px;">Better company culture & morale</p>
                            </td>
                        </tr>
                    </table>
                </div>
                <div class="col-sm-4">
                    <table>
                        <tr>
                            <td>
                                <img src="{{ asset('assets/images/customer.png') }}">
                            </td>
                            <td>
                                <p class="stattext" style="padding-left:20px;">Higher revenues & customer retention</p>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
            <div style="height:20px;"></div>
            <!-- Trigger the modal with a button -->
            <p style="text-align:center; padding-bottom:20px;" class="faqtextbig"><span
                        style="margin-bottom:30px; font-size: 21px; font-weight: 300; line-height: 24px;">Or your money back!</span>
            </p>
            <p style="text-align:center;">
                <button type="button" class="btn btn-success btn-lg" data-toggle="modal" data-target="#myModal"
                        style="color:#ffffff !important;">View Policy
                </button>
            </p>

            <!-- Modal -->
            <div class="modal fade" id="myModal" role="dialog">
                <div class="modal-dialog">

                    <!-- Modal content-->
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h3 style="text-align:center; font-size: 28px; line-height: 28px; font-weight: 400; color: #4caf50;">
                                Guarantee Policy</h3>
                        </div>
                        <div class="modal-body">
                            <p>StaffLife will refund you in full for all the fees paid towards your StaffLife Membership
                                - if you are not satisfied for any reason, after 4 months use of our system.<br/><br/>We
                                also guarantee a minimum return of 100 times your fees, in 4 months or less.<br/><br/>How
                                do we do it?<br/><br/>According to current statistics, replacing an employee, costs a
                                full annual salary.
                                Other costs are staggering too. Poor company culture, low morale, bad customer service -
                                all leading to lower revenues and significant risk to the business. <br/><br/>StaffLife
                                protects your business with a very high degree of efficacy.</p>
                        </div>
                        <div class="modal-footer">
                            <p style="text-align:center;">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- //Content Section End -->
</div>
<!--global js starts-->
<script type="text/javascript" src="{{ asset('assets/js/frontend/jquery.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/js/frontend/bootstrap.min.js') }}"></script>
<script src="{{ asset('assets/vendors/bootstrapvalidator/js/bootstrapValidator.min.js') }}"
        type="text/javascript"></script>
<script type="text/javascript" src="{{ asset('assets/vendors/iCheck/js/icheck.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/js/frontend/login_custom.js') }}"></script>
<!--global js end-->
<script language="javascript" type="text/javascript">
    jQuery(document).ready(function () {
        jQuery(".stripe-button-el").submit();
    });

    jQuery(document).ready(function () {
        jQuery(".stripe-button-el").submit();
    });
</script>
</body>
</html>