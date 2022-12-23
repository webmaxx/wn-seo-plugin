<?php

declare(strict_types=1);

namespace Webmaxx\Seo\Classes;

use Webmaxx\Seo\Classes\ContentTags\ContentTagContract;
use Webmaxx\Seo\Classes\ContentTags\Presets\PresetContract;

interface ContentTagManagerContract
{
    public function addTag(ContentTagContract|string|array $tag): self;

    public function addTags(PresetContract|array $tags): self;

    public function render(string $content): string;
}
