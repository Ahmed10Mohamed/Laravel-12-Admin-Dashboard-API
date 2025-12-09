<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Foundation\Application;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Traits\ApiResponses;

class APISettings
{
    use ApiResponses;

    protected Application $app;

    public function __construct(Application $app)
    {
        $this->app = $app;
    }

    /**
     * Handle an incoming request and set the application's locale.
     *
     * @param  Request  $request
     * @param  Closure(Request): Response  $next
     * @return Response
     */
    public function handle(Request $request, Closure $next): Response
{
    $locale = $request->header('Content-Language');

    if (!is_string($locale) || $locale === '') {
        $locale = config('app.locale');
    }

    $supportedLanguages = config('languages', []);
    if (!array_key_exists($locale, $supportedLanguages)) {
        return $this->sendError(
            translate('Language Not Supported'),
            [],
            404
        );
    }

    $this->app->setLocale($locale);

    $response = $next($request);
    $response->headers->set('Content-Language', $locale);

    return $response;
}

}
