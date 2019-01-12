<?php

namespace L2T\Database;

use Illuminate\Database\Seeder as BaseSeeder;

class Seeder extends BaseSeeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        foreach (config('console.modules', []) as $module => $isTurnedOn) {
            if ($isTurnedOn && $seeders = config($module. '.seeder', [])) {
                foreach ($seeders as $seeder) {
                    include_once $seeder;
                    $seed = basename($seeder, ".php");
                    if(class_exists($seed)) {
                        $this->call($seed);
                    }
                }
            }
        }
    }
}
