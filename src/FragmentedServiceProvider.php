<?php

namespace BRKsReginaldo\Fragmented;

use BRKsReginaldo\Fragmented\Console\FragmentMakeCommand;
use Illuminate\Support\ServiceProvider;

class FragmentedServiceProvider extends ServiceProvider
{
    public function boot()
    {
        // Publishes package config file
        $this->publishes([
            __DIR__ . '/../config/fragmented.php' => config_path('fragmented.php')
        ], 'config');

        // Merge default config
        $this->mergeConfigFrom(__DIR__ . '/../config/fragmented.php', 'fragmented');

        // Register commands
        if ($this->app->runningInConsole()) {
            $this->commands([
                FragmentMakeCommand::class,
            ]);
        }
    }

    public function register()
    {

    }
}