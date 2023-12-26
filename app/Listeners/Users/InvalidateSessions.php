<?php

namespace AMGPortal\Listeners\Users;

use AMGPortal\Events\User\Banned;
use AMGPortal\Repositories\Session\SessionRepository;

class InvalidateSessions
{
    public function __construct(private SessionRepository $sessions)
    {
    }

    /**
     * Handle the event.
     *
     * @param Banned $event
     * @return void
     */
    public function handle(Banned $event)
    {
        $user = $event->getBannedUser();

        $this->sessions->invalidateAllSessionsForUser($user->id);
    }
}
