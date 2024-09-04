<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot()
    {
        $this->configureRateLimiting();

        $this->routes(function () {
            Route::middleware('web')
                ->group(base_path('routes/web.php'));

            // Register the admin middleware
            Route::aliasMiddleware('admin', AdminMiddleware::class);
        });

        $this->routes(function () {
            Route::middleware('web')
                ->group(base_path('routes/web.php'));

            // Register the custom authentication middleware
            Route::aliasMiddleware('ensure.auth', EnsureUserIsAuthenticated::class);
        });
    }
}
