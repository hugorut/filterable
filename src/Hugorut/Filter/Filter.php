<?php  
namespace Hugorut\Filter;

use Hugorut\Filter\Factories\Factory;
use Exception;

class Filter
{
	/**
	 * the builder instance
	 * 
	 * @var Hugorut\Filter\Builders\Builder
	 */
	protected $builder;

	/**
	 * the builders factory instance
	 * 
	 * @var Hugorut\Filter\Factory
	 */
	private $buildersFactory;

	/**
	 * the filters factory instance
	 * 
	 * @var Hugorut\Filter\Factory
	 */
	private $filtersFactory;

	function __construct(Factory $buildersFactory, Factory $filtersFactory) 
	{
		$this->buildersFactory = $buildersFactory;
		$this->filtersFactory = $filtersFactory;
	}

	/**
	 * set builder type
	 * 
	 * @param string $type
	 * @return $this
	 */
	public function setType($type)
	{
		$this->builder = $this->buildersFactory->getInstance($type);

		return $this;
	}

	/**
	 * return the builder instance
	 * 
	 * @return Builder
	 */
	public function getBuilder()
	{
		return $this->builder;
	}

	/**
	 * create filters to pass into the filter builder
	 * 
	 * @param  array  $filters assoc array 
	 * @return $this
	 */
	public function by(array $filters)
	{
		if(is_null($this->builder)) {
			$this->setType('test');
		}
		
		foreach ($filters as $filterName => $filterIds) 
		{
			$filterable = $this->filtersFactory->getInstance($filterName);	
			$filterable->setTable($this->builder->getTableName());
			$filterable->buildSql($filterIds);

			$this->builder->addFilter($filterable);	
		}

		return $this;
	}

	/**
	 * return the query
	 * 
	 * @param Illuminate\Database\Eloquent\Builder
	  */
	public function get()
	{
		$this->builder->buildQuery();

		return $this->builder->execute();
	}

}
 ?>