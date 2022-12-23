<?php

declare(strict_types=1);

namespace Webmaxx\Seo\Classes\Generators;

interface GeneratorContract
{
    public function tags(): array;

    public function render(): string;
}
