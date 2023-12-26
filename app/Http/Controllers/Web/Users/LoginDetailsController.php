<?php

namespace AMGPortal\Http\Controllers\Web\Users;

use AMGPortal\Events\User\UpdatedByAdmin;
use AMGPortal\Http\Controllers\Controller;
use AMGPortal\Http\Requests\User\UpdateLoginDetailsRequest;
use AMGPortal\Repositories\User\UserRepository;
use AMGPortal\User;

/**
 * Class UserDetailsController
 * @package AMGPortal\Http\Controllers\Users
 */
class LoginDetailsController extends Controller
{
    public function __construct(private UserRepository $users)
    {
    }

    /**
     * Update user's login details.
     *
     * @param User $user
     * @param UpdateLoginDetailsRequest $request
     * @return mixed
     */
    public function update(User $user, UpdateLoginDetailsRequest $request)
    {
        $data = $request->all();

        if (! $data['password']) {
            unset($data['password']);
            unset($data['password_confirmation']);
        }

        $this->users->update($user->id, $data);

        event(new UpdatedByAdmin($user));

        return redirect()->route('users.edit', $user->id)
            ->withSuccess(__('Login details updated successfully.'));
    }
}
