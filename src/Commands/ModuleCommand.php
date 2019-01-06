<?php

namespace L2T\Commands;

use Illuminate\Console\Command;

class ModuleCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:module {module : Name of the new module}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate Modules Using Command Line';

    /**
     * @throws \Exception
     */
    public function handle()
    {
        $module = getModuleSlug($this->argument('module'));
        $module_raw = getModuleSlugRaw($this->argument('module'));

        if($module) {

            $this->warn("--------------------------------");
            $this->warn("Creating a new module: " .$module);
            $this->warn("--------------------------------");

            $route_path = app_path('Modules/'. $module. '/routes.php');
            $config_path = app_path('Modules/'. $module. '/config.php');
            $index_path = app_path('Modules/'. $module. '/Views/index.blade.php');

            $module_views_path = app_path('Modules/'. $module. '/Views');
            $module_models_path = app_path('Modules/'. $module. '/Models');
            $module_factory_path = app_path('Modules/'. $module. '/Factory');
            $module_migrations_path = app_path('Modules/'. $module. '/Migrations');
            $module_controller_path = app_path('Modules/'. $module. '/Controllers');

            if( !\File::exists($route_path) )
            {
                $this->warn("Creating Folder Structure ...");
                \File::makeDirectory($module_views_path, 0755, true);
                $this->info("Created: " .$module_views_path);

                \File::makeDirectory($module_migrations_path, 0755, true);
                $this->info("Created: " .$module_migrations_path);

                \File::makeDirectory($module_controller_path, 0755, true);
                $this->info("Created: " .$module_controller_path);

                \File::makeDirectory($module_models_path, 0755, true);
                $this->info("Created: " .$module_models_path);

                \File::makeDirectory($module_factory_path, 0755, true);
                $this->info("Created: " .$module_factory_path);

                $this->info(PHP_EOL);
            }

            $this->warn("Creating File Structure ...");

            // generate home controller
            $file_target = $module_controller_path. '/HomeController.php';
            $file_tpl = __DIR__. '/Templates/HomeController.tpl';
            $this->create($file_tpl, $file_target, [
                'module' => $module,
                'module_lower' => $module_raw
            ]);

            // generate routes file
            $file_tpl = __DIR__. '/Templates/routes.tpl';
            $this->create($file_tpl, $route_path, [
                'module' => $module,
                'module_lower' => $module_raw
            ]);

            // generate config file
            $file_tpl = __DIR__. '/Templates/config.tpl';
            $this->create($file_tpl, $config_path, [
                'module' => $module,
                'module_lower' => $module_raw
            ]);

            // generate config file
            $file_tpl = __DIR__. '/Templates/index.tpl';
            $this->create($file_tpl, $index_path, [
                'module' => $module,
                'module_lower' => $module_raw
            ]);
        }
    }

    /**
     * @param $template_path
     * @param $target_path
     * @param array $variables
     * @throws \Exception
     */
    private function create($template_path, $target_path, $variables=[])
    {
        if(!file_exists($template_path)) {
            throw new \Exception("File {$template_path}.tpl does not exists.");
        }

        $template = file_get_contents($template_path);
        foreach($variables as $key => $value) {
            $template = str_replace('[['.$key.']]', $value, $template);
        }

        @file_put_contents($target_path, $template);
        $this->info("Created: " .$target_path);
    }
}
