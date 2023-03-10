<?php

declare(strict_types=1);

namespace Webmaxx\Seo\Classes\Metatags;

use Webmaxx\Seo\Classes\Metatags\BaseMetaTag;

class OgTitleTag extends BaseMetaTag
{
    protected $type = 'og';
    protected $name = 'title';

    protected function content(): ?string
    {
        return trim(
            data_get($this->context->modelData, 'og_title')
            ?: $this->context->page->og_title
            ?: ''
        );
    }
}
