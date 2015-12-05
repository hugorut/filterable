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
	 * 
	 * @param  array  $ids
	 * @return null
	 */
	public function setClauses(array $ids)
	{
		$this->join = [$this->model->getTable(), $this->table.'.'.$this->model->getForeignKey(), '=', $this->model->getTable().'.id'];
		$this->whereNotIn = [$this->model->getTable().'.id', $ids];
	}
}
 ?>