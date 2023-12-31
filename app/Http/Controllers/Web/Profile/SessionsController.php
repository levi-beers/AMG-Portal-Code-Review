<?php

namespace AMGPortal\Http\Controllers\Web\Profile;

use AMGPortal\Http\Controllers\Controller;
use AMGPortal\Repositories\Session\SessionRepository;

/**
 * Class SessionsController
 * @package AMGPortal\Http\Controllers\Web\Profile
 */
class SessionsController extends Controller
{
    public function __construct(private SessionRepository $sessions)
    {
    }

    /**
     * Get sessions for specified user.
     */
    public function index()
    {
        return view('user.sessions', [
            'profile' => true,
            'user' => auth()->user(),
            'sessions' => $this->sessions->getUserSessions(auth()->id())
        ]);
    }

    /**
     * Invalidate user's session.
     *
     * @param $session \stdClass Session object.
     * @return mixed
     */
    public function destroy($session)
    {
        $this->sessions->invalidateSession($session->id);

        return redirect()->route('profile.sessions')
            ->withSuccess(__('Session invalidated successfully.'));
    }
}
