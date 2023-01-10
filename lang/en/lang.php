<?php

return [
    'plugin' => [
        'name' => 'wmSeo',
        'description' => 'Manage SEO settings for your website',
    ],
    'permissions' => [
        'meta_access' => 'Manage pages meta tags',
        'settings_access' => 'Manage SEO settings',
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
                    'label' => 'Custom meta tags',
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
                    'label' => 'Custom Open Graph tags',
                ],
                'available_tags' => [
                    'label' => 'These tags are available:',
                    'comment' => 'Click or drag these in to the content area',
                ],
                'microdata_content' => [
                    'label' => 'MicroData content',
                ],
            ],
        ],
        'settings' => [
            'label' => 'SEO',
            'description' => 'SEO settings',
            'tabs' => [
                'site' => 'General site settings',
                'meta_tags' => 'Meta tags',
                'og_tags' => 'Open Graph',
                'counters' => 'Counters',
                'robots_txt' => 'Robots.txt',
                'humans_txt' => 'Humans.txt',
                'security_txt' => 'Security.txt',
                'ads_txt' => 'Ads.txt',
                'app_ads_txt' => 'App-Ads.txt',
            ],
            'fields' => [
                'site_name' => [
                    'label' => 'Site name',
                    'placeholder' => '',
                ],
                'sitename_in_title_enabled' => [
                    'label' => 'Site name in title',
                ],
                'current_url_as_canonical' => [
                    'label' => 'Use current url as canonical',
                    'comment' => '',
                ],
                'site_name_title' => [
                    'label' => 'Site name in page title',
                    'placeholder' => '- Site Name',
                ],
                'site_name_title_position_in_title' => [
                    'label' => 'Site name position in title',
                    'options' => [
                        'before' => 'Before title',
                        'after' => 'After title',
                    ],
                ],
                'meta_robots_index' => [
                    'label' => 'Robots Index',
                ],
                'meta_robots_follow' => [
                    'label' => 'Robots Follow',
                ],
                'custom_meta_tags' => [
                    'label' => 'Custom meta tags',
                ],
                'og_image' => [
                    'label' => 'Default image',
                ],
                'custom_og_tags' => [
                    'label' => 'Custom Open Graph tags',
                ],
                'gtm_code' => [
                    'label' => 'Google Tag Manager ID',
                ],
                'counters' => [
                    'label' => 'Counters (Yandex Metrika, Google Analitycs and other)',
                ],
                'robots_txt_enabled' => [
                    'label' => 'Enabled',
                ],
                'robots_txt_available_tags' => [
                    'label' => 'These tags are available:',
                    'comment' => 'Click or drag these in to the content area',
                ],
                'humans_txt_info' => [
                    'label' => 'More about of file',
                ],
                'humans_txt_enabled' => [
                    'label' => 'Enabled',
                ],
                'humans_txt_available_tags' => [
                    'label' => 'These tags are available:',
                    'comment' => 'Click or drag these in to the content area',
                ],
                'security_txt_info' => [
                    'label' => 'More about of file',
                ],
                'security_txt_enabled' => [
                    'label' => 'Enabled',
                ],
                'security_txt_form' => [
                    'contact' => [
                        'label' => 'Contact',
                        'comment' => '<i class="text-danger">Required</i><br> A link or e-mail address for people to contact you about security issues. Remember to include "https://" for URLs, and "mailto:" for e-mails. See <a href="https://www.rfc-editor.org/rfc/rfc9116#section-2.5.3" target="_blank">the full description of Contact</a>',
                        'prompt' => 'Add another alternative',
                        'fields' => [
                            'contact' => [
                                'label' => '',
                            ],
                        ],
                    ],
                    'expires' => [
                        'label' => 'Expires',
                        'comment' => '<i class="text-danger">Required</i><br> The date and time when the content of the security.txt file should be considered stale (so security researchers should then not trust it). Make sure you update this value periodically and keep your file under review. See <a href="https://www.rfc-editor.org/rfc/rfc9116#section-2.5.5" target="_blank">the full description of Expires</a>',
                    ],
                    'encryption' => [
                        'label' => 'Encryption',
                        'comment' => '<i class="text-success">Optional</i><br> A link to a key which security researchers should use to securely talk to you. Remember to include "https://". See <a href="https://www.rfc-editor.org/rfc/rfc9116#section-2.5.4" target="_blank">the full description of Encryption</a>',
                        'prompt' => 'Add another alternative',
                        'fields' => [
                            'url' => [
                                'label' => '',
                            ],
                        ],
                    ],
                    'acknowledgments' => [
                        'label' => 'Acknowledgments',
                        'comment' => '<i class="text-success">Optional</i><br> A link to a web page where you say thank you to security researchers who have helped you. Remember to include "https://". See <a href="https://www.rfc-editor.org/rfc/rfc9116#section-2.5.1" target="_blank">the full description of Acknowledgments</a>',
                        'prompt' => 'Add another alternative',
                        'fields' => [
                            'url' => [
                                'label' => '',
                            ],
                        ],
                    ],
                    'preferred_languages' => [
                        'label' => 'Preferred-Languages',
                        'comment' => '<i class="text-success">Optional</i><br> A comma-separated list of language codes that your security team speaks. <b>You may include more than one language</b>. See <a href="https://www.rfc-editor.org/rfc/rfc9116#section-2.5.8" target="_blank">See the full description of Preferred-Languages</a>',
                    ],
                    'canonical' => [
                        'label' => 'Canonical',
                        'comment' => '<i class="text-success">Optional</i><br> The URLs for accessing your security.txt file. It is important to include this if you are digitally signing the security.txt file, so that the location of the security.txt file can be digitally signed too. See <a href="https://www.rfc-editor.org/rfc/rfc9116#section-2.5.2" target="_blank">the full description of Canonical</a>',
                        'prompt' => 'Add another alternative',
                        'fields' => [
                            'url' => [
                                'label' => '',
                            ],
                        ],
                    ],
                    'policy' => [
                        'label' => 'Policy',
                        'comment' => '<i class="text-success">Optional</i><br> A link to a policy detailing what security researchers should do when searching for or reporting security issues. Remember to include "https://". See <a href="https://www.rfc-editor.org/rfc/rfc9116#section-2.5.7" target="_blank">the full description of Policy</a>',
                        'prompt' => 'Add another alternative',
                        'fields' => [
                            'url' => [
                                'label' => '',
                            ],
                        ],
                    ],
                    'hiring' => [
                        'label' => 'Hiring',
                        'comment' => '<i class="text-success">Optional</i><br> A link to any security-related job openings in your organisation. Remember to include "https://". See <a href="https://www.rfc-editor.org/rfc/rfc9116#section-2.5.6" target="_blank">the full description of Hiring</a>',
                        'prompt' => 'Add another alternative',
                        'fields' => [
                            'url' => [
                                'label' => '',
                            ],
                        ],
                    ],
                ],
                'security_txt_available_tags' => [
                    'label' => 'These tags are available:',
                    'comment' => 'Click or drag these in to the content area',
                ],
                'ads_txt_info' => [
                    'label' => 'More about of file',
                ],
                'ads_txt_enabled' => [
                    'label' => 'Enabled',
                ],
                'ads_txt_rows' => [
                    'label' => 'Records',
                    'prompt' => 'Add new record',
                ],
                'ads_txt_vars' => [
                    'label' => 'Variables',
                    'prompt' => 'Add variable',
                    'fields' => [
                        'type' => [
                            'label' => 'Variable type',
                        ],
                        'value' => [
                            'label' => 'Value',
                        ],
                    ],
                ],
                'ads_txt_available_tags' => [
                    'label' => 'These tags are available:',
                    'comment' => 'Click or drag these in to the content area',
                ],
                'app_ads_txt_info' => [
                    'label' => 'More about of file',
                ],
                'app_ads_txt_enabled' => [
                    'label' => 'Enabled',
                ],
                'app_ads_txt_rows' => [
                    'label' => 'Records',
                    'prompt' => 'Add new record',
                ],
                'app_ads_txt_vars' => [
                    'label' => 'Variables',
                    'prompt' => 'Add variable',
                    'fields' => [
                        'type' => [
                            'label' => 'Variable type',
                        ],
                        'value' => [
                            'label' => 'Value',
                        ],
                    ],
                ],
                'app_ads_txt_available_tags' => [
                    'label' => 'These tags are available:',
                    'comment' => 'Click or drag these in to the content area',
                ],
            ],
        ],
    ],
    'components' => [
        'counters' => [
            'name' => 'Counters',
            'description' => 'Yandex Metrika, Google Analitycs and other',
            'properties' => [
                'counters_code' => [
                    'title' => 'Counters',
                    'description' => 'Scripts with counters',
                ],
                'show_global_counters' => [
                    'title' => 'Global counters',
                    'description' => 'Global counters to display',
                ],
            ],
        ],
        'gtmHead' => [
            'name' => 'GTM Head',
            'description' => 'Google Tag Manager ID',
            'properties' => [
                'gtm_code' => [
                    'title' => 'Google Tag Manager ID',
                    'description' => 'Google Tag Manager ID container. If not filled in, the code from the global settings will be used',
                ],
            ],
        ],
        'gtmNoScript' => [
            'name' => 'GTM NoScript',
            'description' => 'Google Tag Manager ID',
            'properties' => [
                'gtm_code' => [
                    'title' => 'Google Tag Manager ID',
                    'description' => 'Google Tag Manager ID container. If not filled in, the code from the global settings will be used',
                ],
            ],
        ],
        'tags' => [
            'name' => 'Meta tags',
            'description' => '',
            'groups' => [
                'show_custom_meta_from' => 'Meta tags to display',
                'show_custom_og_from' => 'Open Graph tags to display',
            ],
            'properties' => [
                'show_global_custom_meta' => [
                    'title' => 'Global custom meta tags',
                    'description' => 'Global custom meta tags to display',
                ],
                'show_global_custom_og' => [
                    'title' => 'Global OpenGraph tags',
                    'description' => 'Global OpenGraph tags to display',
                ],
            ],
        ],
        'microdata' => [
            'name' => 'Microdata',
            'description' => 'Custom microdata to display',
        ],
    ],
    'contentTags' => [
        'domain' => 'Domain',
        'siteName' => 'Site Name',
        'siteUrl' => 'Site URL address',
        'currentUrl' => 'Current page URL address',
        'currentUrlWithQuery' => 'Current page URL address with GET params',
    ],
];
