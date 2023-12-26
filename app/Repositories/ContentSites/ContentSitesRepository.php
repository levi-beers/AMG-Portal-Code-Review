<?php

namespace AMGPortal\Repositories\ContentSites;

use AMGPortal\ContentSite;

interface ContentSitesRepository
{
    /**
     * Number of users in database.
     *
     * @return mixed
     */
    public function count();

}
