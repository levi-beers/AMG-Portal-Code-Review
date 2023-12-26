<?php

namespace AMGPortal\Http\Controllers\Api\Users;

use Illuminate\Http\Request;
use AMGPortal\Events\User\UpdatedByAdmin;
use AMGPortal\Http\Controllers\Api\ApiController;
use AMGPortal\Http\Requests\User\UploadAvatarRawRequest;
use AMGPortal\Http\Resources\UserResource;
use AMGPortal\Repositories\User\UserRepository;
use AMGPortal\Services\Upload\UserAvatarManager;
use AMGPortal\User;

/**
 * @package AMGPortal\Http\Controllers\Api\Users
 */
class AvatarController extends ApiController
{
    public function __construct(private UserRepository $users, private UserAvatarManager $avatarManager)
    {
        $this->middleware('permission:users.manage');
    }

    /**
     * @param User $user
     * @param UploadAvatarRawRequest $request
     * @return UserResource
     */
    public function update(User $user, UploadAvatarRawRequest $request)
    {
        $name = $this->avatarManager->uploadAndCropAvatar($request->file('file'));

        $user = $this->users->update($user->id, ['avatar' => $name]);

        event(new UpdatedByAdmin($user));

        return new UserResource($user);
    }

    /**
     * Update user's avatar to external resource.
     *
     * @param User $user
     * @param Request $request
     * @return UserResource
     * @throws \Illuminate\Validation\ValidationException
     */
    public function updateExternal(User $user, Request $request)
    {
        $this->validate($request, ['url' => 'required|url']);

        $this->avatarManager->deleteAvatarIfUploaded($user);

        $user = $this->users->update($user->id, ['avatar' => $request->url]);

        event(new UpdatedByAdmin($user));

        return new UserResource($user);
    }

    /**
     * Remove user's avatar and set it to null.
     *
     * @param User $user
     * @return UserResource
     */
    public function destroy(User $user)
    {
        $this->avatarManager->deleteAvatarIfUploaded($user);

        $user = $this->users->update($user->id, ['avatar' => null]);

        event(new UpdatedByAdmin($user));

        return new UserResource($user);
    }
}
