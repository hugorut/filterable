<?php 

use Hugorut\Filter\Filters\EloquentFilterable;

class EloquentFilterableTest extends PHPUnit_Framework_TestCase
{
    public function setUp()
    {
        $this->model = Mockery::mock('Illuminate\Database\Eloquent\Model');
        $this->filterable = new EloquentFilterable($this->model);
    }

    public function tearDown()
    {   
        Mockery::close();
    }

    public function test_set_clauses_set_correctly_for_eloquent_specific()
    {
        $table = 'articles';
        $tableName = 'sites';
        $foreignKey = 'site_id';
        $ids = [1,2];

        $expectedJoin = [$tableName, $table.'.'.$foreignKey, '=', $tableName.'.id'];
        $expectedWhereNot = [$tableName.'.id', $ids];

        $this->model->shouldReceive('getTable')
                    ->once()
                    ->andReturn($tableName);
        $this->model->shouldReceive('getForeignKey')
                    ->once()
                    ->andReturn($foreignKey);

        $this->filterable->setTable($table);
        $this->filterable->setClauses($ids);

        $this->assertEquals($expectedJoin, $this->filterable->getJoin());
        $this->assertEquals($expectedWhereNot, $this->filterable->getWhereNotIn());
    }
    
}