<?php

declare(strict_types=1);

namespace Webmaxx\Seo\Classes\Metatags;

class MetaTagContext
{
    public $page;
    public $modelData;

    public function __construct($page, $modelData)
    {
        $this->page = $page;
        $this->modelData = $modelData;
    }
}
