<?php

declare(strict_types=1);

namespace Webmaxx\Seo\Classes\Metatags;

use Webmaxx\Seo\Classes\Metatags\BaseMetaTag;

class OgTypeTag extends BaseMetaTag
{
    protected $type = 'og';
    protected $name = 'type';

    protected function content(): ?string
    {
        return trim(
            data_get($this->context->modelData, 'og_type')
            ?: $this->context->page->og_type
            ?: ''
        );
    }
}
