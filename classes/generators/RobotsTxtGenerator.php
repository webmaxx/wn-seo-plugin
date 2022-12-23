<?php

declare(strict_types=1);

namespace Webmaxx\Seo\Classes\Generators;

use Webmaxx\Seo\Models\Settings;

class RobotsTxtGenerator extends BaseGenerator
{
    protected function getBody(): string
    {
        return Settings::get('robots_txt_body');
    }

    protected function extendedTags(): array
    {
        return app('wmSeoGeneratorRobotsTxtContentTagsPreset')->tags();
    }
}
