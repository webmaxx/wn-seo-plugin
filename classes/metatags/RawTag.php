<?php

declare(strict_types=1);

namespace Webmaxx\Seo\Classes\Metatags;

use Webmaxx\Seo\Classes\Metatags\BaseMetaTag;

class RawTag extends BaseMetaTag
{
    protected $type = 'raw';

    protected function content(): ?string
    {
        return trim($this->context ?: '') ?: null;
    }
}
