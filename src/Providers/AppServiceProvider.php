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

use L2T\Commands\ModuleCommand;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * @var string
     */
    private $module = 'console';

    /**
     * Bootstrap any application services.
     */
    public function boot()
    {
        $rootDir = dirname(__DIR__);
        $this->publishes([
            $rootDir. '/config.php' => config_path($this->module. '.php'),
        ]);

        $this->loadViewsFrom($rootDir. '/Views', $this->module);
        $this->loadMigrationsFrom($rootDir. '/Migrations');
        $this->mergeConfigFrom($rootDir. '/config.php', $this->module);
        $this->loadTranslationsFrom($rootDir. '/Translations', $this->module);

        // console commands goes here
        if ($this->app->runningInConsole()) {
            $this->commands([
                ModuleCommand::class
            ]);
        }

        $this->enableI18n();
        $this->enableModularApp();

        \Auth::provider('User', function($app, array $config) {
            return new UserServiceProvider($app['hash'], $config['model']);
        });
    }
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Enable i18n translations
     */
    private function enableI18n()
    {
        if( config($this->module. '.i18n') )
        {
            $requested_lang = (strlen(request()->segment(1)) === 2) ? request()->segment(1) : '';
            $requested_country = (strlen(request()->segment(2)) === 2) ? request()->segment(2) : '';

            // set the local for application
            // very important to support multi-languages
            app()->setLocale($requested_lang ?: config('app.fallback_locale'));

            // set url prefix for routing purpose
            config(['langPrefix' => trim("{$requested_lang}/{$requested_country}", DIRECTORY_SEPARATOR)]);
        }
    }

    /**
     * Enable modular app feature
     */
    private function enableModularApp()
    {
        foreach (config($this->module. '.modules', []) as $module => $isTurnedOn)
        {
            if($isTurnedOn)
            {
                $modulePath   = app_path(). '/Modules/' .ucfirst($module). DIRECTORY_SEPARATOR;
                $moduleConfigPath = $modulePath. 'config.php';

                if( \File::exists($moduleConfigPath) ) {
                    $this->mergeConfigFrom($moduleConfigPath, $module);
                    $this->loadViewsFrom($modulePath.'Views', $module);
                    $this->loadMigrationsFrom($modulePath. 'Migrations');
                    $this->loadTranslationsFrom($modulePath.'Translations', $module);
                }

                // register middle wares
                $moduleMiddleware = config($module. '.middleware', []);
                foreach ($moduleMiddleware as $key => $middleware) {
                    $this->app['router']->aliasMiddleware($key , $middleware);
                }
            }
        }
    }
}