<?php

declare(strict_types=1);

namespace Webmaxx\Seo\Classes\Metatags;

abstract class BaseMetaTag implements MetaTagContract
{
    protected $type;
    protected $name;

    protected $context;

    public function __construct(MetaTagContext|string|null $context)
    {
        $this->context = $context;
    }

    public function render(): ?string
    {
        $content = $this->content();

        if (!$content) {
            return null;
        }

        return match($this->type) {
            'title' => "<title>{$content}</title>",
            'meta' => "<meta name=\"{$this->name}\" content=\"{$content}\">",
            'og' => "<meta property=\"og:{$this->name}\" content=\"{$content}\">",
            'raw' => $content,
        };
    }

    abstract protected function content(): ?string;
}
