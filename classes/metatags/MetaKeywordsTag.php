<?php

declare(strict_types=1);

namespace Webmaxx\Seo\Classes\Metatags;

use Webmaxx\Seo\Classes\Metatags\BaseMetaTag;

class MetaKeywordsTag extends BaseMetaTag
{
    protected $type = 'meta';
    protected $name = 'keywords';

    protected function content(): ?string
    {
        return trim(
            data_get($this->context->modelData, 'meta_keywords')
            ?: $this->context->page->meta_keywords
            ?: ''
        );
    }
}
