<?php

namespace AMGPortal\Providers;

use AMGPortal\Plugins\AMGPortalServiceProvider as BaseAMGPortalServiceProvider;
use AMGPortal\Support\Plugins\Dashboard\Widgets\BannedUsers;
use AMGPortal\Support\Plugins\Dashboard\Widgets\LatestRegistrations;
use AMGPortal\Support\Plugins\Dashboard\Widgets\NewUsers;
use AMGPortal\Support\Plugins\Dashboard\Widgets\RegistrationHistory;
use AMGPortal\Support\Plugins\Dashboard\Widgets\DataSource3;
use AMGPortal\Support\Plugins\Dashboard\Widgets\DataSource4;
use AMGPortal\Support\Plugins\Dashboard\Widgets\TotalUsers;
use AMGPortal\Support\Plugins\Dashboard\Widgets\UnconfirmedUsers;
use AMGPortal\Support\Plugins\Dashboard\Widgets\UserActions;
use AMGPortal\Support\Plugins\Dashboard\Widgets\TotalContentSites;
//use AMGPortal\Support\Plugins\DataStorage;
use \AMGPortal\UserActivity\Widgets\ActivityWidget;

class AMGPortalServiceProvider extends BaseAMGPortalServiceProvider
{
    /**
     * List of registered plugins.
     *
     * @return array
     */
    protected function plugins()
    {
        return [
            \AMGPortal\Support\Plugins\Dashboard\Dashboard::class,
            \AMGPortal\Support\Plugins\Users::class,
            \AMGPortal\UserActivity\UserActivity::class,
            \AMGPortal\Support\Plugins\RolesAndPermissions::class,
            \AMGPortal\Support\Plugins\Settings::class,
            \AMGPortal\Support\Plugins\ContentSites::class,
            \AMGPortal\Announcements\Announcements::class,
            \AMGPortal\Support\Plugins\UnsubscribeUsers::class,
            \AMGPortal\Support\Plugins\OngageStats::class,
            \AMGPortal\Support\Plugins\Analytics::class,
        ];
    }

    /**
     * Dashboard widgets.
     *
     * @return array
     */
    protected function widgets()
    {
        return [
            UserActions::class,
            TotalUsers::class,
            NewUsers::class,
            BannedUsers::class,
            TotalContentSites::class,
            DataSource4::class,
            ActivityWidget::class,
        ];
    }
}
