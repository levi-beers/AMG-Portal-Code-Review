<?php

namespace AMGPortal\Http\Controllers\Web\Users;

use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use AMGPortal\Events\User\UpdatedByAdmin;
use AMGPortal\Http\Controllers\Api\ApiController;
use AMGPortal\Repositories\User\UserRepository;
use AMGPortal\Services\Upload\UserAvatarManager;
use AMGPortal\User;

/**
 * Class AvatarController
 * @package AMGPortal\Http\Controllers\Api\Users
 */
class AvatarController extends ApiController
{
    public function __construct(private UserRepository $users, private UserAvatarManager $avatarManager)
    {
    }

    /**
     * Update user's avatar from uploaded image.
     *
     * @param User $user
     * @param Request $request
     * @return mixed
     * @throws ValidationException
     */
    public function update(User $user, Request $request)
    {
        $this->validate($request, ['avatar' => 'image']);

        $name = $this->avatarManager->uploadAndCropAvatar(
            $request->file('avatar'),
            $request->get('points')
        );

        if ($name) {
            $this->users->update($user->id, ['avatar' => $name]);

            event(new UpdatedByAdmin($user));

            return redirect()->route('users.edit', $user)
                ->withSuccess(__('Avatar changed successfully.'));
        }

        return redirect()->route('users.edit', $user)
            ->withErrors(__('Avatar image cannot be updated. Please try again.'));
    }

    /**
     * Update user's avatar from some external source (Gravatar, Facebook, Twitter...)
     *
     * @param User $user
     * @param Request $request
     * @return mixed
     */
    public function updateExternal(User $user, Request $request)
    {
        $this->avatarManager->deleteAvatarIfUploaded($user);

        $this->users->update($user->id, ['avatar' => $request->get('url')]);

        event(new UpdatedByAdmin($user));

        return redirect()->route('users.edit', $user)
            ->withSuccess(__('Avatar changed successfully.'));
    }
}
