<?php

declare(strict_types=1);

namespace Webmaxx\Seo\Classes;

use Webmaxx\Seo\Classes\Metatags\MetaTagContract;

interface MetaTagManagerContract
{
    public function addTag(MetaTagContract $tag): self;

    public function addTags(array $tags): self;

    public function render(): string;

    public function renderWithContentTags(ContentTagManagerContract $tagManager): string;
}
