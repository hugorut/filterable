<?php

namespace Hugorut\Filter\Laravel;

use Illuminate\Support\Facades\Facade;

class Filter extends Facade
{
    /**
     * Get the registered name of the filter.
     *
     * @return string
     */
    protected static function getFacadeAccessor() 
    { 
        return 'filter'; 
    }
}