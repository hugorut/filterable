<?php

namespace Hugorut\Filter;

use App\Services\Filter\Factories\BuildersFactory;
use App\Services\Filter\Factories\FiltersFactory;
use App\Services\Filter\Filter;
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
            return new Filter;
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