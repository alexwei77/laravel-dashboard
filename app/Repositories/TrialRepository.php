<?php

namespace App\Repositories;
use App\User;
use App\Models\PaySubscription;
use Carbon\Carbon;

class TrialRepository extends AbsRepository
{

    public function getTrialBusinesses()
    {
        /*$businesses_ids_nopay = PaySubscription::where('pay_status', 0)->get();
        return $businesses_ids_nopay;*/
    }
}
