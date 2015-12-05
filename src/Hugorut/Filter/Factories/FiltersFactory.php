<?php  
namespace Hugorut\Filter\Factories;

/**
* Filters Factory designated to new up instances of filters
*/
class FiltersFactory extends Factory
{
    /**
     * class lookup table
     * 
     * @var array
     */
	protected $resources = [
		'site' => '\Hugorut\Filter\Filters\SiteFilter',
	];
}
 ?>