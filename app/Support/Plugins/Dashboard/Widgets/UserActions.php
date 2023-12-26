<?php

namespace AMGPortal\Support\Plugins\Dashboard\Widgets;

use AMGPortal\Plugins\Widget;
use AMGPortal\User;

class UserActions extends Widget
{
    /**
     * UserActions constructor.
     */
    public function __construct()
    {
        $this->permissions(function (User $user) {
            return $user->hasRole('User');
        });
    }

    /**
     * {@inheritdoc}
     */
    public function render()
    {
        return view('plugins.dashboard.widgets.user-actions');
    }
}
