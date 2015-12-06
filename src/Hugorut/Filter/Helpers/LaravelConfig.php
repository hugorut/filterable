<?php 

namespace Hugorut\Filter\Helpers;

class LaravelConfig implements Configable
{
    /**
     * get a config value
     * 
     * @param  string $value
     * @return mixed
     */
    public function get($value)
    {
        return config($value);
    }
}