<?php

namespace AMGPortal\Events\User;

use AMGPortal\User;

class TwoFactorDisabledByAdmin
{
    /**
     * @var User
     */
    protected $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * @return User
     */
    public function getUser()
    {
        return $this->user;
    }
}
