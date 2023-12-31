<?php

namespace AMGPortal\Services\Auth\Social;

use Illuminate\Support\Str;
use Laravel\Socialite\Contracts\User as SocialUser;
use AMGPortal\Repositories\Role\RoleRepository;
use AMGPortal\Repositories\User\UserRepository;
use AMGPortal\Support\Enum\UserStatus;

class SocialManager
{
    use ManagesSocialAvatarSize;

    public function __construct(private UserRepository $users, private RoleRepository $roles)
    {
    }

    /**
     * Associate social user with given provider. If user with the same email address
     * retrieved from social network exists in our database, we will just associate it
     * with provided social account. If not, user will be created.
     *
     * @param SocialUser $socialUser
     * @param string $provider
     * @return mixed|null|\AMGPortal\User
     */
    public function associate(SocialUser $socialUser, $provider)
    {
        $user = $this->users->findByEmail($socialUser->getEmail());

        if (! $user) {
            // User with email retrieved from social auth provider does not
            // exist in our database. That means that we have to create new user here
            list($firstName, $lastName) = $this->parseUserFullName($socialUser);

            $role = $this->roles->findByName('User');

            $user = $this->users->create([
                'email' => $socialUser->getEmail(),
                'password' => Str::random(10),
                'first_name' => $firstName,
                'last_name' => $lastName,
                'status' => UserStatus::ACTIVE,
                'avatar' => $this->getAvatarForProvider($provider, $socialUser),
                'role_id' => $role->id,
                'email_verified_at' => now()
            ]);
        }

        // Associate social account with user account inside our application
        $this->users->associateSocialAccountForUser($user->id, $provider, $socialUser);

        return $user;
    }

    /**
     * Parse User's name from his social network account.
     *
     * @param SocialUser $user
     * @return array
     */
    private function parseUserFullName(SocialUser $user)
    {
        $name = $user->getName();

        if (str_contains($name, " ")) {
            return explode(" ", $name, 2);
        }

        return [$name, ''];
    }
}
