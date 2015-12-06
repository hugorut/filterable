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

        $this->filterable->setWhereIn($expected);
        $this->assertEquals($expected, $this->filterable->getWhereIn());        

        $this->filterable->setTable('test');
        $this->assertEquals('test', $this->filterable->getTable());
    }    

    /**
     * @expectedException Hugorut\Filter\Exceptions\TableNameException
     * @return test
     */
    public function test_throw_exception_with_no_table()
    {
        $this->filterable->buildSql([1,2], 'only');
    }    

    public function test_calls_child_class_for_only_method_passthru()
    {
        $passThru = [1,2];

        $this->filterable->shouldReceive('only')
                         ->once()
                         ->with($passThru);

        $this->filterable->setTable('test');
        $this->filterable->only($passThru);
    }    

    public function test_calls_child_class_for_without_method_passthru()
    {
        $passThru = [1,2];

        $this->filterable->shouldReceive('without')
                         ->once()
                         ->with($passThru);

        $this->filterable->setTable('test');
        $this->filterable->without($passThru);
    }
}