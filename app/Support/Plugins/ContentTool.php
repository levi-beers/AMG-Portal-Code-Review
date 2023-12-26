<?php
namespace AMGPortal\Support\Plugins;

use AMGPortal\Plugins\Plugin;
use AMGPortal\Support\Sidebar\Item;

class ContentTool extends Plugin
{
    public function sidebar()
    {
        return Item::create(__('Content Tool'))
            ->route('content-tool')
            ->icon('fas fa-file')
            ->active("content-tool*")
            ->permissions('users.manage');
    }
}
