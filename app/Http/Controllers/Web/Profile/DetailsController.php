<?php

namespace AMGPortal\Http\Controllers\Web\Profile;

use AMGPortal\Events\User\UpdatedProfileDetails;
use AMGPortal\Http\Controllers\Controller;
use AMGPortal\Http\Requests\User\UpdateProfileDetailsRequest;
use AMGPortal\Repositories\User\UserRepository;

/**
 * Class DetailsController
 * @package AMGPortal\Http\Controllers
 */
class DetailsController extends Controller
{
    public function __construct(private UserRepository $users)
    {
    }

    /**
     * Update profile details.
     *
     * @param UpdateProfileDetailsRequest $request
     * @return mixed
     */
    public function update(UpdateProfileDetailsRequest $request)
    {
        $this->users->update(auth()->id(), $request->except('role_id', 'status'));

        event(new UpdatedProfileDetails);

        return redirect()->back()
            ->withSuccess(__('Profile updated successfully.'));
    }
}
