<?php

namespace AMGPortal\Http\Controllers\Web\Auth;

use Illuminate\Auth\Events\Registered;
use AMGPortal\Http\Controllers\Controller;
use AMGPortal\Http\Requests\Auth\RegisterRequest;
use AMGPortal\Repositories\Role\RoleRepository;
use AMGPortal\Repositories\User\UserRepository;
use AMGPortal\Support\Enum\UserStatus;

class RegisterController extends Controller
{
    public function __construct(private UserRepository $users)
    {
        $this->middleware('registration')->only('show', 'register');
    }

    /**
     * Show the application registration form.
     *
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        return view('auth.register', [
            'socialProviders' => config('auth.social.providers')
        ]);
    }

    /**
     * Handle a registration request for the application.
     *
     * @param RegisterRequest $request
     * @param RoleRepository $roles
     * @return \Illuminate\Http\Response
     */
    public function register(RegisterRequest $request, RoleRepository $roles)
    {
        $user = $this->users->create(
            array_merge($request->validFormData(), ['role_id' => $roles->findByName('User')->id])
        );

        event(new Registered($user));

        $message = setting('reg_email_confirmation')
            ? __('Your account is created successfully! Please confirm your email.')
            : __('Your account is created successfully!');

        \Auth::login($user);

        return redirect('/')->with('success', $message);
    }
}
