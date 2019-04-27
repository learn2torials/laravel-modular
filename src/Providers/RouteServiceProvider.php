<?php

/*
| -------------------------------------------------------------------------
| L2T
| -------------------------------------------------------------------------
|
| User: spatel
| Date: 13/09/18
| Time: 3:20 PM
| Version: 1.0
| Website: https://learn2torials.com
*/
namespace L2T\Providers;

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
    protected $namespace = 'L2T\Controllers';

    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();
    }

    public function map()
    {
        $this->mapModuleRoutes();
    }

    /**
     * Map Module Related Routes
     */
    protected function mapModuleRoutes()
    {
        $routePrefix = config('console.prefix') ? config('console.prefix'). '/' : '';
        foreach (config('console.modules', []) as $module => $isTurnedOn) {
            if($isTurnedOn) {
                $modulePath   = app_path(). '/Modules/' .getModuleSlug($module). DIRECTORY_SEPARATOR;
                $moduleRoutes = $modulePath. 'routes.php';
                if( \File::exists($moduleRoutes) ) {
                    $routeModulePrefix = $routePrefix. $module;
                    $middleware = config($module. '.route_middleware', ['web']);
                    $moduleNamespace = 'App\\Modules\\' .getModuleSlug($module). '\\Controllers';
                    Route::prefix(langPrefix($routeModulePrefix))->namespace($moduleNamespace)->middleware($middleware)->group($moduleRoutes);
                }
            }
        }
    }
}
