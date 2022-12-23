<?php

declare(strict_types=1);

namespace Webmaxx\Seo\Classes\ContentTags\Presets;

abstract class BasePreset implements PresetContract
{
    protected $tags = [];

    public function tags(): array
    {
        return $this->tags;
    }

    public function addTag(string|array $tag): self
    {
        $this->tags[] = $tag;

        return $this;
    }

    public function addTags(array $tags): self
    {
        foreach ($tags as $tag) {
            $this->addTag($tag);
        }

        return $this;
    }
}
