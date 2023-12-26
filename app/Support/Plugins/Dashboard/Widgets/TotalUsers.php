<?php

namespace AMGPortal\Support\Plugins\Dashboard\Widgets;

use AMGPortal\DashboardData;
use AMGPortal\Plugins\Widget;
use AMGPortal\Repositories\User\UserRepository;

class TotalUsers extends Widget
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
        $totadatasource = DashboardData::get();

        return view('plugins.dashboard.widgets.total-users', [
            'count' => $totadatasource[0]->total_datasource
        ]);
    }
}
