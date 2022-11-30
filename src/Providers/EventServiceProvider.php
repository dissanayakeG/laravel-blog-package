<?php


namespace DissanayajeG\pack\Providers;


use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use DissanayajeG\pack\Events\PostWasCreated;
use DissanayajeG\pack\Listeners\UpdatePostTitle;

class EventServiceProvider extends ServiceProvider
{
    protected $listen = [
        PostWasCreated::class => [
            UpdatePostTitle::class,
        ]
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();
    }
}