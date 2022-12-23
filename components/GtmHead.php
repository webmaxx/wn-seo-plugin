<?php namespace Webmaxx\Seo\Components;

use Cms\Classes\ComponentBase;
use Webmaxx\Seo\Models\Settings;

class GtmHead extends ComponentBase
{
    public function componentDetails()
    {
        return [
            'name'        => 'webmaxx.seo::lang.components.gtmHead.name',
            'description' => 'webmaxx.seo::lang.components.gtmHead.description',
        ];
    }

    public function defineProperties()
    {
        return [
            'gtm_code' => [
                'title'       => 'webmaxx.seo::lang.components.gtmHead.properties.gtm_code.title',
                'description' => 'webmaxx.seo::lang.components.gtmHead.properties.gtm_code.description',
                'type'        => 'string',
            ],
        ];
    }

    public function code()
    {
        return $this->property('gtm_code') ?: Settings::get('gtm_code');
    }
}
