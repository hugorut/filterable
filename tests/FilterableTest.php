<?php 

class FilterableTest extends PHPUnit_Framework_TestCase
{
    public function setUp()
    {
        $this->filterable = Mockery::mock('Hugorut\Filter\Filters\Filterable')->makePartial();
    }
    
    public function tearDown()
    {
        Mockery::close();
    }

    public function test_getters_and_setters()
    {
        $expected = ['test'];

        $this->filterable->setJoin($expected);
        $this->assertEquals($expected, $this->filterable->getJoin());        

        $this->filterable->setWhere($expected);
        $this->assertEquals($expected, $this->filterable->getWhere());

        $this->filterable->setWhereNotIn($expected);
        $this->assertEquals($expected, $this->filterable->getWhereNotIn());        

        $this->filterable->setTable('test');
        $this->assertEquals('test', $this->filterable->getTable());
    }    

    /**
     * @expectedException Hugorut\Filter\Exceptions\TableNameException
     * @return test
     */
    public function test_throw_exception_with_no_table()
    {
        $this->filterable->buildSql([1,2]);
    }    

    public function test_calls_child_class_for_set_clauses_logic()
    {
        $passThru = [1,2];

        $this->filterable->shouldReceive('setClauses')
                         ->once()
                         ->with($passThru);

        $this->filterable->setTable('test');
        $this->filterable->buildSql($passThru);
    }
}