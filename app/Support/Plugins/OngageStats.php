<?php

namespace AMGPortal\Support\Plugins;

use AMGPortal\Plugins\Plugin;
use AMGPortal\Support\Sidebar\Item;

class OngageStats extends Plugin
{
    public function sidebar()
    {
        // return Item::create(__('Ongage Stats'))
        //     ->route('ongagestats')
        //     ->icon('fas fa-chart-line')
        //     ->active("ongage-stats*")
        //     ->permissions('users.manage');
    }
}
