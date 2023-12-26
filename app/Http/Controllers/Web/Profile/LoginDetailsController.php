<?php

namespace AMGPortal\Http\Controllers\Web\Profile;

use AMGPortal\Http\Controllers\Controller;
use AMGPortal\Http\Requests\User\UpdateProfileLoginDetailsRequest;
use AMGPortal\Repositories\User\UserRepository;

/**
 * Class LoginDetailsController
 * @package AMGPortal\Http\Controllers
 */
class LoginDetailsController extends Controller
{
    public function __construct(private UserRepository $users)
    {
    }

    /**
     * Update user's login details.
     *
     * @param UpdateProfileLoginDetailsRequest $request
     * @return mixed
     */
    public function update(UpdateProfileLoginDetailsRequest $request)
    {
        $data = $request->except('role', 'status');

        // If password is not provided, then we will
        // just remove it from $data array and do not change it
        if (! data_get($data, 'password')) {
            unset($data['password']);
            unset($data['password_confirmation']);
        }

        $this->users->update(auth()->id(), $data);

        return redirect()->route('profile')
            ->withSuccess(__('Login details updated successfully.'));
    }
}
