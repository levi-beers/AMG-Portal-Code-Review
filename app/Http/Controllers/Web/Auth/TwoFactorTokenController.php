<?php

namespace AMGPortal\Http\Controllers\Web\Auth;

use Auth;
use Authy;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use AMGPortal\Events\User\LoggedIn;
use AMGPortal\Http\Controllers\Controller;
use AMGPortal\Repositories\User\UserRepository;
use AMGPortal\Services\Auth\ThrottlesLogins;

class TwoFactorTokenController extends Controller
{
    use ThrottlesLogins;

    public function __construct(private UserRepository $users)
    {
    }

    /**
     * Show Two-Factor Token form.
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function show()
    {
        return session('auth.2fa.id') ? view('auth.token') : redirect('login');
    }

    /**
     * Handle Two-Factor token form submission.
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * @throws \Illuminate\Validation\ValidationException
     */
    public function update(Request $request)
    {
        $this->validate($request, ['token' => 'required']);

        if (! session('auth.2fa.id')) {
            return redirect('login');
        }

        $user = $this->users->find(
            $request->session()->pull('auth.2fa.id')
        );

        if (! $user) {
            throw new NotFoundHttpException;
        }

        if (! Authy::tokenIsValid($user, $request->token)) {
            return redirect()->to('login')
                ->withErrors(__('2FA Token is invalid!'));
        }

        Auth::login($user);

        event(new LoggedIn);

        return redirect()->intended('/');
    }
}
