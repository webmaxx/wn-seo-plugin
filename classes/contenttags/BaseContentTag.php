<?php

declare(strict_types=1);

namespace Webmaxx\Seo\Classes\ContentTags;

abstract class BaseContentTag implements ContentTagContract
{
    protected $tagPrefix = '{{';
    protected $tagPostfix = '}}';

    protected $name;
    protected $description;

    protected $context;

    public function __construct($context = null)
    {
        $this->context = $context;
    }

    public function name(): string
    {
        return $this->name;
    }

    public function description(): string
    {
        return $this->description ?: $this->name;
    }

    public function tag(): string
    {
        return "{$this->tagPrefix} {$this->name} {$this->tagPostfix}";
    }

    public function render(string $content): string
    {
        preg_match_all(
            "#{$this->tagPrefix}[\s]{0,}({$this->name})[\s]{0,}{$this->tagPostfix}#ui",
            $content,
            $matches
        );

        if ($matches[0]) {
            $content = str_replace($matches[0], $this->value(), $content);
        }

        return $content;
    }

    protected function context()
    {
        return value($this->context);
    }

    abstract public function value(): string|int;
}
