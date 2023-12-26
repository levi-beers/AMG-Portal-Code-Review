<?php

namespace AMGPortal\Support\Plugins\Dashboard\Widgets;

use AMGPortal\DashboardData;
use AMGPortal\Plugins\Widget;
use AMGPortal\Repositories\User\UserRepository;
use AMGPortal\Support\Enum\UserStatus;

class BannedUsers extends Widget
{
    /**
     * {@inheritdoc}
     */
    public $width = '3';

    /**
     * {@inheritdoc}
     */
    protected $permissions = 'users.manage';

    /**
     * @var UserRepository
     */
    protected $users;

    /**
     * BannedUsers constructor.
     * @param UserRepository $users
     */
    public function __construct(UserRepository $users)
    {
        $this->users = $users;
    }

    /**
     * {@inheritDoc}
     */
    public function render()
    {
        $totainbound = DashboardData::get();

        return view('plugins.dashboard.widgets.banned-users', [
            'count' => $totainbound[0]->total_inbound_delta,
            'countyesterday' => $totainbound[0]->total_inbound_yesterday
        ]);
    }
}
