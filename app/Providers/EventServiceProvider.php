<?php

namespace App\Providers;

use Illuminate\Support\Facades\Event;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        'App\Events\SomeEvent' => [
            'App\Listeners\EventListener',
            'App\Listeners\UserDeletedEvent',
            'App\Listeners\UserRestoreEventListener',
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        Event::listen('App\Events\UserDeletedEventClass', 'App\Listeners\UserDeletedEvent');
        Event::listen('App\Events\UserRestoreEvent', 'App\Listeners\UserRestoreEventListener');
    }
}
