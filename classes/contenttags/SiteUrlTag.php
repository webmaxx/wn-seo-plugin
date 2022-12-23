<?php

declare(strict_types=1);

namespace Webmaxx\Seo\Classes\ContentTags;

use Lang;

class SiteUrlTag extends BaseContentTag
{
    protected $name = 'site_url';

    public function description(): string
    {
        return Lang::get('webmaxx.seo::lang.contentTags.siteUrl');
    }

    public function value(): string
    {
        return request()->getSchemeAndHttpHost();
    }
}
