<?php

namespace AMGPortal\Http\Controllers\Api\Auth;

use Auth;
use Exception;
use Socialite;
use AMGPortal\Events\User\LoggedIn;
use AMGPortal\Http\Controllers\Api\ApiController;
use AMGPortal\Http\Requests\Auth\Social\ApiAuthenticateRequest;
use AMGPortal\Repositories\User\UserRepository;
use AMGPortal\Services\Auth\Social\SocialManager;

class SocialLoginController extends ApiController
{
    public function __construct(private UserRepository $users, private SocialManager $socialManager)
    {
    }

    public function index(ApiAuthenticateRequest $request)
    {
        try {
            $socialUser = Socialite::driver($request->network)->userFromToken($request->social_token);
        } catch (Exception $e) {
            return $this->errorInternalError("Could not connect to specified social network.");
        }

        $user = $this->users->findBySocialId(
            $request->network,
            $socialUser->getId()
        );

        if (! $user) {
            if (! setting('reg_enabled')) {
                return $this->errorForbidden("Only users who already created an account can log in.");
            }

            $user = $this->socialManager->associate($socialUser, $request->network);
        }

        if ($user->isBanned()) {
            return $this->errorForbidden(__("Your account is banned by administrators."));
        }

        Auth::setUser($user);

        event(new LoggedIn);

        return $this->respondWithArray([
            'token' => $user->createToken($request->device_name)->plainTextToken
        ]);
    }
}
