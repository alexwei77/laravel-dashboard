<?php
namespace App\Http\Controllers;

use App\Repositories\SubscriptionRepository;
use App\User;

use Illuminate\Http\Request;
use Lang;
use Redirect;
use Stripe\Error\Card;
use Sentinel;
use View;
use Illuminate\Support\Facades\DB;
use Datatables;
use App\MyLibrary\PayGate_PayWeb31;
use App\Models\Package;
use Stripe;
use Jaybizzle\CrawlerDetect\CrawlerDetect;
use App\MyLibrary\Util;
use App\MyLibrary\GetIpLocale;
use Session;
use App;


class SubscriptionsController extends JoshController
{
    //

    public function pricesadd()
    {
        // Get all the available groups
        $groups = Sentinel::getRoleRepository()->all();

        $countries = $this->countries;
        // Show the page
        return view('admin.subscriptions.createcountry', compact('groups', 'countries'));
    }

    /*public function store()
     {
         // Get all the available groups
         $groups = Sentinel::getRoleRepository()->all();

         $countries = $this->countries;
         // Show the page
         return view('admin.subscriptions.createcountry', compact('groups', 'countries'));
     }*/

    /**
     * update user details and display
     * @param Request $request
     * @param User $user
     * @return Redirect
     */

    public function submitprices(Request $request)
    {
        //Get and process the recieved data
        $countrName = $request->get('country_name');
        $countryCode = $request->get('country_code');
        //This has bot been added in the table
        $currency = $request->get('currency');
        $currencyCode = $request->get('currency_code');

        $std_employees = $request->get('std_employees');
        $std_base = $request->get('std_base');
        $std_discount = $request->get('std_discount');
        $std_terms = $request->get('std_terms');
        $std_cost_employee = $request->get('std_cost_employee');
        $std_support = $request->get('std_support');
        $std_users = $request->get('std_users');
        $std_price = $request->get('std_price');

        $bn_employees = $request->get('bn_employees');
        $bn_base = $request->get('bn_base');
        $bn_discount = $request->get('bn_discount');
        $bn_terms = $request->get('bn_terms');
        $bn_employee_cost = $request->get('bn_employee_cost');
        $bn_support = $request->get('bn_support');
        $bn_users = $request->get('bn_users');
        $bn_price = $request->get('bn_price');

        $pro_employees = $request->get('pro_employees');
        $pro_base = $request->get('pro_base');
        $pro_discount = $request->get('pro_discount');
        $pro_terms = $request->get('pro_terms');
        $pro_employee_cost = $request->get('pro_employee_cost');
        $pro_support = $request->get('pro_support');
        $pro_users = $request->get('pro_users');
        $pro_price = $request->get('pro_price');

        $ent_employees = $request->get('ent_employees');
        $ent_base = $request->get('ent_base');
        $ent_discount = $request->get('ent_discount');
        $ent_terms = $request->get('ent_terms');
        $ent_employee_cost = $request->get('ent_employee_cost');
        $ent_support = $request->get('ent_support');
        $ent_users = $request->get('ent_users');
        $ent_price = $request->get('ent_price');

        $el_employees = $request->get('el_employees');
        $el_base = $request->get('el_base');
        $el_discount = $request->get('el_discount');
        $el_terms = $request->get('el_terms');
        $el_employee_cost = $request->get('el_employee_cost');
        $el_support = $request->get('el_support');
        $el_users = $request->get('el_users');
        $el_price = $request->get('el_price');

        /*$basicPrice = $request->get('basic_price');
        $standardPrice = $request->get('standard_price');
        $premiumPrice = $request->get('premium_price');*/
        $status = 'active'; //this is not stored in the table

        $insertRating = DB::table('dmmx_country_prices')->insert(
            ['country_name' => $countrName, 'country_code' => $countryCode, 'currency' => $currency, 'currency_code' => $currencyCode, 'std_employees' => $std_employees, 'std_base' => $std_base, 'std_discount' => $std_discount, 'status' => $status, 'std_base' => $std_base, 'std_terms' => $std_terms, 'std_cost_employee' => $std_cost_employee, 'std_support' => $std_support, 'std_users' => $std_users, 'bn_employees' => $bn_employees, 'bn_base' => $bn_base, 'bn_discount' => $bn_discount, 'bn_terms' => $bn_terms, 'bn_employee_cost' => $bn_employee_cost, 'bn_support' => $bn_support, 'bn_users' => $bn_users, 'pro_employees' => $pro_employees, 'pro_base' => $pro_base, 'pro_discount' => $pro_discount, 'pro_terms' => $pro_terms, 'pro_employee_cost' => $pro_employee_cost, 'pro_support' => $pro_support, 'pro_users' => $pro_users, 'ent_employees' => $ent_employees, 'ent_base' => $ent_base, 'ent_discount' => $ent_discount, 'ent_terms' => $ent_terms, 'ent_employee_cost' => $ent_employee_cost, 'ent_support' => $ent_support, 'ent_users' => $ent_users, 'el_employees' => $el_employees, 'el_base' => $el_base, 'el_discount' => $el_discount, 'el_terms' => $el_terms, 'el_employee_cost' => $el_employee_cost, 'el_support' => $el_support, 'el_users' => $el_users, 'std_price' => $std_price, 'bn_price' => $bn_price, 'pro_price' => $pro_price, 'ent_price' => $ent_price, 'el_price' => $el_price,]
        );

        // return Redirect::route('subscriptions/pricesadd'); //redirect to send invitations
        return redirect()->back();


    }

    public function countriesshow()
    {
        // Get all the available groups
        $groups = Sentinel::getRoleRepository()->all();

        $countries = $this->countries;
        // Show the page
        return view('admin.subscriptions.countrieslist', compact('groups', 'countries'));
    }

    public function allsubscriptions()
    {
        // Get all the available groups
        $groups = Sentinel::getRoleRepository()->all();

        $countries = $this->countries;
        // Show the page
        return view('admin.subscriptions.allsubscriptions', compact('groups', 'countries'));
    }


    //Countries data
    public function data()
    {
        //$users = User::get(['id', 'first_name', 'last_name', 'email','created_at']);
        $countryprices = DB::table('dmmx_country_prices')->get();

        return Datatables::of($countryprices)
            ->add_column('actions', function ($countryprice) {
                $actions = '<a href=' . route('admin.countries.show', $countryprice->id) . '><i class="livicon" data-name="info" data-size="18" data-loop="true" data-c="#428BCA" data-hc="#428BCA" title="view country"></i></a>
                            <a href=' . route('admin.countries.edit', $countryprice->id) . '><i class="livicon" data-name="edit" data-size="18" data-loop="true" data-c="#428BCA" data-hc="#428BCA" title="edit country"></i></a>';

                //if ((Sentinel::getUser()->id != $user->id) && ($user->id != 1)) {
                $actions .= '<a href=' . route('admin.countries.confirm-delete', $countryprice->id) . ' data-toggle="modal" data-target="#delete_confirm"><i class="livicon" data-name="user-remove" data-size="18" data-loop="true" data-c="#f56954" data-hc="#f56954" title="delete country"></i></a>';
                //}
                return $actions;
            })
            ->rawColumns(['actions'])
            ->make(true);
    }

    //Subscriptions data
    public function data1()
    {
        //$users = User::get(['id', 'first_name', 'last_name', 'email','created_at']);
        $allsubscriptions = DB::table('dmmx_account_subscriptions')->get(['id', 'account_type', 'account_email', 'account_name', 'account_users', 'subscribed_category', 'subscription_country', 'account_balance', 'contracts_quantity', 'PAYGATE_ID', 'PAY_REQUEST_ID', 'REFERENCE', 'encryptionKey', 'account_status', 'account_payment_status', 'created_at', 'updated_at']);

        return Datatables::of($allsubscriptions)
            ->add_column('actions', function ($subscription) {
                $actions = '<a href=' . route('admin.subscription.show', $subscription->id) . '><i class="livicon" data-name="info" data-size="18" data-loop="true" data-c="#428BCA" data-hc="#428BCA" title="view country"></i></a>
                            <a href=' . route('admin.subscription.edit', $subscription->id) . '><i class="livicon" data-name="edit" data-size="18" data-loop="true" data-c="#428BCA" data-hc="#428BCA" title="edit country"></i></a>';

                //if ((Sentinel::getUser()->id != $user->id) && ($user->id != 1)) {
                $actions .= '<a href=' . route('admin.subscriptions.confirm-delete', $subscription->id) . ' data-toggle="modal" data-target="#delete_confirm"><i class="livicon" data-name="user-remove" data-size="18" data-loop="true" data-c="#f56954" data-hc="#f56954" title="delete country"></i></a>';
                //}
                return $actions;
            })
            ->rawColumns(['actions'])
            ->make(true);
    }


    /**
     * Display specified user profile.
     *
     * @param  int $id
     * @return Response
     */
    public function show($id)
    {
        //get a particular country details
        $singlecountry = DB::table('dmmx_country_prices')->where('id', $id)->first();

        /*try {
            // Get the user information
            $user = Sentinel::findUserById($id);

            //get country name
            if ($user->country) {
                $user->country = $this->countries[$user->country];
            }

        } catch (UserNotFoundException $e) {
            // Prepare the error message
            $error = Lang::get('users/message.user_not_found', compact('id'));

            // Redirect to the user management page
            return Redirect::route('admin.users.index')->with('error', $error);
        }*/

        // Show the page
        return view('admin.countries.showcountry', compact('singlecountry'));

    }


    /**
     * Display specified user profile.
     *
     * @param  int $id
     * @return Response
     */
    public function showSubscription($id)
    {
        //get a particular country details
        $singleSubscription = DB::table('dmmx_account_subscriptions')->where('id', $id)->first();

        /*try {
            // Get the user information
            $user = Sentinel::findUserById($id);

            //get country name
            if ($user->country) {
                $user->country = $this->countries[$user->country];
            }

        } catch (UserNotFoundException $e) {
            // Prepare the error message
            $error = Lang::get('users/message.user_not_found', compact('id'));

            // Redirect to the user management page
            return Redirect::route('admin.users.index')->with('error', $error);
        }*/

        // Show the page
        return view('admin.subscriptions.showSubscription', compact('singleSubscription'));

    }


    //edit the country/prices

    /**
     * User update.
     *
     * @param  int $id
     * @return View
     */
    public function edit($id)
    {
        $singlecountryedit = DB::table('dmmx_country_prices')->where('id', $id)->first();
        // Get this user groups
        //$userRoles = $user->getRoles()->pluck('name', 'id')->all();

        // Get a list of all the available groups
        // $roles = Sentinel::getRoleRepository()->all();

        //$status = Activation::completed($user);

        // $countries = $this->countries;

        // Show the page
        return view('admin.countries.countryedit', compact('singlecountryedit', 'id'));
    }

    //edit the country/prices

    /**
     * User update.
     *
     * @param  int $id
     * @return View
     */
    public function edit1($id)
    {
        $singlesubscriptionedit = DB::table('dmmx_account_subscriptions')->where('id', $id)->first();
        // Get this user groups
        //$userRoles = $user->getRoles()->pluck('name', 'id')->all();

        // Get a list of all the available groups
        // $roles = Sentinel::getRoleRepository()->all();

        //$status = Activation::completed($user);

        // $countries = $this->countries;

        // Show the page
        return view('admin.subscriptions.subscriptionedit', compact('singlesubscriptionedit', 'id'));
    }

    //submit edited country
    //edit the country/prices
    /**
     * User update.
     *
     * @param  int $id
     * @return View
     */
    public function submitSubscriptionEdit(Request $request)
    {
        DB::table('dmmx_account_subscriptions')
            ->where('id', $request->get('id'))
            ->update(['account_type' => $request->get('account_type'), 'account_email' => $request->get('account_email'), 'account_name' => $request->get('account_name'), 'account_users' => $request->get('account_users'), 'subscribed_category' => $request->get('subscribed_category'), 'subscription_country' => $request->get('subscription_country'), 'account_balance' => $request->get('account_balance'), 'contracts_quantity' => $request->get('contracts_quantity'), 'REFERENCE' => $request->get('REFERENCE'), 'account_status' => $request->get('account_status'), 'account_payment_status' => $request->get('account_payment_status')]);

        return redirect()->back()->with('success', 'Subscription successfuly updated.');;
    }

    //submit edited country
    //edit the country/prices
    /**
     * User update.
     *
     * @param  int $id
     * @return View
     */
    public function submitedit(Request $request)
    {
        DB::table('dmmx_country_prices')
            ->where('id', $request->get('id'))
            ->update(['country_name' => $request->get('country_name'), 'country_code' => $request->get('country_code'), 'currency' => $request->get('currency'), 'country_code' => $request->get('country_code'), 'basic_price' => $request->get('basic_price'), 'standard_price' => $request->get('standard_price'), 'premium_price' => $request->get('premium_price'), 'status' => $request->get('status')]);

        return redirect()->back()->with('success', 'Country successfuly updated.');;
    }


    /**
     * Delete confirmation for the given group.
     *
     * @param  int $id
     * @return View
     */
    public function getModalDelete($id)
    {
        $model = 'groups';
        $confirm_route = $error = null;
        try {
            // Get group information
            // $role = Sentinel::findRoleById($id);


            $confirm_route = route('admin.subscriptions.delete', $id);
            return view('admin.layouts.modal_countrydelete', compact('id', 'error', 'model', 'confirm_route'));
        } catch (GroupNotFoundException $e) {

            $error = Lang::get('admin/groups/message.group_not_found', compact('id'));
            return view('admin.layouts.modal_countrydelete', compact('error', 'model', 'confirm_route'));
        }
    }

    /**
     * Delete confirmation for the given group.
     *
     * @param  int $id
     * @return View
     */
    public function getModalDelete1($id)
    {
        $model = 'groups';
        $confirm_route = $error = null;
        try {
            // Get group information
            // $role = Sentinel::findRoleById($id);


            $confirm_route = route('admin.singlesubscription.delete', $id);
            return view('admin.layouts.modal_subscriptiondelete', compact('id', 'error', 'model', 'confirm_route'));
        } catch (GroupNotFoundException $e) {

            $error = Lang::get('admin/groups/message.group_not_found', compact('id'));
            return view('admin.layouts.modal_subscriptiondelete.blade', compact('error', 'model', 'confirm_route'));
        }
    }

    /**
     * Delete the given group.
     *
     * @param  int $id
     * @return Redirect
     */
    public function destroy($id = null)
    {
        try {
            // Get group information
            //$role = Sentinel::findRoleById($id);

            // Delete the group
            //$role->delete();
            DB::table('dmmx_country_prices')->where('id', '=', $id)->delete();

            // Redirect to the group management page
            //return Redirect::route('admin.allcountries')->with('success', Lang::get('groups/message.success.delete'));
            return redirect()->back()->with('success', 'Country was successfully deleted.');
        } catch (GroupNotFoundException $e) {
            // Redirect to the group management page
            //return Redirect::route('admin.groups')->with('error', Lang::get('groups/message.group_not_found', compact('id')));
            return redirect()->back()->with('error', 'Country delete failed');
        }
    }

    /**
     * Delete the given subscription.
     *
     * @param  int $id
     * @return Redirect
     */
    public function destroy1($id = null)
    {
        try {
            // Get group information
            //$role = Sentinel::findRoleById($id);

            // Delete the group
            //$role->delete();
            DB::table('dmmx_account_subscriptions')->where('id', '=', $id)->delete();

            // Redirect to the group management page
            //return Redirect::route('admin.allcountries')->with('success', Lang::get('groups/message.success.delete'));
            return redirect()->back()->with('success', 'Subscription was successfully deleted.');
        } catch (GroupNotFoundException $e) {
            // Redirect to the group management page
            //return Redirect::route('admin.groups')->with('error', Lang::get('groups/message.group_not_found', compact('id')));
            return redirect()->back()->with('error', 'Subscription delete failed');
        }
    }

    public function curl_request_swap($customer, $subscription, $subscription_plan)
    {
        $apiKey = "sk_test_2vUdWcST87aHIL9bfpYjH22T";
        $curl = curl_init();
        $query = http_build_query(array(
            "customer" => $customer,
            "subscription" => $subscription,
            "subscription_plan" => $subscription_plan
        ));
        curl_setopt_array($curl, array(
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_URL => "https://api.stripe.com/v1/invoices/upcoming?" . $query,
            CURLOPT_HTTPHEADER => array("Authorization: Bearer " . $apiKey),
        ));
        $get_switch_cost = curl_exec($curl);
        curl_close($curl);
        return $get_switch_cost;
    }

    public function getUpgradeDowngrade()
    {
        $user = Sentinel::getUser();
        if (count($user->subscriptions)==0) {
            return redirect()->back()->with('error', 'This is a premium feature');
        }
        //Get packages prices
        $countryPrices = DB::table('dmmx_country_prices')->get();
        //get all the currency codes
        $currencyInfo = DB::table('currency')->get();

        return view('upgradedowngrade', compact('user', 'currencyInfo', 'countryPrices'));
        //return view('upgradedowngrade');
    }

    public function getPackages()
    {
        return view('admin.packages');
    }

    public function postPackages()
    {
        $insertPackage = DB::table('packages')->insert(
            ['name' => $_REQUEST['subname'], 'price' => $_REQUEST['price'], 'terms_forms' => $_REQUEST['terms'], 'cost_per_employee' => $_REQUEST['costemployee'], 'support' => $_REQUEST['support'], 'admins' => $_REQUEST['admins']]
        );
        if ($insertPackage) {
            return redirect()->back()->with('success', 'Package added');
        }
    }

    public function upgradedowngrade()
    {

        //If the package status is full amount, pay now must be full amount
        $user = Sentinel::getUser();
        //get period chosen
        $periodChosen = $_REQUEST['periodChosen'];
        //get package chosen
        $packageChosen = $_REQUEST['packageChosen'] + 1;

        //get the user package information (remember only the admin can do the package subscriptions)
        $getUserPackage = DB::table('dmmx_paysubscriptions')->where('userid', $user->id)->first();

        //calculate the value worth of the current package
        $subscriptionType = $getUserPackage->sub_type;
        $packageId = $getUserPackage->packageid;

        $thePackage = DB::table('packages')->where('id', $packageId)->first();

        $todayDate = date('Y-m-d');
        $maxDays = date('t');
        $month = (int)ltrim(date('m'));
        $currentDayOfMonth = date('j');

        //check if there is subscription update date, if there, use it instead
        $dateToUse = '';
        if (($getUserPackage->updated_at)) {
            $dateToUse = $getUserPackage->updated_at;
        } else {
            $dateToUse = $getUserPackage->created_at;
        }

        $timestamp = strtotime($dateToUse);

        list($old_year, $old_month, $old_day) = explode('-', date('Y-m-d', $timestamp));
        list($now_year, $now_month, $now_day) = explode('-', date('Y-m-d'));

        $months_ago = 12 * ($now_year - $old_year) + $now_month - $old_month;
        if ($old_month < $now_month && $old_day < $now_day) {
            ++$months_ago;
        }

        $currentMonth = $months_ago;//this is calculated based on the subscription date
        $remainigMonths = 10 - $currentMonth;

        //if()

        $remainingMonthlyDays = $maxDays - $currentDayOfMonth;
        $creditValue = 0;
        $amountDue = 0;
        $packageYearlyCost = 0;
        $packageMonthlyCost = 0;
        $amountRefund = 0;
        $remainingAmount = 0;
        $packageRow = DB::table('packages')->where('id', $packageChosen)->first();
        $monthlyDailyWorth = ($packageRow->price) / $maxDays; //for chosen package

        if ($subscriptionType == 0) {//its a monthly subscription
            if ($periodChosen == 0) { //month to month
                //Get the monetary worth of the current package
                $packageMonthlyCost = $packageRow->price;
                $creditValue = $remainingMonthlyDays * (($thePackage->price) / $maxDays);
                $amountRefund = $creditValue;

                // $thisMonthPending = $remainingMonthlyDays*(($packageRow->price)/$remainingMonthlyDays);
                $amountDue = $packageMonthlyCost - ($monthlyDailyWorth * $currentDayOfMonth);

                if ($getUserPackage->pay_status == 0) {
                    $amountRefund = 0;
                    $creditValue = 0;
                    $amountDue = $packageMonthlyCost;
                }
            }
            if ($periodChosen == 1) { //month to year
                //Get the monetary worth of the current package
                $packageYearlyCost = ($packageRow->price) * 10;
                $creditValue = $remainingMonthlyDays * (($thePackage->price) / $maxDays);
                $amountRefund = $creditValue;
                //$thisMonthPending = $remainingMonthlyDays*(($packageRow->price)/$remainingMonthlyDays);
                $amountDue = $packageYearlyCost - ($monthlyDailyWorth * $currentDayOfMonth);

                if ($getUserPackage->pay_status == 0) {
                    $amountRefund = 0;
                    $creditValue = 0;
                    $amountDue = $packageYearlyCost;
                }
            }
        }

        if ($subscriptionType == 1) {//its a yearly subscription
            if ($periodChosen == 0) { //year to month
                //Get the monetary worth of the current package
                $packageMonthlyCost = $packageRow->price;
                $packageYearlyCost = ($packageRow->price) * 10;
                if ($months_ago < 10) { //remember the last two months are free, hence not counted in the calculation
                    $thisMonthCredit = $remainingMonthlyDays * (($thePackage->price) / $maxDays);
                    $creditValue = ($remainigMonths) * ($thePackage->price) + $thisMonthCredit;
                } else {
                    $creditValue = 0;
                }
                $amountRefund = $creditValue;
                $remainingAmount = $amountRefund - ($packageMonthlyCost - ($remainingMonthlyDays * $monthlyDailyWorth));
                $amountDue = $packageMonthlyCost - ($monthlyDailyWorth * $currentDayOfMonth);

                if ($getUserPackage->pay_status == 0) {
                    $amountRefund = 0;
                    $creditValue = 0;
                    $amountDue = $packageMonthlyCost;
                }

            }

            if ($periodChosen == 1) { //year to year
                //Get the monetary worth of the current package
                $packageYearlyCost = ($packageRow->price) * 10;
                if ($months_ago < 10) { //remember the last two months are free, hence not counted in the calculation
                    $thisMonthCredit = $remainingMonthlyDays * (($thePackage->price) / $maxDays);
                    $creditValue = ($remainigMonths) * ($thePackage->price) + $thisMonthCredit;
                } else {
                    $creditValue = 0;
                }
                $amountRefund = $creditValue;
                $remainingAmount = $amountRefund - $packageYearlyCost;
                $amountDue = $packageYearlyCost - ($monthlyDailyWorth * $currentDayOfMonth);

                if ($getUserPackage->pay_status == 0) {
                    $amountRefund = 0;
                    $creditValue = 0;
                    $amountDue = $packageYearlyCost;
                }
            }
        }
        //calculate additional amount to be paid
        $additionalAmountPay = 0;
        if ($amountRefund < $amountDue) {
            $additionalAmountPay = $amountDue - $amountRefund;
        }


        //get stripe customer's details
        $stripe_package = DB::table('stripe_packages')->where([['package_id_local', $packageRow->id], ['package_period', $periodChosen]])->first();
        $customerInformation = $user->asStripeCustomer();
        $customer = $customerInformation->subscriptions->data['0']->customer;
        $subscription = $customerInformation->subscriptions->data['0']->id;
        $subscription_plan = $stripe_package->package_id_stripe;
        $swap_cost = $this->curl_request_swap($customer, $subscription, $subscription_plan);
        $Invoice_object = json_decode($swap_cost, true);
        $amountDue = $Invoice_object['amount_due'] / 100;
        //Calculate balance that will remain after the transaction
        $arrayUpDown = ['amountrefund' => number_format((float)$amountRefund, 2, '.', ''), 'amountdue' => $amountDue, 'additionalAmount' => number_format((float)$additionalAmountPay, 2, '.', '')];

        //Storing the chosen package data in a session variable

        return json_encode($arrayUpDown);
    }


    public function add_subscription_history()
    {
        $user = Sentinel::getUser();
        //get user current subscription package
        $getUserPackage = DB::table('dmmx_paysubscriptions')->where('userid', $user->id)->first();
        $insertSubscription_history = DB::table('dmmx_paysubscriptions_history')->insert(['sub_type' => $getUserPackage->sub_type, 'userid' => $getUserPackage->userid, 'REFERENCE' => $getUserPackage->REFERENCE, 'TRANSACTION_STATUS' => $getUserPackage->TRANSACTION_STATUS, 'RESULT_CODE' => $getUserPackage->RESULT_CODE, 'AUTH_CODE' => $getUserPackage->AUTH_CODE, 'AMOUNT' => $getUserPackage->AMOUNT, 'RESULT_DESC' => $getUserPackage->RESULT_DESC, 'TRANSACTION_ID' => $getUserPackage->TRANSACTION_ID, 'SUBSCRIPTION_ID' => $getUserPackage->SUBSCRIPTION_ID, 'RISK_INDICATOR' => $getUserPackage->RISK_INDICATOR, 'sub_countrcode' => $getUserPackage->sub_countrcode, 'sub_currencycode' => $getUserPackage->sub_currencycode, 'quantity_admins' => $getUserPackage->quantity_admins, 'admins_avail' => $getUserPackage->admins_avail, 'employees' => $getUserPackage->employees, 'employees_avail' => $getUserPackage->employees_avail, 'base' => $getUserPackage->base, 'terms' => $getUserPackage->terms, 'support' => $getUserPackage->support, 'TRANSACTION_DATE' => $getUserPackage->TRANSACTION_DATE, 'SUBS_START_DATE' => $getUserPackage->SUBS_START_DATE, 'SUBS_END_DATE' => $getUserPackage->SUBS_END_DATE, 'SUBS_FREQUENCY' => $getUserPackage->SUBS_FREQUENCY, 'PROCESS_NOW_AMOUNT' => $getUserPackage->PROCESS_NOW_AMOUNT, 'updowngrade_amount' => $getUserPackage->updowngrade_amount, 'packageid' => $getUserPackage->packageid, 'created_at' => date('Y-m-d H:i:s')]);
        return $insertSubscription_history;
    }

    public function updateSubscription($TRANSACTION_DATE, $SUBS_START_DATE, $PROCESS_NOW_AMOUNT, $packages, $period, $packageChosen)
    {
        $user = Sentinel::getUser();
        $transactionEndDate = date('Y-m-d', strtotime('+1 years'));
        $getPackageChosen = DB::table('packages')->where('id', $packages + 1)->first();
        $getUserPackage = DB::table('dmmx_paysubscriptions')->where('userid', $user->id)->first();
        $updatePackage = DB::table('dmmx_paysubscriptions')->where('REFERENCE', $getUserPackage->REFERENCE)->update(['sub_type' => $period, 'AMOUNT' => '', 'quantity_admins' => $packageChosen->admins, 'admins_avail' => $packageChosen->admins, 'employees' => $packageChosen->terms_forms, 'employees_avail' => $packageChosen->terms_forms, 'base' => '', 'terms' => $packageChosen->terms_forms, 'support' => $packageChosen->support, 'TRANSACTION_DATE' => $TRANSACTION_DATE, 'SUBS_START_DATE' => $SUBS_START_DATE, 'SUBS_END_DATE' => $transactionEndDate, 'SUBS_FREQUENCY' => $getUserPackage->SUBS_FREQUENCY, 'PROCESS_NOW_AMOUNT' => $PROCESS_NOW_AMOUNT, 'updowngrade_amount' => $PROCESS_NOW_AMOUNT, 'packageid' => $packages + 1, 'created_at' => date('Y-m-d H:i:s')]);

        return $updatePackage;
    }

    public function upgradedowngradesubmit(Request $request)
    {
        //echo round($_REQUEST['PROCESS_NOW_AMOUNT']);
        $user = Sentinel::getUser();

        //test that that the switch is done well
        $userStripePackage = DB::table('subscriptions')->where('user_id', $user->id)->first();

        //get user current subscription package
        $getUserPackage = DB::table('dmmx_paysubscriptions')->where('userid', $user->id)->first();

        /*print_r($getUserPackage);
        die;*/

        //get the chosen plan
        $packageIdStripeTable = ($request->packages) + 1;
        $packagePeriodStripeTable = $request->period;
        $wishPlan = DB::table('stripe_packages')->where([['package_id_local', $packageIdStripeTable], ['package_period', $packagePeriodStripeTable]])->first();

        $wishPlanLocal = DB::table('packages')->where('id', $wishPlan->package_id_local)->first();

        //cehck if the number of employees and admins available is accommodate by the chosen plan
        //get active employees and admins
        $activeEmployees = DB::table('dmmx_employees_watch')->where([['companyid', $user->id], ['watchstatus', 'Active']])->get();
        $activeAdmins = DB::table('dmmx_admins_table')->where([['userid', $user->id], ['status', 'Active']])->get();

        if (count($activeEmployees) > $wishPlanLocal->terms_forms) {
            return Redirect::back()->with('error', 'Please disable some of your employees as they cannot be accommodated by your chosen package.');
        }
        if (count($activeAdmins) > $wishPlanLocal->admins) {
            return Redirect::back()->with('error', 'Please disable some of your admins as they cannot be accommodated by your chosen package.');
        }

        //if the user is not subscriped to any package, let them know
        if (!$userStripePackage) {

            $avialbleEmployees = ($wishPlanLocal->terms_forms) - count($activeEmployees);
            $availableAdmins = ($wishPlanLocal->admins) - count($activeAdmins);

            //change the subscription package in paysubs
            if ($request->period == 0) {
                $upadateSubscription = DB::table('dmmx_paysubscriptions')->where('userid', $user->id)->update(['sub_type' => $packagePeriodStripeTable, 'packageid' => $packageIdStripeTable, 'pay_status' => 0, 'employees_avail' => $avialbleEmployees, 'admins_avail' => $availableAdmins - 1, 'AMOUNT' => $wishPlanLocal->monthly_price]);
            } else {
                $upadateSubscription = DB::table('dmmx_paysubscriptions')->where('userid', $user->id)->update(['sub_type' => $packagePeriodStripeTable, 'packageid' => $packageIdStripeTable, 'pay_status' => 0, 'employees_avail' => $avialbleEmployees, 'admins_avail' => $availableAdmins - 1, 'AMOUNT' => ($wishPlanLocal->price) * 12]);
            } 

            return Redirect::back()->with('error', 'You package has been changed but we need your card details before it can be active');
        }

        $createSwap = $user->subscription($userStripePackage->name)->swap($wishPlan->package_id_stripe);

        //update the employees and admins limit. Adjust the number of employees and admins available. Update the packgage details as well
        $avialbleEmployees = ($wishPlanLocal->terms_forms) - count($activeEmployees);
        $availableAdmins = ($wishPlanLocal->admins) - count($activeAdmins);
        if ($createSwap) {
            //if package is monthly
            if ($packagePeriodStripeTable == 0) {
                $upadateSubscription = DB::table('dmmx_paysubscriptions')->where('userid', $user->id)->update(['sub_type' => $packagePeriodStripeTable, 'packageid' => $packageIdStripeTable, 'pay_status' => 1, 'employees_avail' => $avialbleEmployees, 'admins_avail' => $availableAdmins - 1, 'AMOUNT' => $wishPlanLocal->monthly_price]);
            } else {
                $upadateSubscription = DB::table('dmmx_paysubscriptions')->where('userid', $user->id)->update(['sub_type' => $packagePeriodStripeTable, 'packageid' => $packageIdStripeTable, 'pay_status' => 1, 'employees_avail' => $avialbleEmployees, 'admins_avail' => $availableAdmins - 1, 'AMOUNT' => ($wishPlanLocal->price) * 12]);
            }

            if ($upadateSubscription) {
                return Redirect::back()->with('success', 'Package updated successfully');
            }
        }


        //package chosen
        $packageIdChosen = $_REQUEST['packages']+1;
        //period chosen
        $periodChosenId = $_REQUEST['period'];

        //get package chosen
        $getPackageChosen = DB::table('packages')->where('id', $packageIdChosen)->first();

        if (round($_REQUEST['PROCESS_NOW_AMOUNT']) == 0) {
            //save a copy of the historical data
            /*$insertintoHistory = $this->add_subscription_history();

             $updateSubscription = $this->updateSubscription($_REQUEST['TRANSACTION_DATE'],$_REQUEST['SUBS_START_DATE'],$_REQUEST['PROCESS_NOW_AMOUNT'],$_REQUEST['packages'],$_REQUEST['period'], $getPackageChosen);

             if($updateSubscription){
             return redirect()->back()->with('success','Subscription downgrade has been done');
             }*/

            //check if the record exists or not
            $recordCheck = DB::table('downgrade_requests')->where([['userid', $user->id], ['packageid', $packageIdChosen], ['status', 1]])->first();
            if (!$recordCheck) {
                //Determine trigger date
                $triggerDate = '';
                if ($getUserPackage->SUBS_START_DATE == $getUserPackage->SUBS_END_DATE) {
                    //Add 12 months to the subscription date
                    $triggerDate = strtotime("+12 months", strtotime($getUserPackage->SUBS_START_DATE));
                } else {
                    //trigger day is on the ifrst of the following month
                    $triggerDate = date('Y-m-d', strtotime('first day of next month'));
                }

                $insertRequest = DB::table('downgrade_requests')->insert(
                    ['userid' => $user->id, 'packageid' => $packageIdChosen, 'subscriptionid' => $getUserPackage->id, 'trigger_date' => $triggerDate, 'status' => 1, 'created_at' => date('Y-m-d')]
                );

                if ($insertRequest) {
                    return Redirect::back()->with('error', 'Sorry. You can only downgrade your current package once it reaches its expiry date. We will inform you by email when the date comes');
                }

            } else {
                return Redirect::back()->with('error', 'Sorry. You have already made this downgrade request');
            }


        } elseif (round($_REQUEST['PROCESS_NOW_AMOUNT']) > 0) {
            /*$insertintoHistory = $this->add_subscription_history(); //do this only when the payment result is 1
            $updateSubscription = $this->updateSubscription($_REQUEST['TRANSACTION_DATE'],$_REQUEST['SUBS_START_DATE'],$_REQUEST['PROCESS_NOW_AMOUNT'],$_REQUEST['packages'],$_REQUEST['period'], $getPackageChosen);
            if($updateSubscription){
             return redirect()->back()->with('success','Subscription upgrade has been done');
             }*/

            $subdata = array();
            $subdata1 = array();

            $encryption_key = 'secret';
            $transactionEndDate = date('Y-m-d', strtotime('+1 years'));
            if ($request->get('period') == 0) {
                $subdata = array(
                    'category' => $request->get('packages'),
                    'PAYGATE_ID' => $request->get('PAYGATE_ID'),
                    'REFERENCE' => $getUserPackage->REFERENCE,
                    'AMOUNT' => $getPackageChosen->price,
                    'CURRENCY' => "ZAR", //the currency needs to be in ZAR
                    'RETURN_URL' => $request->get('RETURN_URL'),
                    'TRANSACTION_DATE' => $request->get('TRANSACTION_DATE'),
                    'SUBS_START_DATE' => $request->get('SUBS_START_DATE'),
                    'SUBS_FREQUENCY' => '229',
                    'SUBS_END_DATE' => $transactionEndDate,
                    'PROCESS_NOW' => $request->get('PROCESS_NOW'),
                    'VERSION' => $request->get('VERSION'),
                    'PROCESS_NOW_AMOUNT' => $request->get('PROCESS_NOW_AMOUNT'),
                    'LOCALE' => $request->get('LOCALE'),
                    'COUNTRY' => $request->get('COUNTRY'),
                    //'email'    => $request->get('email'),
                    'standard_category' => $request->get('period'),
                    'sub_countryid' => $request->get('COUNTRY'),
                    'user' => $user->id,
                    'subperiod' => $request->get('period'),
                );

                return view('requestpayment', compact('subdata', 'user', 'subdata1', 'getPackageChosen', 'getUserPackage'));
            } else {

                $mandatoryFields1 = array(
                    'PAYGATE_ID' => $request->get('PAYGATE_ID'),
                    'REFERENCE' => $request->get('REFERENCE'),
                    'AMOUNT' => $request->get('PROCESS_NOW_AMOUNT'), //cehck if the amount reeived is valid
                    'CURRENCY' => $request->get('CURRENCY'),
                    'RETURN_URL' => $request->get('RETURN_URL'),  //."/" .$subdata['category'] ."/" .$subdata['contractsQuantity']
                    'TRANSACTION_DATE' => $request->get('TRANSACTION_DATE'),
                    //'EMAIL'             => "customer@mywebsite.com", //if not given it will be requested in the pages
                    'LOCALE' => 'en-za',
                    'COUNTRY' => $request->get('COUNTRY'),
                    'EMAIL' => $user->email,
                );


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

                $PayWeb31 = new PayGate_PayWeb31();

                $PayWeb31->setEncryptionKey($encryption_key);

                $PayWeb31->setInitiateRequest($data1);

                $theChecksum1 = $PayWeb31->generateChecksum($data1);

                $subdata1 = array(
                    'category' => $request->get('period'),
                    'PAYGATE_ID' => $request->get('PAYGATE_ID'),
                    'REFERENCE' => $getUserPackage->REFERENCE,
                    'AMOUNT' => $request->get('PROCESS_NOW_AMOUNT'),
                    'CURRENCY' => $request->get('CURRENCY'),
                    'RETURN_URL' => $request->get('RETURN_URL'),
                    'TRANSACTION_DATE' => $request->get('TRANSACTION_DATE'),
                    'LOCALE' => $request->get('LOCALE'),
                    'COUNTRY' => $request->get('COUNTRY'),
                    'EMAIL' => 'dev14@dmm.co.za',
                    'CHECKSUM' => $theChecksum1,
                    'standard_category' => $request->get('packages'),
                    'sub_countryid' => $request->get('COUNTRY'),
                    'user' => $user->id,
                    'subperiod' => $request->get('period'),
                );

                return view('requestpayment', compact('subdata1', 'user', 'subdata', 'getPackageChosen', 'getUserPackage'));
            }


        } else {
            return redirect()->back()->with('error', 'Technical error has occurred');
        }


        ////Pay now equals zero situation
        //Insert the record in the table as a new record and update the users subscription status

    }

    public function saveStripeToken(Request $request)
    {

        // "stripeTokenType" => "card"
        // "stripeEmail" => "aa@aa.aa"

        try {
            (new SubscriptionRepository())
                ->asyncSubscriptionByRequest($request);
        } catch (\Exception $e) {
            return redirect()->back()
                ->with(
                    'error',
                    $e instanceof Card
                        ? $e->getMessage()
                        : 'Technical error has occured'
                );
        }

        /*

        //redirect to the dashboard with subscription status saying successful

        $adminRow = DB::table('dmmx_admins_table')
            ->where('email', $user->email)
            ->where('status', 'Active')
            ->first();

        / *
        $checkIfEmployee = DB::table('dmmx_employees')
            ->where('email', $user->email)
            ->get();
        $checkifHasPackage = DB::table('dmmx_paysubscriptions')
            ->where('userid', $user->id)
           ->get();

        //if neither employee nor admin, direct to the pay pages
        if (!$adminRow && count($checkIfEmployee) == 0 && count($checkifHasPackage) == 0) {
            //log the user out
            Sentinel::logout();
            //redirect to the pay pages
            return redirect('pricing')
                ->with('error', 'Please choose a subscription package below.');
        }* /

        if ($adminRow) {
            $user = DB::table('users')
                ->where('id', $adminRow->userid)
                ->first();
        }

        $idsWatchedArray = DB::table('dmmx_employees_watch')
            ->where('companyid', $user->id)
            ->get()
            ->map(function ($singleid) {
                return $singleid->employeeid;
            })
            ->all();

        $subscriptionPackageDAta = DB::table('dmmx_paysubscriptions')
            ->where('userid', $user->id)
            ->first();

        //$monetaryvalue = DB::table('dmmx_account_subscriptions')
        //  ->where('account_users',$user->id )
        //  ->sum('account_balance');


        //Ratings to plot
        $ratings2Plot = DB::table('daily_employees_quantity')
            ->where('userid', $user->id)
            ->take(30)
            ->get();

            $employeesWatchedList = DB::table('dmmx_employees')->whereIn('idnumber', $idsWatchedArray)->get()->take(4);

            $subData = array(
                'packageid' => $_REQUEST['packageid'],
                'packagename' => $_REQUEST['packagename'],
                'amount' => $_REQUEST['amount'],
                'transactionid' => $_REQUEST['stripeToken']
            );

        return view('dashboard', compact('user', 'employeesWatchedList', 'subscriptionPackageDAta', 'ratings2Plot', 'subData'))
                ->with('success', 'Subscription successfully created');

         */
        return redirect('dashboard');
    }

    public function cancelSubscriptions()
    {
        //echo "cancel subscription";
        $user = Sentinel::getUser();

        //get the user's subscription package
        $subscription = DB::table('subscriptions')->where('user_id', $user->id)->first();
        $cancelSubscription = $user->subscription($subscription->name)->cancel();

        if ($cancelSubscription) {
            return redirect()->back()->with('success', 'Package has been cancelled but the cancellation will only become effective at the end of your billing period. You can always come here to resume your subscription');
        }
    }

    public function crawlerCheck()
    {
        $CrawlerDetect = new CrawlerDetect;
        $crawlerCheck = $CrawlerDetect->isCrawler();
        return $crawlerCheck;
    }

    public function partOfOurLocales($string)
    {
        return in_array($string, ["en", "au", "ca", "ie", "nz", "za", "uk", "us"]);
    }

    public function GetIpLocale()
    {

        $ip2location = new GetIpLocale();

        $returned_locale = $ip2location->get_locale();

        return $returned_locale;

    }

    public function payPackage($lang = null)
    {
        //echo "pay subscription";
        //get the user's pay_subscriptions row
        $util = new Util();
        $ip_locale = $this->GetIpLocale();

        if ($lang) {
            session(['custom_lang' => $lang]);
            //set the locale
            App::setLocale($lang);
        } else {
            session(['custom_lang' => '']);
        }

        if (!Session::has('nav_section')) {
            Session::put('nav_section', 'business');
        }

        if (!$this->crawlerCheck() && !$this->partOfOurLocales($lang)) {
            //die;

            if (!$this->partOfOurLocales($lang)) {// if the set language is not in our languages, redirect to international

                if ($lang == "gb") {
                    return $util->moddedRedirect('uk/business/pay-package');
                }
                return $util->moddedRedirect($ip_locale . '/business/pay-package');
            }

            return $util->moddedRedirect($ip_locale . '/business/pay-package');
        }

        $user = Sentinel::getUser();
        $userPayRow = DB::table('dmmx_paysubscriptions')->where('userid', $user->id)->first();

        //get the package user is on
        $localPackage = DB::table('packages')->where('id', $userPayRow->packageid)->first();

        return view('paypackage', compact('user', 'userPayRow', 'localPackage'));
    }

    public function payPackageReturn(Request $request)
    {

        //check if coupon specified
        if(isset($request->voucher_number)){
            try{
                ///Stripe\Coupon::setApiKey(env('STRIPE_KEY'));
                Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
                Stripe\Coupon::retrieve($request->voucher_number);
            }catch(\Exception $e){
               return Redirect::back()->with('error',$e->getMessage());
            }
        }


        try {
            (new SubscriptionRepository())
                ->subscriptionByRequest($request, Sentinel::getUser()->id);
        } catch (\Exception $e) {
            if (env('APP_DEBUG')) {
                throw $e;
            }
            return redirect()->back()
                ->with(
                    'error',
                    $e instanceof Card
                        ? $e->getMessage()
                        : 'Technical error has occured'
                );
        }

        return redirect('upgrade-downgrade')
            ->with('success', 'Payment successful');
    }

    public function packages(){
         $packages = Package::all();
         return Datatables::of($packages)
            ->add_column('actions', function ($package) {
                $actions = '<a href=' . route('admin.packages.edit', $package->id) . '><i class="livicon" data-name="edit" data-size="18" data-loop="true" data-c="#428BCA" data-hc="#428BCA" title="update package"></i></a>';
                return $actions;
            })
            ->rawColumns(['actions'])
            ->make(true);

    }

    public function editPackages($packageid = null){
        $packageData = Package::where('id', $packageid);
        // Show the page
        return view('admin.packages.edit', compact('packageData'));
    }
}
