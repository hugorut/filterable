<?php  
namespace Filter\Filters;

/**
* Filterable main abstract class
*/
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
	 * associative array of models used
	 * 
	 * @var array
	 */
	protected $modelName;

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
	 * build the sql through setting properties
	 * 
	 * @param  array  $values of ids
	 * @return null
	 */
	abstract function buildSql(array $values);
}

 ?>