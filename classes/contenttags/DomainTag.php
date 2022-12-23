<?php

declare(strict_types=1);

namespace Webmaxx\Seo\Classes\ContentTags;

use Lang;

class DomainTag extends BaseContentTag
{
    protected $name = 'domain';

    public function description(): string
    {
        return Lang::get('webmaxx.seo::lang.contentTags.domain');
    }

    public function value(): string
    {
        return request()->host();
    }
}
