<?php

declare(strict_types=1);

namespace Webmaxx\Seo\Classes\Generators;

use Webmaxx\Seo\Classes\ContentTagManager;

abstract class BaseGenerator implements GeneratorContract
{
    protected $tagManager;

    public function __construct(ContentTagManager $tagManager)
    {
        $this->tagManager = $tagManager;

        $this->loadTags();
    }

    public function tags(): array
    {
        return $this->tagManager->tags();
    }

    public function render(): string
    {
        return $this->tagManager->render(
            $this->getBody()
        );
    }

    protected function loadTags()
    {
        $this->tagManager->addTags(array_merge(
            app('wmSeoGeneratorDefaultContentTagsPreset')->tags(),
            $this->extendedTags(),
        ));
    }

    abstract protected function getBody(): string;

    protected function extendedTags(): array
    {
        return [];
    }
}
