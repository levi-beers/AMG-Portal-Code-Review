<?php

namespace AMGPortal\Http\Controllers\Api\Auth;

use Illuminate\Auth\Events\Registered;
use AMGPortal\Http\Controllers\Api\ApiController;
use AMGPortal\Http\Requests\Auth\RegisterRequest;
use AMGPortal\Repositories\Role\RoleRepository;
use AMGPortal\Repositories\User\UserRepository;
use AMGPortal\Support\Enum\UserStatus;

class RegistrationController extends ApiController
{
    public function __construct(private UserRepository $users, private RoleRepository $roles)
    {
    }

    /**
     * @param RegisterRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(RegisterRequest $request)
    {
        $role = $this->roles->findByName('User');

        $user = $this->users->create(
            array_merge($request->validFormData(), ['role_id' => $role->id])
        );

        event(new Registered($user));

        return $this->setStatusCode(201)
            ->respondWithArray([
                'requires_email_confirmation' => !! setting('reg_email_confirmation')
            ]);
    }

    /**
     * Verify email via email confirmation token.
     * @param $token
     * @return \Illuminate\Http\JsonResponse
     */
    public function verifyEmail($token)
    {
        if (! setting('reg_email_confirmation')) {
            return $this->errorNotFound();
        }

        if ($user = $this->users->findByConfirmationToken($token)) {
            $this->users->update($user->id, [
                'status' => UserStatus::ACTIVE,
                'confirmation_token' => null
            ]);

            return $this->respondWithSuccess();
        }

        return $this->setStatusCode(400)
            ->respondWithError("Invalid confirmation token.");
    }
}
