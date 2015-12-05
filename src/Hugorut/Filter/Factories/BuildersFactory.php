<?php  
namespace Hugorut\Filter\Factories;

/**
* Builders Factory designated to new up instances of builders
*/
class BuildersFactory extends Factory
{
    /**
     * class lookup table
     * 
     * @var array
     */
	protected $resources = [
		'article' => '\Hugorut\Filter\Builders\ArticleFilterBuilder'
	];
}
 ?>