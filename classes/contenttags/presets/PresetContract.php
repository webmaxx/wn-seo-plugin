<?php

declare(strict_types=1);

namespace Webmaxx\Seo\Classes\ContentTags\Presets;

interface PresetContract
{
    public function tags(): array;

    public function addTag(string|array $tag): self;

    public function addTags(array $tags): self;
}
