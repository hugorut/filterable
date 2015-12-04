<?php  
namespace Filter\Filters;

/**
* Filterable main abstract class
*/
abstract class Filterable
{
	protected $join;
	protected $whereNotIn;
	protected $where;
	protected $table;

	/**
	 * getter
	 * @return string
	 */
	public function getJoin()
	{
		return $this->join;
	}	

	/**
	 * setter
	 * @return null
	 */
	public function setJoin(array $join)
	{
		return $this->join = $join;
	}

	/**
	 * getter
	 * @return string
	 */
	public function getWhereNotIn()
	{
		return $this->whereNotIn;
	}

	/**
	 * setter
	 * @return null
	 */
	public function setWhereNotIn(array $whereNotIn)
	{
		return $this->whereNotIn = $whereNotIn;
	}


	/**
	 * getter
	 * @return string
	 */
	public function getWhere()
	{
		return $this->where;
	}

	/**
	 * setter
	 * @return null 
	 */
	public function setWhere(array $where)
	{
		return $this->where = $where;
	}


	/**
	 * set table name
	 * @param string $value 
	 */
	public function setTable($table)
	{
		$this->table = $table;
	}

	/**
	 * build sql
	 * @param  array  $values of ids
	 * @return null
	 */
	abstract function buildSql(array $values);
}

 ?>