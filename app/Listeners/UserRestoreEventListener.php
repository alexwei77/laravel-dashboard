<?php

namespace App\Listeners;

use App\Events\UserRestoreEvent;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Models\PaySubscription;

class UserRestoreEventListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  SomeEvent  $event
     * @return void
     */
    public function handle(UserRestoreEvent $event)
    {
        $user_id = $event->restored_user;

        //restore the record associated with this user in dmmx_paysubscriptions
        PaySubscription::where('userid', $user_id)->restore();
    }
}
