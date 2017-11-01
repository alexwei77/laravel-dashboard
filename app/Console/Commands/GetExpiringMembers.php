<?php

namespace App\Console\Commands;

use App;
use App\User;
use Illuminate\Console\Command;
use DB;
use Carbon\Carbon;

class GetExpiringMembers extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'GetExpiringMembers:walkingdead';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Currently just dumps out a list of expiring members. WIll flesh this out as the specs become available';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $users = User::all();
        foreach($users as $user) {
            if($user->id > 1) {
                // get user package
                $getUserPackage = DB::table('dmmx_paysubscriptions')->where('userid', $user->id)->first();
                // var_dump(get_class($getUserPackage));
                $packageId = $getUserPackage->packageid;
                // $packageId = 1;

                // get package name from package_id. See https://laravel.com/docs/5.4/billing#checking-subscription-status for details
                $thePackage = DB::table('packages')->where('id', $packageId)->first();

                $packageName = $thePackage->name;
                // echo $packageName;

                \Stripe\Stripe::setApiKey(env('STRIPE_SECRET', 'sk_test_2vUdWcST87aHIL9bfpYjH22T'));

                $response = \Stripe\Subscription::all(array('limit'=>1));

                // die(var_dump($response));

                $billing_end_cycle = $response['data'][0]->current_period_end;

                if(env('APP_ENV') !== 'prod') {
                    $billing_end_cycle -= 730 * 24 * 60 * 60; // let's go back two years just to test
                }

                $current_timestamp = time();

               //  die(var_dump($current_timestamp));

                if ($billing_end_cycle < $current_timestamp) {
                    // echo expired_users
                    echo $user->first_name . ' -> ' . $user->last_name . ' -> ' . $user->email . ' -> ' . $packageName . ' -> ' . Carbon::createFromTimestamp($billing_end_cycle) . "\n";
                }
            }
        }
    }
}
