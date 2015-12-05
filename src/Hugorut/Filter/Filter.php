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

	/**
	 * default filter string
	 * 
	 * @var string
	 */
	protected $default = 'default'; 

	function __construct(Factory $buildersFactory, Factory $filtersFactory) 
	{
		$this->buildersFactory = $buildersFactory;
		$this->filtersFactory = $filtersFactory;
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
			$this->setType($this->default);
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
     * Gets the default filter string.
     *
     * @return string
     */
    public function getDefault()
    {
        return $this->default;
    }

    /**
     * Sets the default filter string.
     *
     * @param string $default the default
     *
     * @return self
     */
    public function setDefault($default)
    {
        $this->default = $default;

        return $this;
    }
}