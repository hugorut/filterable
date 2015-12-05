<?php  
namespace Hugorut\Filter\Factories;

use Hugorut\Filter\Builders\EloquentFilterBuilder;

class BuildersFactory extends Factory
{
    /**
     * get from config
     * 
     * @var string
     */
    protected $config = 'Builders';

    /**
     * a hook before the instance is instantiated
     * 
     * @param  string $instance 
     * @return Hugorut\Filter\Builders\EloquentFilterBuilder
     */
    public function instantiate($instance)
    {
        return new EloquentFilterBuilder(new $instance);
    }
}
 ?>