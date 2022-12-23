<?php

declare(strict_types=1);

namespace Webmaxx\Seo\Classes\ContentTags;

interface ContentTagContract
{
    public function name(): string;

    public function tag(): string;

    public function description(): string;

    public function value(): string|int;

    public function render(string $content): string;
}
