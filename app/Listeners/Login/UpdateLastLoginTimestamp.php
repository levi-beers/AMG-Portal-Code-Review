<?php

namespace AMGPortal\Listeners\Login;

use Carbon\Carbon;
use Illuminate\Contracts\Auth\Guard;
use AMGPortal\Events\User\LoggedIn;
use AMGPortal\Repositories\User\UserRepository;

class UpdateLastLoginTimestamp
{
    public function __construct(private UserRepository $users, private Guard $guard)
    {
    }

    /**
     * Handle the event.
     *
     * @param LoggedIn $event
     * @return void
     */
    public function handle(LoggedIn $event)
    {
        $this->users->update(
            $this->guard->id(),
            ['last_login' => Carbon::now()]
        );
    }
}
