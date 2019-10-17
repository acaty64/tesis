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
        $this->mapApiRoutes();

        $this->mapWebRoutes();
        $this->mapSysRoutes();
        // $this->mapAdmRoutes();

        //
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
             ->namespace($this->namespace)
             ->group(base_path('routes/web.php'));
    }

    /**
     * Define the "api" routes for the application.
     *
     * These routes are typically stateless.
     *
     * @return void
     */
    protected function mapApiRoutes()
    {
        Route::prefix('api')
             ->middleware('api')
             ->namespace($this->namespace)
             ->group(base_path('routes/api.php'));
    }


    protected function mapSysRoutes()
    {
        Route::prefix('sys')
//             ->middleware(['web', 'admin', 'master'])
             ->middleware(['web', 'master'])
             ->namespace($this->namespace)
             ->group(base_path('routes/sys.php'));
    }

    protected function mapAdmRoutes()
    {
        Route::prefix('adm')
             ->middleware(['web', 'admin'])
             ->namespace($this->namespace)
             ->group(base_path('routes/adm.php'));
    }

    protected function mapRespRoutes()
    {
        Route::prefix('resp')
             ->middleware(['web', 'resp'])
             ->namespace($this->namespace)
             ->group(base_path('routes/resp.php'));
    }

    protected function mapDocRoutes()
    {
        Route::prefix('doc')
             ->middleware(['web', 'doc'])
             ->namespace($this->namespace)
             ->group(base_path('routes/doc.php'));
    }

}
