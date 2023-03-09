<?php namespace Webmaxx\Seo;

use App;
use Backend;
use Event;
use Yaml;
use Backend\Models\UserRole;
use System\Classes\PluginBase;
use System\Classes\PluginManager;
use System\Classes\SettingsManager;
use Webmaxx\Seo\Classes\ContentTags\Presets;
use Webmaxx\Seo\Classes\UrlNormalizer;
use Webmaxx\Seo\Middlewares\UrlNormalizeMiddleware;

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
        App::singleton('wmSeoGeneratorDefaultContentTagsPreset',     fn() => new Presets\GeneratorDefaultPreset);
        App::singleton('wmSeoGeneratorRobotsTxtContentTagsPreset',   fn() => new Presets\GeneratorRobotsTxtPreset);
        App::singleton('wmSeoGeneratorHumansTxtContentTagsPreset',   fn() => new Presets\GeneratorHumansTxtPreset);
        App::singleton('wmSeoGeneratorSecurityTxtContentTagsPreset', fn() => new Presets\GeneratorSecurityTxtPreset);
        App::singleton('wmSeoGeneratorAdsTxtContentTagsPreset',      fn() => new Presets\GeneratorAdsTxtPreset);
        App::singleton('wmSeoGeneratorAppAdsTxtContentTagsPreset',   fn() => new Presets\GeneratorAppAdsTxtPreset);
        App::singleton('wmSeoComponentTagsContentTagsPreset',        fn() => new Presets\ComponentTagsPreset);

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
        $this->extendMiddlewares();
        $this->extendPagesForms();
        $this->normalizeUrls();
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

    public function registerMarkupTags()
    {
        return [
            'filters' => [
                'urlNormalize' => function ($text, $force = false) {
                    return UrlNormalizer::normalize($text, $force);
                },
            ],
        ];
    }

    protected function extendMiddlewares()
    {
        $this->app['Illuminate\Contracts\Http\Kernel']
            ->prependMiddleware(UrlNormalizeMiddleware::class);
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

    protected function normalizeUrls()
    {
        Event::listen('pages.menu.referencesGenerated', function (&$items) {
            $iterator = function ($menuItems) use (&$iterator) {
                $result = [];

                foreach ($menuItems as $item) {
                    if ($item->items) {
                        $item->items = $iterator($item->items);
                    }
                    if (isset($item->normalized)) {
                        continue;
                    }

                    if (!empty($item->url) && substr($item->url, 0, 1) !== '#') {
                        $originalUrl = $item->url;
                        $normalizedUrl = UrlNormalizer::normalize($item->url);

                        if ($originalUrl !== $normalizedUrl) {
                            $item->url = $normalizedUrl;
                            $item->normalized = true;
                        } else {
                            $item->normalized = false;
                        }
                    } else {
                        $item->normalized = true;
                    }

                    $result[] = $item;
                }

                return $result;
            };

            $items = $iterator($items);
        });
    }
}
