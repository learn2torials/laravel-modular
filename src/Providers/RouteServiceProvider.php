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
        $routePrefix = env('MODULE_PREFIX') ?: '/';
        foreach (config('console.modules', []) as $module => $isTurnedOn) {
            if($isTurnedOn) {
                $modulePath   = app_path(). '/Modules/' .ucfirst($module). DIRECTORY_SEPARATOR;
                $moduleRoutes = $modulePath. 'routes.php';
                if( \File::exists($moduleRoutes) ) {
                    $middleware = config($module. '.middleware', ['web']);
                    $route_prefix = trim($routePrefix, '/'). '/' .$module;
                    $module_namespace = 'App\\Modules\\' .ucfirst($module). '\\Controllers';
                    Route::prefix(langPrefix($route_prefix))->namespace($module_namespace)->middleware($middleware)->group($moduleRoutes);
                }
            }
        }
    }
}