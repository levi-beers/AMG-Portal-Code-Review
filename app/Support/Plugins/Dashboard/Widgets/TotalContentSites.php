<?php

namespace AMGPortal\Support\Plugins\Dashboard\Widgets;

use AMGPortal\DashboardData;
use AMGPortal\Plugins\Widget;
use AMGPortal\Repositories\User\UserRepository;

class TotalContentSites extends Widget
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
    private $users;

    /**
     * TotalUsers constructor.
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
        $totaloutbound = DashboardData::get();
        
        return view('plugins.dashboard.widgets.total-contentsites', [
            'count' => $totaloutbound[0]->total_outbound_delta,
            'countyesterday' => $totaloutbound[0]->total_outbound_yesterday
        ]);
    }
}
