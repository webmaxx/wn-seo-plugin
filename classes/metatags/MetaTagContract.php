<?php

declare(strict_types=1);

namespace Webmaxx\Seo\Classes\Metatags;

interface MetaTagContract
{
    public function __construct(string|MetaTagContext $context);

    public function render(): ?string;
}
