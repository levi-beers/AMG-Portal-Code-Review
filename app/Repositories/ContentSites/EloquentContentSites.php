<?php

namespace AMGPortal\Repositories\ContentSites;


use AMGPortal\ContentSite;


class EloquentContentSites implements ContentSitesRepository
{


    /**
     * {@inheritdoc}
     */
    public function count()
    {
        return ContentSite::count();
    }

}
