<?php

declare(strict_types=1);

namespace Webmaxx\Seo\Classes\ContentTags;

use Lang;

class CurrentUrlWithQueryTag extends BaseContentTag
{
    protected $name = 'current_url_with_query';

    public function description(): string
    {
        return Lang::get('webmaxx.seo::lang.contentTags.currentUrlWithQuery');
    }

    public function value(): string
    {
        return request()->fullUrl();
    }
}
