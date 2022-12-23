<?php

declare(strict_types=1);

namespace Webmaxx\Seo\Classes\Generators;

use Winter\Storm\Argon\Argon;
use Webmaxx\Seo\Models\Settings;

class SecurityTxtGenerator extends BaseGenerator
{
    protected function getBody(): string
    {
        return collect(Settings::get('security_txt_form'))
            ->map(function($item, $key) {
                if (is_array($item)) {
                    return collect($item)
                        ->pluck('value')
                        ->map(fn($item) => ucfirst($key) . ': ' . $item)
                        ->implode("\n");
                }

                if ($key == 'expires' && $item) {
                    $expiries = Argon::createFromFormat('Y-m-d H:i:s', $item)->toIso8601String();
                    return "Expires: {$expiries}";
                }

                if ($key == 'preferred_languages' && $item) {
                    return "Preferred-Languages: {$item}";
                }
            })
            ->implode("\n");
    }

    protected function extendedTags(): array
    {
        return app('wmSeoGeneratorSecurityTxtContentTagsPreset')->tags();
    }
}
