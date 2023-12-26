<?php

namespace AMGPortal\Support\Plugins\Dashboard\Widgets;

use Carbon\Carbon;
use AMGPortal\Plugins\Widget;
use AMGPortal\Repositories\User\UserRepository;

class DataSource4 extends Widget
{
    /**
     * {@inheritdoc}
     */
    public $width = '12';

    /**
     * @var string
     */
    protected $permissions = 'users.manage';

    /**
     * @var UserRepository
     */
    private $users;

    /**
     * @var array Count of new users per month.
     */
    protected $usersPerMonth;
    protected $datasource4PerMonth;

    /**
     * RegistrationHistory constructor.
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
        return view('plugins.dashboard.widgets.datasource4-history', [
            'usersPerMonth' => $this->getUsersPerMonth()
        ]);
    }

    /**
     * {@inheritDoc}
     */
    public function scripts()
    {
        return view('plugins.dashboard.widgets.datasource4-history-scripts', [
            'usersPerMonth' => $this->getUsersPerMonth()
        ]);
    }

    private function getUsersPerMonth()
    {
        if ($this->usersPerMonth) {
            return $this->usersPerMonth;
        }

        return $this->usersPerMonth = $this->users->countOfNewUsersPerMonth(
            Carbon::now()->subYear()->startOfMonth(),
            Carbon::now()->endOfMonth()
        );
    }

}
