<?php

namespace AMGPortal\Events\ContentSite;

use AMGPortal\ContentSite;

abstract class ContentSiteEvent
{
    /**
     * @var Permission
     */
    protected $contentsite;

    public function __construct(ContentSite $contentsite)
    {
        $this->contentsite = $contentsite;
    }

    /**
     * @return Permission
     */
    public function getContentSite()
    {
        return $this->contentsite;
    }
}
