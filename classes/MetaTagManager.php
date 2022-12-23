<?php

declare(strict_types=1);

namespace Webmaxx\Seo\Classes;

use Webmaxx\Seo\Classes\Metatags\MetaTagContract;

class MetaTagManager implements MetaTagManagerContract
{
    protected $tags = [];

    public function addTag(MetaTagContract $tag): self
    {
        $this->tags[] = $tag;
        return $this;
    }

    public function addTagIf($value, MetaTagContract $tag): self
    {
        if (value($value)) {
            $this->tags[] = $tag;
        }

        return $this;
    }

    public function addTags(array $tags): self
    {
        foreach ($tags as $tag) {
            $this->addTag($tag);
        }

        return $this;
    }

    public function render(): string
    {
        return collect($this->tags)
            ->map(fn($tag) => $tag->render())
            ->implode("\n");
    }

    public function renderWithContentTags(ContentTagManagerContract $tagManager): string
    {
        return $tagManager->render($this->render());
    }
}
