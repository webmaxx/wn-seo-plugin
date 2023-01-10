<?php namespace Webmaxx\Seo\Components;

use Event;
use Cms\Classes\ComponentBase;
use Webmaxx\Seo\Classes\ContentTagManager;
use Webmaxx\Seo\Classes\MetaTagManager;
use Webmaxx\Seo\Classes\Metatags\MetaCanonicalTag;
use Webmaxx\Seo\Classes\Metatags\MetaDescriptionTag;
use Webmaxx\Seo\Classes\Metatags\MetaKeywordsTag;
use Webmaxx\Seo\Classes\Metatags\MetaRobotsTag;
use Webmaxx\Seo\Classes\Metatags\MetaTagContext;
use Webmaxx\Seo\Classes\Metatags\OgDescriptionTag;
use Webmaxx\Seo\Classes\Metatags\OgImageTag;
use Webmaxx\Seo\Classes\Metatags\OgTitleTag;
use Webmaxx\Seo\Classes\Metatags\OgTypeTag;
use Webmaxx\Seo\Classes\Metatags\OgUrlTag;
use Webmaxx\Seo\Classes\Metatags\RawTag;
use Webmaxx\Seo\Classes\Metatags\TitleTag;
use Webmaxx\Seo\Models\Settings;

class Tags extends ComponentBase
{
    protected $metaTagManager;
    protected $contentTagManager;
    protected $seoTaggableModelTags = [];
    protected $microdata;

    public function componentDetails()
    {
        return [
            'name'        => 'webmaxx.seo::lang.components.tags.name',
            'description' => 'webmaxx.seo::lang.components.tags.description',
        ];
    }

    public function defineProperties()
    {
        return [
            'show_global_custom_meta' => [
                'title'       => 'webmaxx.seo::lang.components.tags.properties.show_global_custom_meta.title',
                'description' => 'webmaxx.seo::lang.components.tags.properties.show_global_custom_meta.description',
                'type'        => 'checkbox',
                'default'     => true,
            ],
            'show_global_custom_og' => [
                'title'       => 'webmaxx.seo::lang.components.tags.properties.show_global_custom_og.title',
                'description' => 'webmaxx.seo::lang.components.tags.properties.show_global_custom_og.description',
                'type'        => 'checkbox',
                'default'     => true,
            ],
        ];
    }

    public function onRun()
    {
        Event::listen('webmaxx.seo.component.tags.loadSeoTaggableModel', function($model) {
            $this->seoTaggableModelTags = data_get($model, $model->seoTaggableRelationField() . '.tags');
            $this->seoTaggableModelTags['page_title'] = $model->seoPageTitle();
            $this->modelMicrodataContent = data_get($model, $model->seoTaggableRelationField() . '.tags.microdata_content');
            app('wmSeoComponentTagsContentTagsPreset')->addTags($model->extendedSeoContentTags());
        });
    }

    public function tags(): string
    {
        $contentTagManager = $this->getContentTagManager();

        $context = new MetaTagContext($this->page, $this->seoTaggableModelTags);

        return $this->getMetaTagManager()
            ->addTags([
                new TitleTag($context),
                new MetaDescriptionTag($context),
                new MetaKeywordsTag($context),
                new MetaRobotsTag($context),
                new MetaCanonicalTag($context),
            ])
            ->addTagIf($this->property('show_global_custom_meta'), new RawTag(Settings::get('custom_meta_tags')))
            ->addTag(new RawTag($this->page->meta_custom_tags))
            ->addTag(new RawTag(data_get($this->seoTaggableModelTags, 'meta_custom_tags', '')))
            ->addTags([
                new OgTypeTag($context),
                new OgTitleTag($context),
                new OgDescriptionTag($context),
                new OgImageTag($context),
                new OgUrlTag($context),
            ])
            ->addTagIf($this->property('show_global_custom_og'), new RawTag(Settings::get('custom_og_tags')))
            ->addTag(new RawTag($this->page->og_custom_tags))
            ->addTag(new RawTag(data_get($this->seoTaggableModelTags, 'og_custom_tags', '')))
            ->renderWithContentTags($contentTagManager);
    }

    public function microdata(): string
    {
        if ($this->microdata === null) {
            $this->microdata = $this->getContentTagManager()
                ->render(implode("\n", [
                    Settings::get('custom_microdata_content'),
                    data_get($this->seoTaggableModelTags, 'microdata_content', $this->page->microdata_content),
                ]));
        }

        return $this->microdata;
    }

    protected function getMetaTagManager()
    {
        if ($this->metaTagManager === null) {
            $this->metaTagManager = app(MetaTagManager::class);
        }

        return $this->metaTagManager;
    }

    protected function getContentTagManager()
    {
        if ($this->contentTagManager === null) {
            $this->contentTagManager = app(ContentTagManager::class);
            $this->contentTagManager->addTags(app('wmSeoComponentTagsContentTagsPreset'));
        }

        return $this->contentTagManager;
    }
}
