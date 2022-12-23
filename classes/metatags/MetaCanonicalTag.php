<?php

declare(strict_types=1);

namespace Webmaxx\Seo\Classes\Metatags;

use Url;
use Webmaxx\Seo\Classes\Metatags\BaseMetaTag;
use Webmaxx\Seo\Models\Settings;

class MetaCanonicalTag extends BaseMetaTag
{
    protected $type = 'meta';
    protected $name = 'canonical';

    protected function content(): ?string
    {
        return data_get($this->context->modelData, 'meta_canonical_url')
            ?: $this->context->page->meta_canonical_url
            ?: (
                Settings::get('current_url_as_canonical')
                    ? Url::current()
                    : null
            );
    }
}
