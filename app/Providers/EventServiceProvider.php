<?php

namespace AMGPortal\Providers;

use Illuminate\Support\Facades\Event;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Events\Verified;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use AMGPortal\Events\User\Banned;
use AMGPortal\Events\User\LoggedIn;
use AMGPortal\Events\ContentSite\Added;
use AMGPortal\Listeners\Users\ActivateUser;
use AMGPortal\Listeners\Users\InvalidateSessions;
use AMGPortal\Listeners\Login\UpdateLastLoginTimestamp;
use AMGPortal\Listeners\Registration\SendSignUpNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
            SendSignUpNotification::class,
        ],
        LoggedIn::class => [
            UpdateLastLoginTimestamp::class
        ],
        Banned::class => [
            InvalidateSessions::class
        ],
        Verified::class => [
            ActivateUser::class
        ]
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        /*Event::listen(
            Added::class,
        );*/
    }

    /**
     * Determine if events and listeners should be automatically discovered.
     *
     * @return bool
     */
    public function shouldDiscoverEvents()
    {
        return false;
    }
}
