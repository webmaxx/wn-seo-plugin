<?php

declare(strict_types=1);

namespace Webmaxx\Seo\Classes\Metatags;

use Webmaxx\Seo\Classes\Metatags\BaseMetaTag;

class MetaDescriptionTag extends BaseMetaTag
{
    protected $type = 'meta';
    protected $name = 'description';

    protected function content(): string
    {
        return trim(
            data_get($this->context->modelData, 'meta_description')
            ?: $this->context->page->meta_description
            ?: ''
        );
    }
}
