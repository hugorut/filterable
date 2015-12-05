<?php

namespace Hugorut\Filter;

use Hugorut\Filter\Factories\FiltersFactory;
use Hugorut\Filter\Factories\BuildersFactory;
use Hugorut\Filter\Filter;
use Illuminate\Support\ServiceProvider;

class FilterServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
       $this->app->bind('filter', function() {
            return new Filter(new BuildersFactory, new FiltersFactory);
       });
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}