<?php namespace Webmaxx\Seo\Behaviors;

use Event;
use Webmaxx\Seo\Classes\ContentTags\PageTitleTag;
use Winter\Storm\Extension\ExtensionBase;

class SeoTaggable extends ExtensionBase
{
    protected $model;

    public function __construct($parent)
    {
        $this->model = $parent;

        $this->model->morphOne[$this->seoTaggableRelationField()] = [
            \Webmaxx\Seo\Models\Tags::class,
            'name' => 'taggable',
        ];
    }

    public function generateSeoTags(): void
    {
        Event::fire('webmaxx.seo.component.tags.loadSeoTaggableModel', $this->model);
    }

    public function seoTaggableRelationField(): string
    {
        return data_get($this->model, 'seoTaggableRelationField', 'wmseo');
    }

    public function seoPageTitle(): string
    {
        return method_exists($this->model, 'seoPageTitle')
            ? $this->model->seoPageTitle()
            : '';
    }

    public function extendedSeoContentTags(): array
    {
        return [
            [PageTitleTag::class, $this->seoPageTitle()],
        ];
    }
}
