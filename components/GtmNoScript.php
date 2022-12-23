<?php namespace Webmaxx\Seo\Components;

use Cms\Classes\ComponentBase;
use Webmaxx\Seo\Models\Settings;

class GtmNoScript extends ComponentBase
{
    public function componentDetails()
    {
        return [
            'name'        => 'webmaxx.seo::lang.components.gtmNoScript.name',
            'description' => 'webmaxx.seo::lang.components.gtmNoScript.description',
        ];
    }

    public function defineProperties()
    {
        return [
            'gtm_code' => [
                'title'       => 'webmaxx.seo::lang.components.gtmNoScript.properties.gtm_code.title',
                'description' => 'webmaxx.seo::lang.components.gtmNoScript.properties.gtm_code.description',
                'type'        => 'string',
            ],
        ];
    }

    public function code()
    {
        return $this->property('gtm_code') ?: Settings::get('gtm_code');
    }
}
