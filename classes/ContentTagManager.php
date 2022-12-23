<?php

declare(strict_types=1);

namespace Webmaxx\Seo\Classes;

use Webmaxx\Seo\Classes\ContentTags\ContentTagContract;
use Webmaxx\Seo\Classes\ContentTags\Presets\PresetContract;

class ContentTagManager implements ContentTagManagerContract
{
    protected $tags = [];

    public function tags(): array
    {
        return $this->tags;
    }

    public function addTag(ContentTagContract|string|array $tag): self
    {
        if ($tag = $this->createTag($tag)) {
            $this->tags[$tag->name()] = $tag;
        }

        return $this;
    }

    public function addTags(PresetContract|array $tags): self
    {
        if ($tags instanceof PresetContract) {
            $tags = $tags->tags();
        }

        foreach ($tags as $tag) {
            $this->addTag($tag);
        }

        return $this;
    }

    public function render(string $content): string
    {
        foreach ($this->tags() as $tag) {
            $content = $tag->render($content);
        }

        return $content;
    }

    protected function createTag(ContentTagContract|string|array $tag): ?ContentTagContract
    {
        if (is_string($tag) && class_exists($tag)) {
            $tag = new $tag;
        }

        if (is_array($tag)) {
            $tag = new $tag[0](data_get($tag, '1'));
        }

        if ($tag instanceof ContentTagContract) {
            return $tag;
        }

        return null;
    }
}
