<?php

namespace AMGPortal\Http\Controllers\Web\Profile;

use Illuminate\Http\Request;
use AMGPortal\Events\User\ChangedAvatar;
use AMGPortal\Http\Controllers\Controller;
use AMGPortal\Repositories\User\UserRepository;
use AMGPortal\Services\Upload\UserAvatarManager;

/**
 * Class ProfileController
 * @package AMGPortal\Http\Controllers
 */
class AvatarController extends Controller
{
    public function __construct(private UserRepository $users)
    {
    }

    /**
     * Upload and update user's avatar.
     *
     * @param Request $request
     * @param UserAvatarManager $avatarManager
     * @return mixed
     */
    public function update(Request $request, UserAvatarManager $avatarManager)
    {
        $request->validate(['avatar' => 'image']);

        $name = $avatarManager->uploadAndCropAvatar(
            $request->file('avatar'),
            $request->get('points')
        );

        if ($name) {
            return $this->handleAvatarUpdate($name);
        }

        return redirect()->route('profile')
            ->withErrors(__('Avatar image cannot be updated. Please try again.'));
    }

    /**
     * Update avatar for currently logged in user
     * and fire appropriate event.
     *
     * @param $avatar
     * @return mixed
     */
    private function handleAvatarUpdate($avatar)
    {
        $this->users->update(auth()->id(), ['avatar' => $avatar]);

        event(new ChangedAvatar);

        return redirect()->route('profile')
            ->withSuccess(__('Avatar changed successfully.'));
    }

    /**
     * Update user's avatar from external location/url.
     *
     * @param Request $request
     * @param UserAvatarManager $avatarManager
     * @return mixed
     */
    public function updateExternal(Request $request, UserAvatarManager $avatarManager)
    {
        $avatarManager->deleteAvatarIfUploaded(auth()->user());

        return $this->handleAvatarUpdate($request->get('url'));
    }
}
