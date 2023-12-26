<?php

namespace AMGPortal\Support\Plugins;

use AMGPortal\Plugins\Plugin;
use AMGPortal\Support\Sidebar\Item;

class UnsubscribeUsers extends Plugin
{
    public function sidebar()
    {
        // return Item::create(__('Unsubscribe Users'))
        //     ->route('unsubscribe')
        //     ->icon('fas fa-times')
        //     ->active("unsubscribe*")
        //     ->permissions('users.manage');
    }
}
