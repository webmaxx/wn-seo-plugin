<?php

declare(strict_types=1);

namespace Webmaxx\Seo\Classes\ContentTags;

use Lang;

class CurrentUrlTag extends BaseContentTag
{
    protected $name = 'current_url';

    public function description(): string
    {
        return Lang::get('webmaxx.seo::lang.contentTags.currentUrl');
    }

    public function value(): string
    {
        return request()->url();
    }
}
