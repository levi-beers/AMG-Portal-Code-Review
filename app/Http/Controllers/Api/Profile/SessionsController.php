<?php

namespace AMGPortal\Http\Controllers\Api\Profile;

use AMGPortal\Http\Controllers\Api\ApiController;
use AMGPortal\Http\Resources\SessionResource;
use AMGPortal\Repositories\Session\SessionRepository;

/**
 * @package AMGPortal\Http\Controllers\Api\Profile
 */
class SessionsController extends ApiController
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('session.database');
    }

    /**
     * Handle user details request.
     * @param SessionRepository $sessions
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index(SessionRepository $sessions)
    {
        $sessions = $sessions->getUserSessions(auth()->id());

        return SessionResource::collection($sessions);
    }
}
