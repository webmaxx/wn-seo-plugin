<?php

declare(strict_types=1);

namespace Webmaxx\Seo\Classes\ContentTags;

class PageTitleTag extends BaseContentTag
{
    protected $name = 'page_title';

    public function description(): string
    {
        return 'Page title';
    }

    public function value(): string
    {
        return $this->context;
    }
}
