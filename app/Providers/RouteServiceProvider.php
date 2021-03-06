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
        $this->mapManagerRoutes();
        $this->mapAuthorRoutes();
        $this->mapAdvisorRoutes();

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
//             ->middleware(['web', 'admin', 'master'])
        Route::middleware([
                'web', 
                'is_master', 
            ])
             ->namespace($this->namespace)
             ->group(base_path('routes/sys.php'));
    }

    protected function mapManagerRoutes()
    {
        Route::middleware([
                'web', 
                'is_admin'])
             ->namespace($this->namespace)
             ->group(base_path('routes/admin.php'));
    }

    protected function mapAuthorRoutes()
    {
        Route::middleware(['web', 'is_autor'])
             ->namespace($this->namespace)
             ->group(base_path('routes/autor.php'));
    }

    protected function mapAdvisorRoutes()
    {
        Route::middleware(['web', 'is_asesor'])
             ->namespace($this->namespace)
             ->group(base_path('routes/asesor.php'));
    }

}
