<?php  
namespace Filter\Factories;

use Filter\Factory;

/**
* Filters Factory designated to new up instances of filters
*/
class FiltersFactory extends Factory
{
	protected $resources = [
		'site' => '\Filter\Filters\SiteFilter',
	];
}
 ?>