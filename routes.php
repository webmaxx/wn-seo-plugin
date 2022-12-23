<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Response;
use Webmaxx\Seo\Classes\Generators\AdsTxtGenerator;
use Webmaxx\Seo\Classes\Generators\AppAdsTxtGenerator;
use Webmaxx\Seo\Classes\Generators\HumansTxtGenerator;
use Webmaxx\Seo\Classes\Generators\RobotsTxtGenerator;
use Webmaxx\Seo\Classes\Generators\SecurityTxtGenerator;
use Webmaxx\Seo\Models\Settings;

Event::listen('system.beforeRoute', function () {
    $txtResponse = fn($generatorClass) => Response::make(app($generatorClass)->render())->header('Content-Type', 'text/plain');

    if (Settings::get('robots_txt_enabled')) {
        Route::get('robots.txt', fn() => $txtResponse(RobotsTxtGenerator::class));
    }

    if (Settings::get('humans_txt_enabled')) {
        Route::get('humans.txt', fn() => $txtResponse(HumansTxtGenerator::class));
    }

    if (Settings::get('security_txt_enabled')) {
        Route::get('security.txt', fn() => $txtResponse(SecurityTxtGenerator::class));
        Route::get('.well-known/security.txt', fn() => $txtResponse(SecurityTxtGenerator::class));
    }

    if (Settings::get('ads_txt_enabled')) {
        Route::get('ads.txt', fn() => $txtResponse(AdsTxtGenerator::class));
    }

    if (Settings::get('app_ads_txt_enabled')) {
        Route::get('app-ads.txt', fn() => $txtResponse(AppAdsTxtGenerator::class));
    }
});
