<?php 

namespace Hugorut\Filter\Builders;
use Hugorut\Filter\Exceptions\ClauseInvalidException;
use Illuminate\Database\Eloquent\Model;  

class EloquentFilterBuilder extends Builder
{
    /**
     * the eloquent model instance
     * 
     * @var Model
     */
    protected $model;

    function __construct(Model $model) {
        $this->model = $model;
    }

    /**
     * create a base eloquent search
     * 
     * @return null
     */
    public function buildBaseQuery()
    {
        $this->query = $this->model->select();
    }

    /**
     * add the joins and wheres to the query
     * 
     * @return null
     */
    public function buildClauses()
    {
        foreach ($this->joins as $join) {
            if (count($join) < 4) {
                throw new ClauseInvalidException("Join clause is invalid please set 4 parameters");
            }
            $this->query->leftJoin($join[0], $join[1], $join[2], $join[3]);
        }

        foreach ($this->whereNotIns as $key => $notIn) {
            if (count($notIn) < 2) {
                throw new ClauseInvalidException("Where not in clause is invalid please set 2 parameters");
            }
            if (!is_array($notIn[1])) {
                throw new ClauseInvalidException("Where not in clause is invalid, parameter 2 should be type array");
            }
            $this->query->whereNotIn($notIn[0], $notIn[1]);
        }

        foreach ($this->wheres as $key => $where) {
            if (count($where) < 3) {
                throw new ClauseInvalidException("Where clause is invalid please set 3 parameters");
            }
            $this->query->where($where[0], $where[1], $where[2]);
        }
    }

    /**
     * get the query
     * 
     * @return collection
     */
    public function execute()
    {
        $tableName = $this->model->getTable();

        return $this->query->groupBy($tableName.'.id')
                           ->select($tableName.'.*');
    }

}