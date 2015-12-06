<?php 
namespace Hugorut\Filter\Filters;

use Hugorut\Filter\Exceptions\TableNameException;
use Illuminate\Database\Eloquent\Model;

class EloquentFilterable extends Filterable
{
	/**
	 * model instance
	 * 
	 * @var Model
	 */
	private $model;

	function __construct(Model $model) 
	{
		$this->model = $model;
	}
	
	/**
	 * set the clauses of the sql from the ids array
	 * for a where not in statement
	 * 
	 * @param  array  $ids
	 * @return null
	 */
	public function without(array $ids)
	{
		$tableName = $this->model->getTable();

		$this->setJoin([$tableName, $this->table.'.'.$this->model->getForeignKey(), '=', $tableName.'.id']);
		$this->setWhereNotIn([$tableName.'.id', $ids]);
	}	

	/**
	 * set the clauses of the sql from the ids array
	 * for a where in statement
	 * 
	 * @param  array  $ids
	 * @return null
	 */
	public function only(array $ids)
	{
		$tableName = $this->model->getTable();

		$this->setJoin([$tableName, $this->table.'.'.$this->model->getForeignKey(), '=', $tableName.'.id']);
		$this->setWhereIn([$tableName.'.id', $ids]);
	}
}
 ?>