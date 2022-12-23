<?php

declare(strict_types=1);

namespace Webmaxx\Seo\Classes\Metatags;

use Webmaxx\Seo\Classes\Metatags\BaseMetaTag;

class OgDescriptionTag extends BaseMetaTag
{
    protected $type = 'og';
    protected $name = 'description';

    protected function content(): ?string
    {
        return trim(
            data_get($this->context->modelData, 'og_description')
            ?: $this->context->page->og_description
            ?: ''
        );
    }
}
