<?php

declare(strict_types=1);

namespace Webmaxx\Seo\Classes\Metatags;

use Webmaxx\Seo\Classes\Metatags\BaseMetaTag;
use Webmaxx\Seo\Models\Settings;

class TitleTag extends BaseMetaTag
{
    protected $type = 'title';

    protected function content(): string
    {
        $title = data_get($this->context->modelData, 'meta_title')
            ?: $this->context->page->meta_title
            ?: data_get($this->context->modelData, 'page_title')
            ?: $this->context->page->title;

        return collect($title)
            ->when(
                Settings::get('page_title_prefix'),
                fn($collection) => $collection->prepend(Settings::get('page_title_prefix'))
            )
            ->when(
                Settings::get('page_title_postfix'),
                fn($collection) => $collection->push(Settings::get('page_title_postfix'))
            )
            ->implode(' ');
    }
}
