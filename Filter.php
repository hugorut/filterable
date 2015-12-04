<?php  
namespace Filter;

use Filter\Factories\BuildersFactory;
use Filter\Factories\FiltersFactory;

use Exception;
/**
* Main Filter Factory 
*/
class Filter
{
	protected $builder;
	
	/**
	 * set builder type
	 * @param string $type
	 * @return $this
	 */
	public function setType($type)
	{
		$this->builder = (new BuildersFactory)->getInstance($type);

		return $this;
	}

	/**
	 * return the builder instance
	 * @return Builder
	 */
	public function getBuilder()
	{
		return $this->builder;
	}

	/**
	 * create filters to pass into the filter builder
	 * @param  array  $filters assoc array 
	 * @return $this
	 */
	public function by(array $filters)
	{
		if(is_null($this->builder))  $this->setType('test');
		
		$filtersFactory = new FiltersFactory;

		foreach ($filters as $filterName => $filterIds) 
		{
			$filterable = $filtersFactory->getInstance($filterName);	
			$filterable->setTable($this->builder->getTableName());
			$filterable->buildSql($filterIds);

			$this->builder->addFilter($filterable);	
		}

		return $this;
	}

	/**
	 * return the query
	 * @param Illuminate\Database\Eloquent\Builder
	  */
	public function get()
	{
		$this->builder->buildQuery();

		return $this->builder->execute();
	}

}
 ?>