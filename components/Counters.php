<?php namespace Webmaxx\Seo\Components;

use Cms\Classes\ComponentBase;
use Webmaxx\Seo\Models\Settings;

class Counters extends ComponentBase
{
    public function componentDetails()
    {
        return [
            'name'        => 'webmaxx.seo::lang.components.counters.name',
            'description' => 'webmaxx.seo::lang.components.counters.description',
        ];
    }

    public function defineProperties()
    {
        return [
            'counters_code' => [
                'title'       => 'webmaxx.seo::lang.components.counters.properties.counters_code.title',
                'description' => 'webmaxx.seo::lang.components.counters.properties.counters_code.description',
                'type'        => 'text',
            ],
            'show_global_counters' => [
                'title'       => 'webmaxx.seo::lang.components.counters.properties.show_global_counters.title',
                'description' => 'webmaxx.seo::lang.components.counters.properties.show_global_counters.description',
                'type'        => 'checkbox',
                'default'     => true,
            ],
        ];
    }

    public function counters()
    {
        return collect()
            ->when(
                $this->property('show_global_counters'),
                fn($collection) => $collection->when(
                    trim(Settings::get('counters')),
                    fn($collection, $content) => $collection->push($content)
                )
            )
            ->when(
                trim($this->property('counters_code')),
                fn($collection, $content) => $collection->push($content)
            )
            ->implode("\n");
    }
}
