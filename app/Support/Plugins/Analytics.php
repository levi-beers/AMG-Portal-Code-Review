<?php

namespace AMGPortal\Support\Plugins;

use AMGPortal\Plugins\Plugin;
use AMGPortal\Support\Sidebar\Item;

class Analytics extends Plugin
{
    public function sidebar()
    {

        $contact_activity = Item::create(__('Contacts Activity'))
            ->route('analytics.contact')
            ->icon('fas fa-chart-area')
            ->active("analytics/contact*")
            ->permissions('users.manage');

        $ongage = Item::create(__('Ongage Stats'))
            ->route('ongagestats')
            ->icon('fas fa-chart-line')
            ->active("ongage-stats*")
            ->permissions('users.manage');

        $outbound = Item::create(__('Outbound'))
            ->route('analytics.outbound')
            ->icon('fas fa-chart-bar')
            ->active("analytics/outbound*")
            ->permissions('users.manage');

        return Item::create(__('Analytics'))
            ->href('#analytics-dropdown')
            ->icon('fas fa-chart-pie')
            ->permissions('users.manage')
            ->addChildren([
                $contact_activity,
                $ongage,
                $outbound,
            ]);
    }
}
