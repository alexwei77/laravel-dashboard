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
     * Once the client has completed the transaction on the PayWeb page, they will be redirected to the RETURN_URL set in the initate
     * Here we will check the transaction status and process accordingly
     *
     */

    /*
     * Sessions used here only because we can't get the PayGate ID, Transaction reference and secret key on the result page.
     */
    session_name('paygate_payweb3_testing_sample');
    session_start();

    $encryption_key = 'secret';

    include_once base_path('app/MyLibrary/paygatelib/php/global.inc.php');

    /*
     * Include the helper PayWeb 3 class
     */
    include_once base_path('app/MyLibrary/paygatelib/paygate.payweb3.php');

    /*
     * insert the returned data as well as the merchant specific data PAYGATE_ID and REFERENCE in array
     */


    $data = array(
        'PAYGATE_ID' => $_POST['PAYGATE_ID'],
        'REFERENCE' => $_POST['REFERENCE'],
        'TRANSACTION_STATUS' => $_POST['TRANSACTION_STATUS'],
        'RESULT_CODE' => $_POST['RESULT_CODE'],
        'AUTH_CODE' => $_POST['AUTH_CODE'],
        'AMOUNT' => $_POST['AMOUNT'],
        'RESULT_DESC' => $_POST['RESULT_DESC'],
        'TRANSACTION_ID' => $_POST['TRANSACTION_ID'],
        'SUBSCRIPTION_ID' => $_POST['SUBSCRIPTION_ID'],
        'RISK_INDICATOR' => $_POST['RISK_INDICATOR'],
        'CHECKSUM' => $_POST['CHECKSUM'],
    );


    /*
     * initiate the PayWeb 3 helper class
     */
    $PayWeb3 = new PayGate_PayWeb3();
    /*
     * Set the encryption key of your PayGate PayWeb3 configuration
     */
    $PayWeb3->setEncryptionKey($encryption_key);
    /*
     * Check that the checksum returned matches the checksum we generate
     */
    $isValid = $PayWeb3->validateChecksum($data);

    //echo "is it valid or not? It is: " .$isValid;
    //echo $data['CHECKSUM'];
    use App\User;
    use Illuminate\Support\Facades\DB;

    use App\Http\Requests;
    use App\Http\Requests\UserRequest;

    $user = Sentinel::getUser();

    $transactionReceivedAl = 0;

    //Save the data to the database
    if ($data['TRANSACTION_STATUS'] == 1) {
        //check that this is not a duplicate, if it is take the user to the home page
        $checkSubscription = DB::table('dmmx_paysubscriptions')->where('REFERENCE', $data['REFERENCE'])->first();
        if (!$checkSubscription) {

            //get package details depending on the session package variables
            //$_SESSION["standard_category"]
            //$_SESSION["sub_countryid"]
            $countrpricesRow = DB::table('dmmx_country_prices')->where('id', $_SESSION["sub_countryid"])->get();
            //get values for this package
            $prefix = '';
            $adminsAvail = 0;
            $employeesAvil = 0;
            if ($_SESSION["standard_category"] == 'standard') {
                $prefix = 'std_';
                $employeesAvil = 50;
                $adminsAvail = 0;
            }
            if ($_SESSION["standard_category"] == 'business') {
                $prefix = 'bn_';
                $employeesAvil = 250;
                $adminsAvail = 1;
            }
            if ($_SESSION["standard_category"] == 'professional') {
                $prefix = 'pro_';
                $employeesAvil = 1000;
                $adminsAvail = 2;
            }
            if ($_SESSION["standard_category"] == 'enterprise') {
                $prefix = 'ent_';
                $employeesAvil = 5000;
                $adminsAvail = 4;
            }
            if ($_SESSION["standard_category"] == 'elite') {
                $prefix = 'el_';
                $employeesAvil = -1;
                $adminsAvail = -1;
            }
            //columns to get
            $usersColumn = $prefix . 'users';
            $priceColumn = $prefix . 'price';
            $employeesColumn = $prefix . 'employees';
            $baseColumn = $prefix . 'base';
            $discountColumn = $prefix . 'discount';
            $termsColumn = $prefix . 'terms';
            $supportColumn = $prefix . 'support';
            $insertSubscription = DB::table('dmmx_paysubscriptions')->insert(
                ['userid' => $user->id, 'REFERENCE' => $_SESSION['requestArray']['REFERENCE'], 'TRANSACTION_STATUS' => $data['TRANSACTION_STATUS'], 'RESULT_CODE' => $data['RESULT_CODE'], 'AUTH_CODE' => $data['AUTH_CODE'], 'AMOUNT' => $_SESSION['requestArray']['AMOUNT'], 'RESULT_DESC' => $data['RESULT_DESC'], 'TRANSACTION_ID' => $data['TRANSACTION_ID'], 'SUBSCRIPTION_ID' => $data['SUBSCRIPTION_ID'], 'RISK_INDICATOR' => $data['RISK_INDICATOR'], 'sub_countrcode' => $countrpricesRow[0]->country_code, 'sub_currencycode' => $countrpricesRow[0]->currency_code, 'quantity_admins' => $countrpricesRow[0]->$usersColumn, 'admins_avail' => $adminsAvail, 'employees' => $countrpricesRow[0]->$employeesColumn, 'employees_avail' => $employeesAvil, 'base' => $countrpricesRow[0]->$baseColumn, 'terms' => $countrpricesRow[0]->$termsColumn, 'support' => $countrpricesRow[0]->$supportColumn, 'TRANSACTION_DATE' => $_SESSION['requestArray']['TRANSACTION_DATE'], 'SUBS_START_DATE' => $_SESSION['requestArray']['SUBS_START_DATE'], 'SUBS_END_DATE' => $_SESSION['requestArray']['SUBS_END_DATE'], 'SUBS_FREQUENCY' => $_SESSION['requestArray']['SUBS_FREQUENCY'], 'PROCESS_NOW_AMOUNT' => $_SESSION['requestArray']['PROCESS_NOW_AMOUNT'], 'created_at' => date('Y-m-d H:i:s')]
            );
            if ($insertSubscription) {
                //add permission to all the users that have permission to this subscription package
                $subscriptionID = DB::table('dmmx_paysubscriptions')->where('REFERENCE', $_SESSION['requestArray']['REFERENCE'])->get();
                //refine this to include all users depednded on this account
                foreach ($subscriptionID as $subscriptionID1) {
                    DB::table('users')->where('id', $user->id)->update(['permissions2' => $subscriptionID1->id]);
                }

            }
        } else {
            $transactionReceivedAl = 1;

            //update the package 
            $countrpricesRow = DB::table('dmmx_country_prices')->where('id', $_SESSION["sub_countryid"])->get();
            //get values for this package
            $prefix = '';
            $adminsAvail = 0;
            $employeesAvil = 0;
            if ($_SESSION["standard_category"] == 'standard') {
                $prefix = 'std_';
                $employeesAvil = 50;
                $adminsAvail = 0;
            }
            if ($_SESSION["standard_category"] == 'business') {
                $prefix = 'bn_';
                $employeesAvil = 250;
                $adminsAvail = 1;
            }
            if ($_SESSION["standard_category"] == 'professional') {
                $prefix = 'pro_';
                $employeesAvil = 1000;
                $adminsAvail = 2;
            }
            if ($_SESSION["standard_category"] == 'enterprise') {
                $prefix = 'ent_';
                $employeesAvil = 5000;
                $adminsAvail = 4;
            }
            if ($_SESSION["standard_category"] == 'elite') {
                $prefix = 'el_';
                $employeesAvil = -1;
                $adminsAvail = -1;
            }
            //columns to get
            $usersColumn = $prefix . 'users';
            $priceColumn = $prefix . 'price';
            $employeesColumn = $prefix . 'employees';
            $baseColumn = $prefix . 'base';
            $discountColumn = $prefix . 'discount';
            $termsColumn = $prefix . 'terms';
            $supportColumn = $prefix . 'support';

            ////update the subscription
            //determine the number of employees watched an dthe number of already available
            //|| Get admins using this package
            $adminsUsingPackage = DB::table('users')->where('permissions2', $checkSubscription->id)->get();
            $arrayOfUsersIds = array();
            $numberOfAdmins = 0;
            foreach ($adminsUsingPackage as $singleAdmin) {
                array_push($arrayOfUsersIds, $singleAdmin->id);
                $numberOfAdmins++;
            }
            $numberOfEmployee = DB::table('dmmx_employees_watch')->whereIn('companyid', $arrayOfUsersIds)->count();

            //print_r($adminsUsingPackage);
            $updateSubscription = DB::table('dmmx_paysubscriptions')->where('REFERENCE', $data['REFERENCE'])->update(
                ['AMOUNT' => $_SESSION['requestArray']['AMOUNT'], 'quantity_admins' => $countrpricesRow[0]->$usersColumn, 'admins_avail' => ($adminsAvail - $numberOfAdmins) + 1, 'employees' => $countrpricesRow[0]->$employeesColumn, 'employees_avail' => ($employeesAvil - $numberOfEmployee), 'base' => $countrpricesRow[0]->$baseColumn, 'terms' => $countrpricesRow[0]->$termsColumn, 'support' => $countrpricesRow[0]->$supportColumn, 'TRANSACTION_DATE' => $_SESSION['requestArray']['TRANSACTION_DATE'], 'SUBS_FREQUENCY' => $_SESSION['requestArray']['SUBS_FREQUENCY'], 'updowngrade_amount' => $_SESSION['requestArray']['PROCESS_NOW_AMOUNT'], 'created_at' => date('Y-m-d H:i:s')]
            );

            if ($updateSubscription) {
                //add permission to all the users that have permission to this subscription package
                $subscriptionID = DB::table('dmmx_paysubscriptions')->where('REFERENCE', $_SESSION['requestArray']['REFERENCE'])->get();
                //refine this to include all users depednded on this account
                foreach ($subscriptionID as $subscriptionID1) {
                    DB::table('users')->where('id', $user->id)->update(['permissions2' => $subscriptionID1->id]);
                }

            }

        }
    }
    //print_r($data);

    //echo $_SESSION['requestArray']['REFERENCE'];
    ?>

    <section class="content-header">
        <h1>Payment results</h1>
        <ol class="breadcrumb">
            <li>
                <a href="{{ route('admin.dashboard') }}">
                    <i class="livicon" data-name="home" data-size="14" data-loop="true"></i>
                    Dashboard
                </a>
            </li>
            <li class='active'>Payment results</li>
        </ol>
    </section>
    <hr class="content-header-sep">
    <div class="container">
        <hr>
        <!-- Accordions Section End -->
        <div class="container">

            <!-- //Accordions Section End -->
            <div class="position-center">
                <form role="form" class="form-horizontal text-left" action="query.php" method="post"
                      name="query_paygate_form">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <div class="form-group">
                        <label for="TRANSACTION_STATUS" class="col-sm-3 control-label">Transaction Status</label>
                        <p id="TRANSACTION_STATUS" class="form-control-static"><?php
                            if ($transactionReceivedAl) {
                                echo "Membership has been updated";
                            } else {
                                if ($data['TRANSACTION_STATUS'] == 0 && $isValid) {
                                    //Transaction has been declined
                                    echo "Transaction was not done";
                                }
                                if ($data['TRANSACTION_STATUS'] == 1 && $isValid) {
                                    //Transaction has been approved
                                    //Insert the transaction result data into the database

                                    echo "Congratulations, your membership was successful. Check your email for details of the payment.";
                                }
                                if ($data['TRANSACTION_STATUS'] == 2 && $isValid) {
                                    //Transaction has been declined
                                    echo "Transaction has been declined.";
                                }
                                if ($data['TRANSACTION_STATUS'] == 5 && $isValid) {
                                    //Transaction has been declined
                                    echo "Membership has been received by PayGate.";
                                }

                                if (!$isValid) {
                                    echo "The results were discarded due to security issues. It looks like the data you received has been modified by an unauthorized entity.";
                                }
                            }

                            ?>
                        </p>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-offset-5 col-sm-2">
                            <a href="{{ route('subscribe', 'default') }}" style="color: #fff;"
                               class="btn btn-primary btn-block">Return to membership</a>
                        </div>
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
    <script type="text/javascript"
            src="{{ asset('assets/vendors/datetimepicker/js/bootstrap-datetimepicker.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/frontend/user_account.js') }}"></script>
    <script src="{{ asset('assets/vendors/bootstrapvalidator/js/bootstrapValidator.min.js') }}"
            type="text/javascript"></script>
    <script type="text/javascript" src="{{ asset('assets/js/frontend/user_subscribe.js') }}"></script>
@stop