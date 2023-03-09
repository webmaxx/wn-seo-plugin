<?php namespace Webmaxx\Seo\Classes;

use Webmaxx\Seo\Models\Settings;

class UrlNormalizer
{
    use \Winter\Storm\Support\Traits\Singleton;

    /**
     * Settings.
     *
     * @var array
     */
    protected $settings = [];

    /**
     * Paths to ignore
     *
     * @var array
     */
    protected $pathsToIgnore = [];

    /**
     * Paths to always ignore
     *
     * @var array
     */
    protected $alwaysIgnore = [
        'backend/*'
    ];

    /**
     * Initialize this singleton.
     *
     * @return void
     */
    protected function init()
    {
        $this->settings = Settings::instance();

        if (!empty($this->settings->url_ignore)) {
            $this->pathsToIgnore = array_merge(
                $this->alwaysIgnore,
                preg_split(
                    '/[\r\n]+/',
                    $this->settings->url_ignore,
                    -1,
                    PREG_SPLIT_NO_EMPTY
                )
            );
        } else {
            $this->pathsToIgnore = $this->alwaysIgnore;
        }
    }

    /**
     * Normalize a given URL using your URL normalisation settings.
     *
     * This will ignore any URLs that appear to be external. You may force the normalisation if you wish.
     *
     * @param string $url
     * @param bool $force
     * @return string The normalized URL
     */
    public static function normalize(string $url, bool $force = false)
    {
        $instance = self::instance();

        if (!$force && $instance->isExternal($url)) {
            return $url;
        }

        $originalUrl = $url;
        $url = parse_url($url);

        // If the link is not a HTTP or HTTPS link, return the URL as is
        if (!empty($url['scheme']) && !in_array($url['scheme'], ['http', 'https'])) {
            return \http_build_url($url);
        }

        // Set default URL parts, if not provided
        if (empty($url['host'])) {
            $url['host'] = $instance->getHostname();

            // If we cannot determine the hostname, return the URL as is
            if (empty($url['host'])) {
                return \http_build_url($url);
            }
        }

        if (empty($url['scheme'])) {
            $url['scheme'] = ($instance->getPort() === 443) ? 'https' : 'http';
        }
        if (empty($url['port'])) {
            if (
                ($url['scheme'] === 'http' && $instance->getPort() !== 80)
                || ($url['scheme'] === 'https' && $instance->getPort() !== 443)
            ) {
                $url['port'] = $instance->getPort();
            }
        }

        // Check if path is ignored
        if (empty($url['path'])) {
            $url['path'] = '/';
        }

        if (count($instance->pathsToIgnore) && $url['path'] !== '/') {
            foreach ($instance->pathsToIgnore as $ignorePath) {
                $ignorePath = (substr($ignorePath, 0, 1) !== '/')
                    ? '/' . $ignorePath
                    : $ignorePath;
                $targetPath = (substr($url['path'], 0, 1) !== '/')
                    ? '/' . $url['path']
                    : $url['path'];
                $wildcardPos = strpos($ignorePath, '*');

                if ($wildcardPos !== false) {
                    $ignorePath = substr($ignorePath, 0, $wildcardPos);
                    $targetPath = substr($targetPath, 0, $wildcardPos);
                }

                if ($ignorePath === $targetPath) {
                    return $originalUrl;
                }
            }
        }

        // Add or remove trailing slash if preferenced
        if ($instance->settings->url_trailing_slash !== 'none') {
            // Do not apply trailing slash rules if the URL has an extension
            $extension = pathinfo($url['path'], PATHINFO_EXTENSION);
            $hasSlash = (preg_match('/\/$/', $url['path']) === 1);

            if (empty($extension) && $url['path'] !== '/') {
                if ($instance->settings->url_trailing_slash === 'use' && $hasSlash === false) {
                    $url['path'] = $url['path'] . '/';
                }
                if ($instance->settings->url_trailing_slash === 'unuse' && $hasSlash === true) {
                    $url['path'] = preg_replace('/\/+$/', '', $url['path']);
                }
            }
        }

        // Add or remove www prefix if preferenced
        if ($instance->settings->url_www_prefix !== 'none') {
            $hasPrefix = (preg_match('/^www./i', $url['host']) === 1);

            if ($instance->settings->url_www_prefix === 'use' && $hasPrefix === false) {
                $url['host'] = 'www.' . $url['host'];
            }
            if ($instance->settings->url_www_prefix === 'unuse' && $hasPrefix === true) {
                $url['host'] = preg_replace('/^www./i', '', $url['host']);
            }
        }

        // Add HTTPS if it is forced
        if (empty($url['scheme'])) {
            $url['scheme'] = 'https';
        }
        if (boolval($instance->settings->url_force_https) === true && $url['scheme'] === 'http') {
            $url['scheme'] = 'https';
        }

        return \http_build_url($url);
    }

    public static function doRedirect()
    {
        return self::instance()->settings->url_use_redirect;
    }

    /**
     * Determines if a URL is external, based on the server name.
     *
     * @param string $url
     * @return bool
     */
    protected function isExternal(string $url)
    {
        $urlHostname = parse_url($url, PHP_URL_HOST) ?? null;

        if (empty($urlHostname)) {
            return false;
        }

        $serverName = $this->getHostname();

        if (empty($serverName)) {
            return true;
        }

        $urlHostname = preg_replace('/www\./i', '', $urlHostname);
        $serverName = preg_replace('/www\./i', '', $serverName);

        return (strtolower($serverName) !== strtolower($urlHostname));
    }

    /**
     * Get the hostname, either from the server variables or from the current URL.
     *
     * @return string|null
     */
    protected function getHostname()
    {
        return
            $_SERVER['X_FORWARDED_HOST']
            ?? $_SERVER['SERVER_NAME']
            ?? parse_url(url()->current(), PHP_URL_HOST)
            ?? null;
    }

    /**
     * Get the port, either from the server variables or from the current URL.
     *
     * @return int
     */
    protected function getPort()
    {
        return intval(
            $_SERVER['X_FORWARDED_PORT']
            ?? $_SERVER['SERVER_PORT']
            ?? parse_url(url()->current(), PHP_URL_PORT)
            ?? 80
        );
    }
}
