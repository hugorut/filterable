<?php  
namespace Filter\Factories;

use Filter\Factory;

/**
* Builders Factory designated to new up instances of builders
*/
class BuildersFactory extends Factory
{
	protected $resources = [
		'article' => '\Filter\Builders\ArticleFilterBuilder'
	];
}
 ?>