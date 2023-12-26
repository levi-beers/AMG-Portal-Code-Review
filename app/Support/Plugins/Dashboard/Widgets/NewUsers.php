<?php

namespace AMGPortal\Support\Plugins\Dashboard\Widgets;

use AMGPortal\DashboardData;
use AMGPortal\Plugins\Widget;
use AMGPortal\Repositories\User\UserRepository;

class NewUsers extends Widget
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
     * NewUsers constructor.
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
        $totaldataconnection = DashboardData::get();

        return view('plugins.dashboard.widgets.new-users', [
            'count' => $totaldataconnection[0]->total_data_connection
        ]);
    }
}
