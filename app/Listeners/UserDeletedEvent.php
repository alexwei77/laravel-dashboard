<?php

namespace App\Listeners;

use App\Events\UserDeletedEventClass;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Models\PaySubscription;

class UserDeletedEvent //addding implements ShouldQueue will que the event instead of running it immediately
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
     * @param  UserDeletedEventClass  $event
     * @return void
     */
    public function handle(UserDeletedEventClass $event) //this will pass in the id of the deleted user
    {
        // Access the user using $event->deleted_user...
        $user_id = $event->deleted_user;
        //soft delete package associated with this user in dmmx_paysucriptions if there is any
        PaySubscription::where('userid', $user_id)->delete();
    }
}
