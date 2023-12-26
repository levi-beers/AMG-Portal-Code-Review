<?php

namespace AMGPortal\Listeners\Users;

use Illuminate\Auth\Events\Verified;
use AMGPortal\Repositories\User\UserRepository;
use AMGPortal\Support\Enum\UserStatus;

class ActivateUser
{
    public function __construct(private UserRepository $users)
    {
    }

    /**
     * Handle the event.
     *
     * @param Verified $event
     * @return void
     */
    public function handle(Verified $event)
    {
        $this->users->update($event->user->id, [
            'status' => UserStatus::ACTIVE
        ]);
    }
}
