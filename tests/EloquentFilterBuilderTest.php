<?php 

use Hugorut\Filter\Builders\EloquentFilterBuilder;

class EloquentFilterBuilderTest extends PHPUnit_Framework_TestCase
{
    public function setUp()
    {
        $this->model = Mockery::mock('Illuminate\Database\Eloquent\Model');
        $this->builder = new EloquentFilterBuilder($this->model);
    }

    public function tearDown()
    {   
        Mockery::close();
    }

    public function test_build_base_query_delegates_to_a_model_select()
    {
        $this->model->shouldReceive('select')
                    ->once();

        $this->builder->buildBaseQuery();
    }

    public function test_execute_delegates_to_a_model_group_by()
    {
        $tableName = 'test';
        
        $this->model->shouldReceive('select')
                    ->once()
                    ->andReturn($this->model);
        
        $this->builder->buildBaseQuery();

        $this->model->shouldReceive('getTable')
                    ->once()
                    ->andReturn($tableName);        
        $this->model->shouldReceive('groupBy')
                    ->once()
                    ->with($tableName.'.id')
                    ->andReturn($this->model);
        $this->model->shouldReceive('select')
                    ->once()
                    ->with($tableName.'.*');

        $this->builder->execute();
    }

    /**
     * @expectedException Hugorut\Filter\Exceptions\ClauseInvalidException
     * @return test
     */
    public function test_invalid_join_throws_exception()
    {
        $this->builder->addJoin([1, 2]);
        
        $this->builder->buildClauses();
    }    

    /**
     * @expectedException Hugorut\Filter\Exceptions\ClauseInvalidException
     * @return test
     */
    public function test_invalid_where_throws_exception()
    {
        $this->builder->addWhere([1, 2]);

        $this->builder->buildClauses();
    }    

    /**
     * @expectedException Hugorut\Filter\Exceptions\ClauseInvalidException
     * @return test
     */
    public function test_invalid_where_not_in_throws_exception()
    {
        $this->builder->addWhereNotIn([1, 2, 3]);

        $this->builder->buildClauses();
    }    

    /**
     * @expectedException Hugorut\Filter\Exceptions\ClauseInvalidException
     * @return test
     */
    public function test_invalid_where_not_in_with_non_array_parameter_throws_exception()
    {
        $this->builder->addWhereNotIn([1, 2]);

        $this->builder->buildClauses();
    }    

    public function test_valid_join_added_to_model()
    {
        $expectedJoin = ['contacts', 'users.id', '=', 'contacts.user_id'];

        $this->model->shouldReceive('select')
                    ->once()
                    ->andReturn($this->model);
        
        $this->builder->buildBaseQuery();

        $this->builder->addJoin($expectedJoin);

        $this->model->shouldReceive('leftJoin')
                    ->once()
                    ->with($expectedJoin[0],$expectedJoin[1],$expectedJoin[2],$expectedJoin[3])
                    ->andReturn($this->model);

        $this->builder->buildClauses();
    }    

    public function test_valid_where_added_to_model()
    {
        $expectedWhere = ['contacts.id', '=', 1];

        $this->model->shouldReceive('select')
                    ->once()
                    ->andReturn($this->model);
        
        $this->builder->buildBaseQuery();

        $this->builder->addWhere($expectedWhere);

        $this->model->shouldReceive('where')
                    ->once()
                    ->with($expectedWhere[0],$expectedWhere[1],$expectedWhere[2])
                    ->andReturn($this->model);

        $this->builder->buildClauses();
    }    

    public function test_valid_where_not_added_to_model()
    {
        $expectedWhereNotIn = ['contacts.id', [1,2]];

        $this->model->shouldReceive('select')
                    ->once()
                    ->andReturn($this->model);
        
        $this->builder->buildBaseQuery();

        $this->builder->addWhereNotIn($expectedWhereNotIn);

        $this->model->shouldReceive('whereNotIn')
                    ->once()
                    ->with($expectedWhereNotIn[0],$expectedWhereNotIn[1])
                    ->andReturn($this->model);

        $this->builder->buildClauses();
    }
}