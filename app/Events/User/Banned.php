<?php

namespace AMGPortal\Events\User;

use AMGPortal\User;

class Banned
{
    /**
     * @var User
     */
    protected $bannedUser;

    public function __construct(User $bannedUser)
    {
        $this->bannedUser = $bannedUser;
    }

    /**
     * @return User
     */
    public function getBannedUser()
    {
        return $this->bannedUser;
    }
}
