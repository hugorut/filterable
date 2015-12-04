<?php  
namespace Filter\Builders;

use Filter\Filters\Filterable;
use Illuminate\Support\Facades\DB;

abstract class Builder
{
	protected $filters = [];
	protected $query;
	protected $joins = [];
	protected $wheres = [];
	protected $whereNotIns = [];
	protected $tableName;

	/**
	 * add a filter to the main filters array
	 * @param Filterable $filter 
	 * @return null
	 */
	public function addFilter(Filterable $filter)
	{
		$this->filters[] = $filter;
	}

	/**
	 * get the filters array
	 * @return array
	 */
	public function getFilters()
	{
		return $this->filters;
	}

	/**
	 * return the query
	 * @return mixed
	 */
	public function getQuery()
	{
		return $this->query;
	}

	/**
	 * execute the query
	 * @return Collection 
	 */
	public function get()
	{
		return $this->query->get();
	}

	/**
	 * add the joins and wheres to the query
	 * @return null
	 */
	public function buildClauses()
	{
		foreach ($this->joins as $join) 
		{
			$this->query->leftJoin($join[0], $join[1], $join[2], $join[3]);
		}

		foreach ($this->whereNotIns as $key => $notIn) 
		{
			$this->query->whereNotIn($notIn[0], $notIn[1]);
		}

		foreach ($this->wheres as $key => $where) 
		{
			$this->query->where($where[0], $where[1], $where[2]);
		}

	}

	/**
	 * add a where 
	 * @param string $where 
	 * @return null
	 */
	public function addWhere($where)
	{
		if(is_array($where) && !empty($where)) $this->wheres[] = $where;		
	}

	/**
	 * return the wheres array
	 * @return array
	 */
	public function getWheres()
	{
		return $this->wheres;
	}

	/**
	 * add a join
	 * @param string $join 
	 */
	public function addJoin($join)
	{
		if(is_array($join) && !empty($join)) $this->joins[] = $join;	
	}

	/**
	 * return the joins
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
		if(is_array($whereNot) && !empty($whereNot)) $this->whereNotIns[] = $whereNot;	
	}

	/**
	 * return the where not ins
	 * @return array
	 */
	public function getWhereNotIns()
	{
		return $this->whereNotIns;
	}

	/**
	 * getter
	 * @return string
	 */
	public function getTableName()
	{
		return $this->tableName;
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
	
	abstract function buildBaseQuery();
	abstract function execute();
}
 ?>