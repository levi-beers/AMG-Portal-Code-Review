<?php

namespace AMGPortal\Support\Plugins\Dashboard\Widgets;

use AMGPortal\Plugins\Widget;
use AMGPortal\Repositories\User\UserRepository;

class LatestRegistrations extends Widget
{
    /**
     * {@inheritdoc}
     */
    public $width = '4';

    /**
     * {@inheritdoc}
     */
    protected $permissions = 'users.manage';

    /**
     * @var UserRepository
     */
    private $users;

    /**
     * LatestRegistrations constructor.
     * @param UserRepository $users
     */
    public function __construct(UserRepository $users)
    {
        $this->users = $users;
    }

    /**
     * {@inheritdoc}
     */
    public function render()
    {
        return view('plugins.dashboard.widgets.latest-registrations', [
            'latestRegistrations' => $this->users->latest(6)
        ]);
    }
}
