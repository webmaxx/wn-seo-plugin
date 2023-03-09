<?php namespace Webmaxx\Seo\Middlewares;

use App;
use Closure;
use Webmaxx\Seo\Classes\UrlNormalizer;

class UrlNormalizeMiddleware
{
    public $ignore = [
        'backend/*'
    ];

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        // Always allow backend to be accessed
        if (App::runningInBackend()) {
            return $next($request);
        }

        $originalUrl = preg_replace('/\?.*/', '', $request->getUri());
        $normalizedUrl = UrlNormalizer::normalize($originalUrl);

        if ($originalUrl !== $normalizedUrl) {
            if (UrlNormalizer::doRedirect()) {
                return redirect()->away($normalizedUrl, 301);
            }
        }

        return $next($request);
    }
}
