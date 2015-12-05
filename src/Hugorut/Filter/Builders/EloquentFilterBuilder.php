<?php 

namespace Hugorut\Filter\Builders;
    
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
            $this->query->leftJoin($join[0], $join[1], $join[2], $join[3]);
        }

        foreach ($this->whereNotIns as $key => $notIn) {
            $this->query->whereNotIn($notIn[0], $notIn[1]);
        }

        foreach ($this->wheres as $key => $where) {
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
        return $this->query->groupBy($this->model->getTable().'.id')
                           ->select($this->model->getTable().'.*');
    }

}