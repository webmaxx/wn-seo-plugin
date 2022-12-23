<?php

declare(strict_types=1);

namespace Webmaxx\Seo\Classes\ContentTags;

use Lang;
use Webmaxx\Seo\Models\Settings;

class SiteNameTag extends BaseContentTag
{
    protected $name = 'site_name';

    public function description(): string
    {
        return Lang::get('webmaxx.seo::lang.contentTags.siteName');
    }

    public function value(): string
    {
        return Settings::get('site_name');
    }
}
