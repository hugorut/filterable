<?php  
namespace Hugorut\Filter\Filters;

use Hugorut\Filter\Exceptions\TableNameException;

abstract class Filterable
{
	/**
	 * join for the filter
	 * 
	 * @var array
	 */
	protected $join;

	/**
	 * where not in clause for the filter
	 * 
	 * @var array
	 */
	protected $whereNotIn;

	/**
	 * whree in clause for the filter
	 * 
	 * @var array
	 */
	protected $whereIn;

	/**
	 * where clause for the filter
	 * 
	 * @var array
	 */
	protected $where;

	/**
	 * table identifier
	 * 
	 * @var string
	 */
	protected $table;

	/**
	 * get join value
	 * 
	 * @return string
	 */
	public function getJoin()
	{
		return $this->join;
	}	

	/**
	 * set join value
	 * 
	 * @return self
	 */
	public function setJoin(array $join)
	{
		$this->join = $join;

		return $this;
	}

	/**
	 * get where not in value
	 * 
	 * @return array
	 */
	public function getWhereNotIn()
	{
		return $this->whereNotIn;
	}

	/**
	 * set where not in value
	 * 
	 * @return self
	 */
	public function setWhereNotIn(array $whereNotIn)
	{
		$this->whereNotIn = $whereNotIn;

		return $this;
	}

	/**
	 * Gets the whree in clause for the filter.
	 *
	 * @return array
	 */
	public function getWhereIn()
	{
	    return $this->whereIn;
	}

	/**
	 * Sets the whree in clause for the filter.
	 *
	 * @param array $whereIn the where in
	 *
	 * @return self
	 */
	public function setWhereIn(array $whereIn)
	{
	    $this->whereIn = $whereIn;

	    return $this;
	}


	/**
	 * get where value
	 * 
	 * @return array
	 */
	public function getWhere()
	{
		return $this->where;
	}

	/**
	 * setter
	 * @return self 
	 */
	public function setWhere(array $where)
	{
		$this->where = $where;

		return $this;
	}


	/**
	 * set table name
	 * 
	 * @param string $value 
	 * @return  self 
	 */
	public function setTable($table)
	{
		$this->table = $table;	

		return $this;
	}

	/**
	 * Gets the table identifier.
	 *
	 * @return string
	 */
	public function getTable()
	{
	    return $this->table;
	}

	/**
	 * build the sql but let the child classes set behavior
	 *
	 * @throws Hugorut\Filter\Exceptions\TableNameException
	 * @param  array  $ids 
	 * @param  string $type
	 * @return self
	 */
	public function buildSql(array $ids, $type)
	{
		if(is_null($this->table)) {
			throw new TableNameException("valid tablename needs to be set");
		}

		$this->{$type}($ids);

		return $this;
	}

	/**
	 * build the sql through setting properties
	 * 
	 * @param  array  $values of ids
	 * @return null
	 */
	abstract function only(array $values);

	/**
	 * [only description]
	 * @param  array  $values [description]
	 * @return [type]         [description]
	 */
	abstract function without(array $values);
}

 ?>