<?php

declare(strict_types=1);

namespace Webmaxx\Seo\Classes\Generators;

use Webmaxx\Seo\Models\Settings;

class AppAdsTxtGenerator extends BaseGenerator
{
    protected function getBody(): string
    {
        return collect()
            ->when($this->loadRows(), fn($collection, $value) => $collection->push($value))
            ->when($this->loadVars(), fn($collection, $value) => $collection->push($value))
            ->implode("\n");
    }

    protected function loadRows(): string
    {
        return collect(Settings::get('app_ads_txt_rows'))
            ->implode(function($row) {
                if (!$row['tag_id']) {
                    unset($row['tag_id']);
                }

                return implode(', ', $row);
            }, "\n");
    }

    protected function loadVars(): string
    {
        return collect(Settings::get('app_ads_txt_vars'))
            ->implode(fn($var) => implode('=', $var), "\n");
    }

    protected function extendedTags(): array
    {
        return app('wmSeoGeneratorAppAdsTxtContentTagsPreset')->tags();
    }
}
