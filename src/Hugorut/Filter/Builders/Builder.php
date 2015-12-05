<?php  
namespace Hugorut\Filter\Builders;

use Hugorut\Filter\Filters\Filterable;

abstract class Builder
{
	/**
	 * filters
	 * 
	 * @var array
	 */
	protected $filters = [];

	/**
	 * the raw query
	 * 
	 * @var string
	 */
	protected $query;

	/**
	 * joins to the model
	 * 
	 * @var array
	 */
	protected $joins = [];

	/**
	 * where clasuses to the model
	 * 
	 * @var array
	 */
	protected $wheres = [];

	/**
	 * where not in clauses to the model
	 * 
	 * @var array
	 */
	protected $whereNotIns = [];

	/**
	 * table to filter
	 * 
	 * @var string
	 */
	protected $tableName;

	/**
	 * a model instance
	 * 
	 * @var Object
	 */
	protected $model;

	/**
	 * add a filter to the main filters array
	 * 
	 * @param Filterable $filter 
	 * @return null
	 */
	public function addFilter(Filterable $filter)
	{
		$this->filters[] = $filter;
	}

	/**
	 * get the filters array
	 *
	 * @return array
	 */
	public function getFilters()
	{
		return $this->filters;
	}

	/**
	 * return the query
	 * 
	 * @return mixed
	 */
	public function getQuery()
	{
		return $this->query;
	}

	/**
	 * execute the query
	 * 
	 * @return Collection 
	 */
	public function get()
	{
		return $this->query->get();
	}

	/**
	 * add a where 
	 * 
	 * @param string $where 
	 * @return null
	 */
	public function addWhere($where)
	{
		if(is_array($where) && !empty($where)) {
			$this->wheres[] = $where;		
		}
	}

	/**
	 * return the wheres array
	 * 
	 * @return array
	 */
	public function getWheres()
	{
		return $this->wheres;
	}

	/**
	 * add a join
	 * 
	 * @param string $join 
	 */
	public function addJoin($join)
	{
		if(is_array($join) && !empty($join)) {
			$this->joins[] = $join;	
		}
	}

	/**
	 * return the joins
	 * 
	 * @return array
	 */
	public function getJoins()
	{
		return $this->joins;
	}

	/**
	 * add where not in
	 * @param string $wherenot 
	 */
	public function addWhereNotIn($whereNot)
	{
		if(is_array($whereNot) && !empty($whereNot)) {
			$this->whereNotIns[] = $whereNot;	
		}
	}

	/**
	 * return the where not ins
	 * 
	 * @return array
	 */
	public function getWhereNotIns()
	{
		return $this->whereNotIns;
	}

	/**
	 * getter
	 * 
	 * @return string
	 */
	public function getTableName()
	{
		return $this->model->getTable();
	}

	/**
	 * build and set the query
	 * @return null
	 */
	public function buildQuery()
	{
		$this->buildBaseQuery();

		foreach ($this->filters as $filter) 
		{
			$this->addWhere($filter->getWhere());
			$this->addWhereNotIn($filter->getWhereNotIn());
			$this->addJoin($filter->getJoin());
		}

		$this->buildClauses();
	}
	
	/**
	 * build the base query
	 * 
	 * @return void
	 */
	abstract function buildBaseQuery();	

	/**
	 * build the clauses
	 * 
	 * @return void
	 */
	abstract function buildClauses();

	/**
	 * how should we execute the query
	 * 
	 * @return Model
	 */
	abstract function execute();
}
 ?>