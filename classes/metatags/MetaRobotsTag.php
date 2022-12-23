<?php

declare(strict_types=1);

namespace Webmaxx\Seo\Classes\Metatags;

use Webmaxx\Seo\Classes\Metatags\BaseMetaTag;
use Webmaxx\Seo\Models\Settings;

class MetaRobotsTag extends BaseMetaTag
{
    protected $type = 'meta';
    protected $name = 'robots';

    protected function content(): ?string
    {
        $index = (
                data_get($this->context->modelData, 'meta_robots_index', 'default') != 'default'
                ? data_get($this->context->modelData, 'meta_robots_index', 'default')
                : null
            )
            ?: (
                $this->context->page->meta_robots_index != 'default'
                ? $this->context->page->meta_robots_index
                : null
            )
            ?: Settings::get('meta_robots_index')
            ?: 'index';

        $follow = (
                data_get($this->context->modelData, 'meta_robots_follow', 'default') != 'default'
                ? data_get($this->context->modelData, 'meta_robots_follow', 'default')
                : null
            )
            ?: (
                $this->context->page->meta_robots_follow != 'default'
                ? $this->context->page->meta_robots_follow
                : null
            )
            ?: Settings::get('meta_robots_follow')
            ?: 'follow';

        return collect()
            ->when(
                $index && $index != 'none',
                fn($collection) => $collection->push($index)
            )
            ->when(
                $follow && $follow != 'none',
                fn($collection) => $collection->push($follow)
            )
            ->implode(',');
    }
}
