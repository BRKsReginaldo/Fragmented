<?php

namespace BRKsReginaldo\Fragmented;

use Illuminate\Support\ServiceProvider;

class FragmentedServiceProvider extends ServiceProvider
{
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            echo "Booting app\n";
        }
    }

    public function register()
    {

    }
}