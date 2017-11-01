<?php

namespace App\Jobs;

use App\Models\PaySubscription;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class MemberAccJob extends Job implements ShouldQueue
{
    use InteractsWithQueue, SerializesModels;

    public function handle()
    {
        PaySubscription::whereNull('acc')
            ->update([
                'acc' => \DB::raw('100000 + `id` * 50 + round(rand()*49)'),
                'updated_at' => \DB::raw('updated_at')
            ]);
        //@todo todo by tech details

//        PaySubscription::whereNull('acc')
//            ->each(function(PaySubscription $paySubscription) {
//                $paySubscription
//                ->where('id', $paySubscription->id)
//                ->update([
//                    'updated_at' => \DB::raw('updated_at'),
//                    'acc' => DB::raw(
//                        '(select coalesce(max(acc),0) + round(rand()*49) from '. (new PaySubscription)->getTable() .')'
//                    )
//                ]);
//            });
    }
}