<?php 

class BuilderTest extends PHPUnit_Framework_TestCase
{
    public function setUp()
    {
        $this->builder = Mockery::mock('Hugorut\Filter\Builders\Builder')->makePartial();
    }

    public function tearDown()
    {
        Mockery::close();
    }

    public function test_addition_setters_and_getters()
    {
        $query = ['test','query', '=', 'here'];
        $query2 = ['another', '=', 'here'];
        $expected = [$query, $query2];

        $this->builder->addWhere($query);
        $this->builder->addWhere($query2);
        $this->assertEquals($expected, $this->builder->getWheres());

        $this->builder->addWhereNotIn($query);
        $this->builder->addWhereNotIn($query2);
        $this->assertEquals($expected, $this->builder->getWhereNotIns());          

        $this->builder->addWhereIn($query);
        $this->builder->addWhereIn($query2);
        $this->assertEquals($expected, $this->builder->getWhereIns());        

        $this->builder->addJoin($query);
        $this->builder->addJoin($query2);
        $this->assertEquals($expected, $this->builder->getJoins());
    }

    public function test_build_query_loops_through_filter_objects_to_get_properties()
    {
        $expectedWhere = ['column', [1,2]];
        $expectedWhereNotIn = ['column', [3,4]];
        $expectedWhereIn = ['column', [5,6]];
        $expectedJoin = ['table', 'table.tests_id', '=', 'test.id'];

        $mockFilterable = Mockery::mock('Hugorut\Filter\Filters\Filterable');
        $this->builder->addFilter($mockFilterable);

        $mockFilterable->shouldReceive('getWhere')
                       ->once()
                       ->andReturn($expectedWhere);        
        $mockFilterable->shouldReceive('getWhereNotIn')
                       ->once()
                       ->andReturn($expectedWhereNotIn);         
        $mockFilterable->shouldReceive('getWhereIn')
                       ->once()
                       ->andReturn($expectedWhereIn);        
        $mockFilterable->shouldReceive('getJoin')
                       ->once()
                       ->andReturn($expectedJoin);

        // these methods are abstract delegating to the concrete instance
        $this->builder->shouldReceive('buildBaseQuery')
                      ->once();
        $this->builder->shouldReceive('buildClauses')
                      ->once();

        $this->builder->buildQuery();

        $this->assertEquals([$expectedWhere], $this->builder->getWheres());
        $this->assertEquals([$expectedWhereNotIn], $this->builder->getWhereNotIns());
        $this->assertEquals([$expectedWhereIn], $this->builder->getWhereIns());
        $this->assertEquals([$expectedJoin], $this->builder->getJoins());
    }
}