<?php

namespace App\Providers;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {

    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Model::automaticallyEagerLoadRelationships();
        $this->configureModel();

        // Pagination
        Paginator::useBootstrap();
        Paginator::useBootstrapFive();
        Paginator::useBootstrapFour();

        ini_set('memory_limit', '-1');

        /**
         * -------------------------
         * Rate Limiting
         * -------------------------
         */

      RateLimiter::for('login', function (Request $request) {

        $username = $request->input('userName');
        $username = is_string($username) ? $username : '';

        $ip = $request->ip();
        $ip = is_string($ip) ? $ip : 'unknown';

        return Limit::perMinute(5)->by($username . $ip);
        });

        RateLimiter::for('register', function (Request $request) {

        $ip = $request->ip();
        $ip = is_string($ip) ? $ip : 'unknown';

        return Limit::perMinute(3)->by($ip);
        });

        RateLimiter::for('global', function (Request $request) {

        $ip = $request->ip();
        $ip = is_string($ip) ? $ip : 'unknown';

        return Limit::perMinute(60)->by($ip);
        });

    }
    

    private function configureModel(): void
    {
        Model::shouldBeStrict(false);
        Model::unguard();
    }
}
