<?php

namespace AMGPortal\Http\Controllers\Api\Profile;

use AMGPortal\Http\Controllers\Api\ApiController;
use AMGPortal\Http\Requests\User\UpdateProfileLoginDetailsRequest;
use AMGPortal\Http\Resources\UserResource;
use AMGPortal\Repositories\User\UserRepository;

/**
 * @package AMGPortal\Http\Controllers\Api\Profile
 */
class AuthDetailsController extends ApiController
{
    /**
     * Updates user profile details.
     *
     * @param UpdateProfileLoginDetailsRequest $request
     * @param UserRepository $users
     * @return UserResource
     */
    public function update(UpdateProfileLoginDetailsRequest $request, UserRepository $users)
    {
        $user = $request->user();

        $data = $request->only(['email', 'username', 'password']);

        $user = $users->update($user->id, $data);

        return new UserResource($user);
    }
}
