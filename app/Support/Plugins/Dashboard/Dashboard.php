<?php

namespace AMGPortal\Support\Plugins\Dashboard;

use AMGPortal\Plugins\Plugin;
use AMGPortal\Support\Sidebar\Item;

class Dashboard extends Plugin
{
    public function sidebar()
    {
        return Item::create(__('Dashboard'))
            ->route('dashboard')
            ->icon('fas fa-home')
            ->active("/");
    }
}
