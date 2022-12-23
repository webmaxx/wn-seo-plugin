<?php

declare(strict_types=1);

namespace Webmaxx\Seo\Classes\ContentTags\Presets;

use Webmaxx\Seo\Classes\ContentTags\CurrentUrlTag;
use Webmaxx\Seo\Classes\ContentTags\CurrentUrlWithQueryTag;
use Webmaxx\Seo\Classes\ContentTags\DomainTag;
use Webmaxx\Seo\Classes\ContentTags\SiteNameTag;
use Webmaxx\Seo\Classes\ContentTags\SiteUrlTag;

class ComponentTagsPreset extends BasePreset
{
    protected $tags = [
        DomainTag::class,
        SiteNameTag::class,
        SiteUrlTag::class,
        CurrentUrlTag::class,
        CurrentUrlWithQueryTag::class,
    ];
}
