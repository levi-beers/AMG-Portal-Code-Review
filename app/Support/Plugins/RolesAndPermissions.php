<?php

namespace AMGPortal\Support\Plugins;

use AMGPortal\Plugins\Plugin;
use AMGPortal\Support\Sidebar\Item;
use AMGPortal\User;

class RolesAndPermissions extends Plugin
{
    public function sidebar()
    {
        $roles = Item::create(__('Roles'))
            ->route('roles.index')
            ->icon('fas fa-users-cog')
            ->active("roles*")
            ->permissions('roles.manage');

        $permissions = Item::create(__('Permissions'))
            ->route('permissions.index')
            ->icon('fas fa-user-shield')
            ->active("permissions*")
            ->permissions('permissions.manage');

        $users =  Item::create(__('Users'))
            ->route('users.index')
            ->icon('fas fa-user-friends')
            ->active("users*")
            ->permissions('users.manage');

        $activity_log = Item::create(__('Activity Log'))
            ->route('activity.index')
            ->icon('fas fa-history')
            ->active("activity*")
            ->permissions('users.activity');

        $general = Item::create(__('General'))
            ->route('settings.general')
            ->icon('fas fa-cog')
            ->active("settings")
            ->permissions('settings.general');

        $authAndRegistration = Item::create(__('Auth & Reg.'))
            ->route('settings.auth')
            ->icon('fas fa-user-lock')
            ->active("settings/auth")
            ->permissions('settings.auth');

        $notifications = Item::create(__('Notifications'))
            ->route('settings.notifications')
            ->icon('fas fa-bell')
            ->active("settings/notifications")
            ->permissions(function (User $user) {
                return $user->hasPermission('settings.notifications');
            });

        $announcement = Item::create(__('Announcements'))
            ->route('announcements.index')
            ->icon('fas fa-bullhorn')
            ->permissions('announcements.manage')
            ->active('announcements*');

        return Item::create(__('Admin Tools'))
            ->href('#roles-dropdown')
            ->icon('fas fa-toolbox')
            ->permissions(['roles.manage', 'permissions.manage'])
            ->addChildren([
                $activity_log,
                $announcement,
                $authAndRegistration,
                $general,
                $notifications,
                $permissions,
                $roles,
                $users
            ]);

    }
}
