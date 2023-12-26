<?php

namespace AMGPortal\Http\Controllers\Api\Profile;

use Illuminate\Http\Request;
use AMGPortal\Events\User\ChangedAvatar;
use AMGPortal\Http\Controllers\Api\ApiController;
use AMGPortal\Http\Requests\User\UploadAvatarRawRequest;
use AMGPortal\Http\Resources\UserResource;
use AMGPortal\Repositories\User\UserRepository;
use AMGPortal\Services\Upload\UserAvatarManager;

/**
 * @package AMGPortal\Http\Controllers\Api\Profile
 */
class AvatarController extends ApiController
{
    public function __construct(private UserRepository $users, private UserAvatarManager $avatarManager)
    {
    }

    /**
     * @param UploadAvatarRawRequest $request
     * @return UserResource
     */
    public function update(UploadAvatarRawRequest $request)
    {
        $name = $this->avatarManager->uploadAndCropAvatar(
            $request->file('file')
        );

        $user = $this->users->update(
            auth()->id(),
            ['avatar' => $name]
        );

        event(new ChangedAvatar);

        return new UserResource($user);
    }

    /**
     * @param Request $request
     * @return UserResource
     * @throws \Illuminate\Validation\ValidationException
     */
    public function updateExternal(Request $request)
    {
        $this->validate($request, [
            'url' => 'required|url'
        ]);

        $this->avatarManager->deleteAvatarIfUploaded(
            auth()->user()
        );

        $user = $this->users->update(
            auth()->id(),
            ['avatar' => $request->url]
        );

        event(new ChangedAvatar);

        return new UserResource($user);
    }

    /**
     * Remove avatar for currently authenticated user and set it to null.
     * @return UserResource
     */
    public function destroy()
    {
        $user = auth()->user();

        $this->avatarManager->deleteAvatarIfUploaded($user);

        $user = $this->users->update(
            $user->id,
            ['avatar' => null]
        );

        event(new ChangedAvatar);

        return new UserResource($user);
    }
}
