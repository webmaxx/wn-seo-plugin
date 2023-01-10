<?php namespace Webmaxx\Seo;

use App;
use Backend;
use Event;
use Yaml;
use Backend\Models\UserRole;
use System\Classes\PluginBase;
use System\Classes\PluginManager;
use System\Classes\SettingsManager;
use Webmaxx\Seo\Classes\ContentTags\Presets\ComponentTagsPreset;
use Webmaxx\Seo\Classes\ContentTags\Presets\GeneratorAdsTxtPreset;
use Webmaxx\Seo\Classes\ContentTags\Presets\GeneratorAppAdsTxtPreset;
use Webmaxx\Seo\Classes\ContentTags\Presets\GeneratorDefaultPreset;
use Webmaxx\Seo\Classes\ContentTags\Presets\GeneratorHumansTxtPreset;
use Webmaxx\Seo\Classes\ContentTags\Presets\GeneratorRobotsTxtPreset;
use Webmaxx\Seo\Classes\ContentTags\Presets\GeneratorSecurityTxtPreset;

/**
 * Seo Plugin Information File
 */
class Plugin extends PluginBase
{
    /**
     * Returns information about this plugin.
     */
    public function pluginDetails(): array
    {
        return [
            'name'        => 'webmaxx.seo::lang.plugin.name',
            'description' => 'webmaxx.seo::lang.plugin.description',
            'author'      => 'Webmaxx',
            'homepage'    => 'https://github.com/webmaxx/wn-seo-plugin',
            'icon'        => 'icon-globe'
        ];
    }

    /**
     * Register method, called when the plugin is first registered.
     */
    public function register(): void
    {
        App::singleton('wmSeoGeneratorDefaultContentTagsPreset',     fn() => new GeneratorDefaultPreset);
        App::singleton('wmSeoGeneratorRobotsTxtContentTagsPreset',   fn() => new GeneratorRobotsTxtPreset);
        App::singleton('wmSeoGeneratorHumansTxtContentTagsPreset',   fn() => new GeneratorHumansTxtPreset);
        App::singleton('wmSeoGeneratorSecurityTxtContentTagsPreset', fn() => new GeneratorSecurityTxtPreset);
        App::singleton('wmSeoGeneratorAdsTxtContentTagsPreset',      fn() => new GeneratorAdsTxtPreset);
        App::singleton('wmSeoGeneratorAppAdsTxtContentTagsPreset',   fn() => new GeneratorAppAdsTxtPreset);
        App::singleton('wmSeoComponentTagsContentTagsPreset',        fn() => new ComponentTagsPreset);

        \Event::listen('webmaxx.seo.generators.extendDefaultContentTags', function(...$tags) {
            app('wmSeoGeneratorDefaultContentTagsPreset')->addTags($tags);
        });

        \Event::listen('webmaxx.seo.generators.robotsTxt.extendContentTags', function(...$tags) {
            app('wmSeoGeneratorRobotsTxtContentTagsPreset')->addTags($tags);
        });

        \Event::listen('webmaxx.seo.generators.humansTxt.extendContentTags', function(...$tags) {
            app('wmSeoGeneratorHumansTxtContentTagsPreset')->addTags($tags);
        });

        \Event::listen('webmaxx.seo.generators.securityTxt.extendContentTags', function(...$tags) {
            app('wmSeoGeneratorSecurityTxtContentTagsPreset')->addTags($tags);
        });

        \Event::listen('webmaxx.seo.generators.adsTxt.extendContentTags', function(...$tags) {
            app('wmSeoGeneratorAdsTxtContentTagsPreset')->addTags($tags);
        });

        \Event::listen('webmaxx.seo.generators.appAdsTxt.extendContentTags', function(...$tags) {
            app('wmSeoGeneratorAppAdsTxtContentTagsPreset')->addTags($tags);
        });

        \Event::listen('webmaxx.seo.component.tags.extendContentTags', function(...$tags) {
            app('wmSeoComponentTagsContentTagsPreset')->addTags($tags);
        });
    }

    /**
     * Boot method, called right before the request route.
     */
    public function boot(): void
    {
        $this->extendPagesForms();
    }

    /**
     * Registers any frontend components implemented in this plugin.
     */
    public function registerComponents(): array
    {
        return [
            'Webmaxx\Seo\Components\Counters'    => 'wmSeoCounters',
            'Webmaxx\Seo\Components\Tags'        => 'wmSeoTags',
            'Webmaxx\Seo\Components\GtmHead'     => 'wmSeoGtmHead',
            'Webmaxx\Seo\Components\GtmNoScript' => 'wmSeoGtmNoScript',
            'Webmaxx\Seo\Components\MicroData'   => 'wmMicroData',
        ];
    }

    /**
     * Registers any backend permissions used by this plugin.
     */
    public function registerPermissions(): array
    {
        return [
            'webmaxx.seo.settings_access' => [
                'tab'   => 'webmaxx.seo::lang.plugin.name',
                'label' => 'webmaxx.seo::lang.permissions.settings_access',
                'roles' => [UserRole::CODE_DEVELOPER, UserRole::CODE_PUBLISHER],
            ],
        ];
    }

    /**
     * Registers backend navigation items for this plugin.
     */
    public function registerNavigation(): array
    {
        return []; // Remove this line to activate

        return [
            'seo' => [
                'label'       => 'webmaxx.seo::lang.plugin.name',
                'url'         => Backend::url('webmaxx/seo/mycontroller'),
                'icon'        => 'icon-leaf',
                'permissions' => ['webmaxx.seo.*'],
                'order'       => 500,
            ],
        ];
    }

    /**
     * Registers backend settings for this plugin.
     */
    public function registerSettings(): array
    {
        return [
            'seo' => [
                'category'    => SettingsManager::CATEGORY_CMS,
                'class'       => 'Webmaxx\Seo\Models\Settings',
                'label'       => 'webmaxx.seo::lang.models.settings.label',
                'description' => 'webmaxx.seo::lang.models.settings.description',
                'icon'        => 'icon-globe',
                'permissions' => ['webmaxx.seo.settings_access'],
            ]
        ];
    }

    protected function extendPagesForms(): void
    {
        Event::listen('backend.form.extendFieldsBefore', function(\Backend\Widgets\Form $widget) {
            if ($widget->isNested) {
                return;
            }

            if ($widget->model instanceof \Cms\Classes\Page) {
                $this->addSeoTabFieldsToWidget($widget, 'settings');
            }

            if (
                PluginManager::instance()->hasPlugin('Winter.Pages')
                && $widget->model instanceof \Winter\Pages\Classes\Page
            ) {
                $this->addSeoTabFieldsToWidget($widget, 'viewBag');
            }

            if (
                $widget->model instanceof \Model
                && $widget->model->isClassExtendedWith(\Webmaxx\Seo\Behaviors\SeoTaggable::class)
            ) {
                $this->addSeoTabFieldsToWidget($widget, $widget->model->seoTaggableRelationField() . '[tags]');
            }
        });
    }

    protected function addSeoTabFieldsToWidget($widget, $key): void
    {
        unset($widget->tabs['fields']["{$key}[meta_title]"]);
        unset($widget->tabs['fields']["{$key}[meta_description]"]);

        $form = Yaml::parseFile(plugins_path('webmaxx/seo/models/meta/fields.yaml'));

        $halcyonFields = [];
        foreach ($form['fields'] as $name => $config) {
            $halcyonFields["{$key}[{$name}]"] = $config;
        }

        $widget->tabs = $widget->tabs ?: ['fields' => []];

        $widget->tabs['fields'] = array_merge($widget->tabs['fields'], $halcyonFields);
    }
}
