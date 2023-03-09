<?php

declare(strict_types=1);

namespace Webmaxx\Seo\Classes\Metatags;

use System\Classes\MediaLibrary;
use Webmaxx\Seo\Classes\Metatags\BaseMetaTag;
use Webmaxx\Seo\Classes\UrlNormalizer;
use Webmaxx\Seo\Models\Settings;

class OgImageTag extends BaseMetaTag
{
    protected $type = 'og';
    protected $name = 'image';

    protected function content(): ?string
    {
        $imageUrl = data_get($this->context->modelData, 'og_image')
            ?: $this->context->page->og_image
            ?: Settings::get('og_image');

        return $imageUrl ? UrlNormalizer::normalize(url(MediaLibrary::url($imageUrl))) : null;
    }
}
