<?php

namespace AMGPortal\Support\Plugins;

use AMGPortal\Plugins\Plugin;
use AMGPortal\Support\Sidebar\Item;

class ContentSites extends Plugin
{
    public function sidebar()
    {

        $tool = Item::create(__('Content Lookup'))
            ->route('content-tool')
            ->icon('fas fa-search')
            ->active("content-tool*")
            ->permissions('contenttool.lookup');

        $sites1 = Item::create(__('Content Domains'))
            ->route('contentsites.index')
            ->icon('fas fa-globe')
            ->active("contentsites*")
            ->permissions('contentsite.view');


        $sites2 = Item::create(__('Delivery Settings'))
            ->route('contentsitedeliverysettings.index')
            ->icon('fas fa-truck-loading')
            ->active("contentsitedeliverysettings*")
            ->permissions('contentsite.view');

        $sites4 = Item::create(__('Blocked Domains'))
            ->route('blockeddomains.index')
            ->icon('fas fa-ban fa-globe-asia')
            ->active("blockeddomains*")
            ->permissions('contentsite.view');

        $sites5 = Item::create(__('Data Sources'))
            ->route('datasource.index')
            ->icon('fas fa-database')
            ->active("datasource*")
            ->permissions('contentsite.view');

        $sites6 = Item::create(__('Data Connections'))
            ->route('espsettings.index')
            ->icon('fas fa-link')
            ->active("espsettings*")
            ->permissions('contentsite.view');

        $sites3 = Item::create(__('Content Verticals'))
            ->route('contentverticals.index')
            ->icon('fas fa-outdent')
            ->active("contentverticals*")
            ->permissions('contentverticals.view');

        $unsubscribe = Item::create(__('Unsubscribe Users'))
            ->route('unsubscribe')
            ->icon('fas fa-user-slash')
            ->active("unsubscribe*")
            ->permissions('users.manage');

        return Item::create(__('Mail Network'))
            ->href('#tools-dropdown')
            ->icon('fas fa-sitemap')
            ->permissions(['contentsite.view'])
            ->addChildren([
                $sites5,
                $sites6,
                $sites2,
                $sites1,
                $sites4,
                $sites3,
                $tool,
                $unsubscribe

            ]);
    }
}
