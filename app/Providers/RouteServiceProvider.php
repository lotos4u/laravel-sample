<?php

namespace App\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * This namespace is applied to your controller routes.
     *
     * In addition, it is set as the URL generator's root namespace.
     *
     * @var string
     */
    protected $namespace = 'App\Http\Controllers';

    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @return void
     */
    public function boot()
    {
        //

        parent::boot();
    }

    /**
     * Define the routes for the application.
     *
     * @return void
     */
    public function map()
    {
        $this->mapInternalApiRoutes();

        $this->mapExternalStatelessApiRoutes();

        $this->mapAdminRoutes();

        $this->mapWebRoutes();

        //
    }

    /**
     * Define the "admin" routes for the application.
     *
     * The same as "web" but all with Auth
     *
     * @return void
     */
    protected function mapAdminRoutes()
    {
        Route::middleware('admin')
//            ->middleware('auth')
            ->namespace($this->namespace)
            ->group(base_path('routes/admin.php'));
    }

    /**
     * Define the "web" routes for the application.
     *
     * These routes all receive session state, CSRF protection, etc.
     *
     * @return void
     */
    protected function mapWebRoutes()
    {
        Route::middleware('web')
//            ->middleware('auth')
            ->namespace($this->namespace)
            ->group(base_path('routes/web.php'));
    }

    /**
     * Define the "api" routes for the application.
     *
     * These routes WILL stateless.
     *
     * @return void
     */
    protected function mapExternalStatelessApiRoutes()
    {
        Route::prefix(config('api.external.url_prefix'))
            ->middleware('api')
            ->namespace($this->namespace)
            ->group(base_path(config('api.external.routes_path')));
    }

    /**
     * Define the "api" routes for the application.
     *
     * These routes are typically stateless.
     *
     * @return void
     */
    protected function mapInternalApiRoutes()
    {
        Route::prefix(config('api.internal.url_prefix'))
//            ->middleware('auth.internal:api')
            ->middleware('internal_api')
            ->namespace($this->namespace)
            ->group(base_path(config('api.internal.routes_path')));

//        Route::prefix('api/v2')
//            ->middleware('auth.internal:api')
//            ->middleware('permission.internal:user_1*')
//            ->namespace($this->namespace)
//            ->group(base_path('routes/api_internal.php'));
    }
}
