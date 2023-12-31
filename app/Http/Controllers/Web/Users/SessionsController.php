<?php

namespace AMGPortal\Http\Controllers\Web\Users;

use Illuminate\Contracts\View\Factory;
use Illuminate\View\View;
use AMGPortal\Http\Controllers\Controller;
use AMGPortal\Repositories\Session\SessionRepository;
use AMGPortal\User;

/**
 * Class SessionsController
 * @package AMGPortal\Http\Controllers\Web\Users
 */
class SessionsController extends Controller
{
    public function __construct(private SessionRepository $sessions)
    {
        $this->middleware('permission:users.manage');
    }

    /**
     * Displays the list with all active sessions for the selected user.
     *
     * @param User $user
     * @return Factory|View
     */
    public function index(User $user)
    {
        return view('user.sessions', [
            'adminView' => true,
            'user' => $user,
            'sessions' => $this->sessions->getUserSessions($user->id)
        ]);
    }

    /**
     * Invalidate specified session for selected user.
     *
     * @param User $user
     * @param $session
     * @return mixed
     */
    public function destroy(User $user, $session)
    {
        $this->sessions->invalidateSession($session->id);

        return redirect()->route('user.sessions', $user->id)
            ->withSuccess(__('Session invalidated successfully.'));
    }
}
