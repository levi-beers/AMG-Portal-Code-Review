<?php

namespace AMGPortal\Http\Controllers\Api\Users;

use AMGPortal\Http\Controllers\Api\ApiController;
use AMGPortal\Http\Resources\SessionResource;
use AMGPortal\Repositories\Session\SessionRepository;
use AMGPortal\User;

/**
 * @package AMGPortal\Http\Controllers\Api\Users
 */
class SessionsController extends ApiController
{
    public function __construct()
    {
        $this->middleware('permission:users.manage');
        $this->middleware('session.database');
    }

    /**
     * Get sessions for specified user.
     * @param User $user
     * @param SessionRepository $sessions
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index(User $user, SessionRepository $sessions)
    {
        return SessionResource::collection(
            $sessions->getUserSessions($user->id)
        );
    }
}
