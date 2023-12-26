<?php

namespace AMGPortal\Support\Plugins\Dashboard\Widgets;

use Carbon\Carbon;
use AMGPortal\Plugins\Widget;
use AMGPortal\Repositories\User\UserRepository;

class DataSource3 extends Widget
{
    /**
     * {@inheritdoc}
     */
    public $width = '4';

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
    protected $datasource3PerMonth;

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
        return view('plugins.dashboard.widgets.datasource3-history', [
            'usersPerMonth' => $this->getUsersPerMonth(),
            'datasource3PerMonth' => $this->getDataSource3PerMonth()
        ]);
    }

    /**
     * {@inheritDoc}
     */
    public function scripts()
    {
        return view('plugins.dashboard.widgets.datasource3-history-scripts', [
            'usersPerMonth' => $this->getUsersPerMonth(),
            'datasource3PerMonth' => $this->getDataSource3PerMonth()
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

    private function getDataSource3PerMonth()
    {
        if ($this->datasource3PerMonth) {
            return $this->datasource3PerMonth;
        }

        return $this->datasource3PerMonth = $this->users->countOfNewDataSource3PerMonth(
            Carbon::now()->subYear()->startOfMonth(),
            Carbon::now()->endOfMonth()
        );
    }
}
