<?php

return [
    'plugin' => [
        'name' => 'wmSeo',
        'description' => 'Различные seo-настройки + файлы robots.txt, humans.txt и т.п.',
    ],
    'permissions' => [
        'meta_access' => 'Доступ к мета-тегам страниц',
        'settings_access' => 'Доступ к seo-настройкам',
    ],
    'models' => [
        'meta' => [
            'tabs' => [
                'seo_meta' => '[SEO] Meta',
                'seo_og' => '[SEO] OpenGraph',
                'seo_microdata' => '[SEO] MicroData',
            ],
            'fields' => [
                'meta_title' => [
                    'label' => 'Title',
                ],
                'meta_description' => [
                    'label' => 'Meta Description',
                ],
                'meta_keywords' => [
                    'label' => 'Meta Keywords',
                ],
                'meta_robots_index' => [
                    'label' => 'Robots Index',
                ],
                'meta_robots_follow' => [
                    'label' => 'Robots Follow',
                ],
                'meta_canonical_url' => [
                    'label' => 'Cannonical URL',
                ],
                'meta_redirect_url' => [
                    'label' => 'Redirect URL',
                ],
                'meta_custom_tags' => [
                    'label' => 'Пользовательские meta-теги',
                ],
                'og_type' => [
                    'label' => 'Type',
                ],
                'og_title' => [
                    'label' => 'Title',
                ],
                'og_description' => [
                    'label' => 'Description',
                ],
                'og_image' => [
                    'label' => 'Image',
                ],
                'og_url' => [
                    'label' => 'Url',
                ],
                'og_custom_tags' => [
                    'label' => 'Пользовательские OpenGraph-теги',
                ],
                'available_tags' => [
                    'label' => 'Доступные теги:',
                    'comment' => 'Щелкните или перетащите их в область содержимого',
                ],
                'microdata_content' => [
                    'label' => 'Пользовательская микроразметка',
                ],
            ],
        ],
        'settings' => [
            'label' => 'SEO',
            'description' => 'Настройки SEO',
            'tabs' => [
                'site' => 'Общие настройки сайта',
                'url_settings' => 'Настройки URL',
                'meta_tags' => 'META-теги',
                'og_tags' => 'Open Graph',
                'microdata' => 'Микроразметка',
                'counters' => 'Счётчики',
                'robots_txt' => 'Robots.txt',
                'humans_txt' => 'Humans.txt',
                'security_txt' => 'Security.txt',
                'ads_txt' => 'Ads.txt',
                'app_ads_txt' => 'App-Ads.txt',
            ],
            'fields' => [
                'site_name' => [
                    'label' => 'Название сайта',
                    'placeholder' => 'Название сайта',
                ],
                'current_url_as_canonical' => [
                    'label' => 'Использовать текущий URL как Canonical',
                    'comment' => 'Если для страницы не будет задан Canonical URL, то будет использоватья текущий URL-адрес страницы',
                ],
                'page_title_prefix' => [
                    'label' => 'Префикс в заголовке страницы',
                    'placeholder' => 'Site Name -',
                ],
                'page_title_postfix' => [
                    'label' => 'Постфикс в заголовке страницы',
                    'placeholder' => '- Site Name',
                ],
                'url_use_redirect' => [
                    'label' => 'Перенаправление',
                    'comment' => 'Использовать редирект, если URL-адрес не соответствует настройкам',
                ],
                'url_force_https' => [
                    'label' => 'Использовать HTTPS',
                    'comment' => 'Принудительное использование HTTPS',
                ],
                'url_www_prefix' => [
                    'label' => 'Префикс "www"',
                    'options' => [
                        'none' => 'Без предпочтений',
                        'use' => 'Использовать',
                        'unuse' => 'Не использовать',
                    ],
                ],
                'url_trailing_slash' => [
                    'label' => 'Завершающая косая черта',
                    'comment' => 'Не будет применяться к URL-адресам которые заканчиваются расширением файла.',
                    'options' => [
                        'none' => 'Без предпочтений',
                        'use' => 'Использовать',
                        'unuse' => 'Не использовать',
                    ],
                ],
                'url_ignore' => [
                    'label' => 'Пути, которые следует игнорировать',
                    'comment' => 'Вы можете предоставить список путей относительно корневого URL, в которых нормализация не произойдет. Чтобы включить все вложенные папки и файлы, используйте подстановочный знак *.',
                ],
                'meta_robots_index' => [
                    'label' => 'Robots Index',
                ],
                'meta_robots_follow' => [
                    'label' => 'Robots Follow',
                ],
                'custom_meta_tags' => [
                    'label' => 'Пользовательские meta-теги',
                ],
                'og_image' => [
                    'label' => 'Изображение по-умолчанию',
                ],
                'custom_og_tags' => [
                    'label' => 'Пользовательские OpenGraph теги',
                ],
                'custom_microdata_content' => [
                    'label' => 'Пользовательская микроразметка',
                ],
                'gtm_code' => [
                    'label' => 'Google Tag Manager ID',
                ],
                'counters' => [
                    'label' => 'Коды метрики, google analytics и т.п.',
                ],
                'robots_txt_enabled' => [
                    'label' => 'Включить',
                ],
                'robots_txt_available_tags' => [
                    'label' => 'Доступные теги:',
                    'comment' => 'Щелкните или перетащите их в область содержимого',
                ],
                'humans_txt_info' => [
                    'label' => 'Подробнее о файле',
                ],
                'humans_txt_enabled' => [
                    'label' => 'Включить',
                ],
                'humans_txt_available_tags' => [
                    'label' => 'Доступные теги:',
                    'comment' => 'Щелкните или перетащите их в область содержимого',
                ],
                'security_txt_info' => [
                    'label' => 'Подробнее о файле',
                ],
                'security_txt_enabled' => [
                    'label' => 'Включить',
                ],
                'security_txt_form' => [
                    'contact' => [
                        'label' => 'Контакт',
                        'comment' => '<i class="text-danger">Обязательно</i><br> Ссылка или адрес электронной почты, по которым люди могут связаться с вами по вопросам безопасности. Не забудьте указать "https://" для URL-адресов и "mailto:" для электронных писем. Смотрите <a href="https://www.rfc-editor.org/rfc/rfc9116#section-2.5.3" target="_blank">полное описание Contact</a>',
                        'prompt' => 'Добавить дополнительный контакт',
                        'fields' => [
                            'contact' => [
                                'label' => 'Контакт',
                            ],
                        ],
                    ],
                    'expires' => [
                        'label' => 'Истекает',
                        'comment' => '<i class="text-danger">Обязательно</i><br> Дата и время, когда содержание security.txt файл следует считать устаревшим (поэтому исследователи безопасности не должны ему доверять). Убедитесь, что вы периодически обновляете это значение и постоянно просматриваете свой файл. Смотрите <a href="https://www.rfc-editor.org/rfc/rfc9116#section-2.5.5" target="_blank">полное описание Expires</a>',
                    ],
                    'encryption' => [
                        'label' => 'Шифрование',
                        'comment' => '<i class="text-success">Опционально</i><br> Ссылка на ключ, который исследователи безопасности должны использовать для безопасного общения с вами. Не забудьте включить "https://". Смотрите <a href="https://www.rfc-editor.org/rfc/rfc9116#section-2.5.4" target="_blank">полное описание Encryption</a>',
                        'prompt' => 'Добавить ссылку',
                        'fields' => [
                            'url' => [
                                'label' => 'URL-адрес',
                            ],
                        ],
                    ],
                    'acknowledgments' => [
                        'label' => 'Благодарность',
                        'comment' => '<i class="text-success">Опционально</i><br> Ссылка на веб-страницу, где вы выражаете благодарность исследователям безопасности, которые помогли вам. Не забудьте включить "https://". Смотрите <a href="https://www.rfc-editor.org/rfc/rfc9116#section-2.5.1" target="_blank">полное описание Acknowledgments</a>',
                        'prompt' => 'Добавить ссылку',
                        'fields' => [
                            'url' => [
                                'label' => 'URL-адрес',
                            ],
                        ],
                    ],
                    'preferred_languages' => [
                        'label' => 'Предпочитаемые языки',
                        'comment' => '<i class="text-success">Опционально</i><br> Разделенный запятыми список языковых кодов, на которых говорит ваша служба безопасности. <b>Вы можете включить более одного языка</b>. Смотрите <a href="https://www.rfc-editor.org/rfc/rfc9116#section-2.5.8" target="_blank">полное описание Preferred-Languages</a>',
                    ],
                    'canonical' => [
                        'label' => 'Canonical',
                        'comment' => '<i class="text-success">Опционально</i><br> URL-адреса для доступа к вашему файлу security.txt. Важно включить это, если вы подписываете цифровым способом security.txt файл, так что местоположение security.txt файл также может быть подписан цифровой подписью. Смотрите <a href="https://www.rfc-editor.org/rfc/rfc9116#section-2.5.2" target="_blank">полное описание Canonical</a>',
                        'prompt' => 'Добавить ссылку',
                        'fields' => [
                            'url' => [
                                'label' => 'URL-адрес',
                            ],
                        ],
                    ],
                    'policy' => [
                        'label' => 'Политика',
                        'comment' => '<i class="text-success">Опционально</i><br> Ссылка на политику, подробно описывающую, что должны делать исследователи безопасности при поиске проблем безопасности или сообщении о них. Не забудьте включить "https://". Смотрите <a href="https://www.rfc-editor.org/rfc/rfc9116#section-2.5.7" target="_blank">полное описание Policy</a>',
                        'prompt' => 'Добавить ссылку',
                        'fields' => [
                            'url' => [
                                'label' => 'URL-адрес',
                            ],
                        ],
                    ],
                    'hiring' => [
                        'label' => 'Найм',
                        'comment' => '<i class="text-success">Опционально</i><br> Ссылка на любые вакансии, связанные с безопасностью, в вашей организации. Не забудьте включить "https://". Смотрите <a href="https://www.rfc-editor.org/rfc/rfc9116#section-2.5.6" target="_blank">полное описание Hiring</a>',
                        'prompt' => 'Добавить ссылку',
                        'fields' => [
                            'url' => [
                                'label' => 'URL-адрес',
                            ],
                        ],
                    ],
                ],
                'security_txt_available_tags' => [
                    'label' => 'Доступные теги:',
                    'comment' => 'Щелкните или перетащите их в область содержимого',
                ],
                'ads_txt_info' => [
                    'label' => 'Подробнее о файле',
                ],
                'ads_txt_enabled' => [
                    'label' => 'Включить',
                ],
                'ads_txt_rows' => [
                    'label' => 'Записи',
                    'prompt' => 'Добавить новую запись',
                ],
                'ads_txt_vars' => [
                    'label' => 'Переменные',
                    'prompt' => 'Добавить новую переменную',
                    'fields' => [
                        'type' => [
                            'label' => 'Тип переменной',
                        ],
                        'value' => [
                            'label' => 'Значение переменной',
                        ],
                    ],
                ],
                'ads_txt_available_tags' => [
                    'label' => 'Доступные теги:',
                    'comment' => 'Щелкните или перетащите их в область содержимого',
                ],
                'app_ads_txt_info' => [
                    'label' => 'Подробнее о файле',
                ],
                'app_ads_txt_enabled' => [
                    'label' => 'Включить',
                ],
                'app_ads_txt_rows' => [
                    'label' => 'Записи',
                    'prompt' => 'Добавить новую запись',
                ],
                'app_ads_txt_vars' => [
                    'label' => 'Переменные',
                    'prompt' => 'Добавить новую переменную',
                    'fields' => [
                        'type' => [
                            'label' => 'Тип переменной',
                        ],
                        'value' => [
                            'label' => 'Значение переменной',
                        ],
                    ],
                ],
                'app_ads_txt_available_tags' => [
                    'label' => 'Доступные теги:',
                    'comment' => 'Щелкните или перетащите их в область содержимого',
                ],
            ],
        ],
    ],
    'components' => [
        'counters' => [
            'name' => 'Счётчики',
            'description' => 'Коды метрики, google analytics и т.п.',
            'properties' => [
                'counters_code' => [
                    'title' => 'Счётчики',
                    'description' => 'Код счётчиков для отображения',
                ],
                'show_global_counters' => [
                    'title' => 'Глобальные счётчики',
                    'description' => 'Отображать счётчики из глобальных настроек',
                ],
            ],
        ],
        'gtmHead' => [
            'name' => 'GTM Head',
            'description' => 'Код Google Tag Manager',
            'properties' => [
                'gtm_code' => [
                    'title' => 'Google Tag Manager ID',
                    'description' => 'Идентификатор Google Tag Manager. Если не заполнять, будет использоваться код из глобальных настроек',
                ],
            ],
        ],
        'gtmNoScript' => [
            'name' => 'GTM NoScript',
            'description' => 'Код Google Tag Manager',
            'properties' => [
                'gtm_code' => [
                    'title' => 'Google Tag Manager ID',
                    'description' => 'Идентификатор Google Tag Manager. Если не заполнять, будет использоваться код из глобальных настроек',
                ],
            ],
        ],
        'tags' => [
            'name' => 'Теги',
            'description' => 'Отображение meta-тегов, OpenGraph и т.п.',
            'properties' => [
                'show_global_custom_meta' => [
                    'title' => 'Глобальные мета-теги',
                    'description' => 'Отображать пользовательские мета-теги из глобальных настроек',
                ],
                'show_global_custom_og' => [
                    'title' => 'Глобальные OpenGraph теги',
                    'description' => 'Отображать пользовательские OpenGraph теги из глобальных настроек',
                ],
            ],
        ],
    ],
    'contentTags' => [
        'domain' => 'Домен сайта',
        'siteName' => 'Название сайта',
        'siteUrl' => 'Url-адрес сайта',
        'currentUrl' => 'Url-адрес текущей страницы сайта',
        'currentUrlWithQuery' => 'Url-адрес текущей страницы сайта с GET-параметрами',
    ],
];
