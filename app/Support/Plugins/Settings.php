<?php

namespace AMGPortal\Support\Plugins;

use AMGPortal\Plugins\Plugin;
use AMGPortal\Support\Sidebar\Item;
use AMGPortal\User;

class Settings extends Plugin
{
    public function sidebar()
    {
        // $general = Item::create(__('General'))
        //     ->route('settings.general')
        //     ->active("settings")
        //     ->permissions('settings.general');

        // $authAndRegistration = Item::create(__('Auth & Registration'))
        //     ->route('settings.auth')
        //     ->active("settings/auth")
        //     ->permissions('settings.auth');

        // $notifications = Item::create(__('Notifications'))
        //     ->route('settings.notifications')
        //     ->active("settings/notifications")
        //     ->permissions(function (User $user) {
        //         return $user->hasPermission('settings.notifications');
        //     });

        // return Item::create(__('Portal Settings'))
        //     ->href('#settings-dropdown')
        //     ->icon('fas fa-cogs')
        //     ->permissions(['settings.general', 'settings.auth', 'settings.notifications'])
        //     ->addChildren([
        //         $general,
        //         $authAndRegistration,
        //         $notifications,
        //     ]);
    }
}
