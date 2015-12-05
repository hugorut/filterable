<?php  
namespace Hugorut\Filter\Factories;

use Hugorut\Filter\Filters\EloquentFilterable;

class FiltersFactory extends Factory
{
    /**
     * get from config
     * 
     * @var string
     */
    protected $config = 'Filters';

    /**
     * a hook before the instance is instantiated
     * 
     * @param  string $instance 
     * @return Hugorut\Filter\Builders\EloquentFilterBuilder
     */
    public function instantiate($instance)
    {
        return new EloquentFilterable(new $instance);
    }
}
 ?>