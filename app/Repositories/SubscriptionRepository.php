<?php

namespace App\Repositories;

use App\Jobs\SubscriptionNewUserJob;
use App\Models\StripePackage;
use App\User;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
use Illuminate\Support\Facades\DB;
use Exception;
use Redirect;

class SubscriptionRepository extends AbsRepository
{
    public function subscription($package_id, $month_year, $stripe_token, $user = null, $voucher_number)
    {
        return $this->subscriptionStripPackage(
            (new StripePackageRepository)
                ->getByIdAndPeriod($package_id, $month_year),
            $stripe_token,
            $user,
            $voucher_number
        );
    }

    public function subscriptionStripPackage(StripePackage $stripPackage, $stripe_token, $user = null, $voucher_number)
    {
        assert(strlen($stripe_token) > 0);
        if (!$user) {
            $user = Sentinel::getUser();
        }

        if($voucher_number !==''){
            try{
        $user
            ->newSubscription(
                $stripPackage->package_name_stripe,
                $stripPackage->package_id_stripe
            )
            ->withCoupon($voucher_number)
            ->create($stripe_token);
            }catch(Exception $e ){
              //this is redirecting to a wrong page
               return Redirect::route('pay-package')->with('error', $e->getMessage());
            }

        }else{
            $user
            ->newSubscription(
                $stripPackage->package_name_stripe,
                $stripPackage->package_id_stripe
            )
            ->create($stripe_token);
        }


        /*
        //save the stripe token in the database
        $saveStripeToken = DB::table('users')
             ->where('id', $user->id)
             ->update(['stripe_id' => $_REQUEST['stripeToken']]);
        */

    }

    public function asyncSubscriptionByRequest($request, $user_id = null)
    {
        if (!$user_id) {
            $user_id = Sentinel::getUser()->id;
        }

        $requestFiltered = array_intersect_key(
            is_object($request)
                ? $request->all()
                : $request,
            array_flip([
                'packageid',
                'month_year',
                'stripeToken',
            ])
        );

        dispatch(new SubscriptionNewUserJob($requestFiltered, $user_id));
    }

    public function subscriptionByRequest($request, $user_id)
    {
        $user = User::findOrFail($user_id);

        $this->subscription(
            $request['packageid'],
            $request['month_year'],
            $request['stripeToken'],
            $user,
            $request['voucher_number']
        );

        $package = DB::table('packages')
            ->where('id', $request['packageid'])
            ->first();

        //the only fields that I need to fill in: sub_type, userid, sub_currencycode, quantity_admins, admins_avail, employees, employees_avail, support, packageid, pay_status, created_at
        $upadateSubscription = DB::table('dmmx_paysubscriptions')
            ->where('userid', $user->id)
            ->update([
                'pay_status' => 1,
                'employees_avail' => $package->terms_forms,
                'admins_avail' => $package->admins - 1,
                'packageid' => $package->id,
                'sub_type' => $request['month_year'],
                'AMOUNT' => $request['month_year'] ? $package->price : $package->monthly_price //$request['amount']
            ]);

        if (!$upadateSubscription) {
            error_log(__CLASS__ . ':' . __METHOD__ . " userid #{$user_id}  not exists in dmmx_paysubscriptions");
        }
    }
}
