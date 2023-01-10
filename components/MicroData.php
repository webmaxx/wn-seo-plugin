<?php namespace Webmaxx\Seo\Components;

use Event;
use Cms\Classes\ComponentBase;

class MicroData extends ComponentBase
{
    protected $modelMicrodataContent;

    public function componentDetails()
    {
        return [
            'name'        => 'webmaxx.seo::lang.components.microdata.name',
            'description' => 'webmaxx.seo::lang.components.microdata.description',
        ];
    }

    public function defineProperties()
    {
        return [];
    }

    public function onRun()
    {
        Event::listen('webmaxx.seo.component.tags.loadSeoTaggableModel', function($model) {
            $this->modelMicrodataContent = data_get($model, $model->seoTaggableRelationField() . '.tags.microdata_content');
        });
    }

    public function microdata()
    {
        return $this->modelMicrodataContent ?: $this->page->microdata_content;
    }
}
