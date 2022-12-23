<?php

declare(strict_types=1);

namespace Webmaxx\Seo\Classes\Metatags;

use Webmaxx\Seo\Classes\Metatags\BaseMetaTag;

class OgUrlTag extends BaseMetaTag
{
    protected $type = 'og';
    protected $name = 'url';

    protected function content(): ?string
    {
        return trim(
            data_get($this->context->modelData, 'og_url')
            ?: $this->context->page->og_url
            ?: ''
        );
    }
}
