<?php 

class FilterableTest extends PHPUnit_Framework_TestCase
{
    public function setUp()
    {
        $this->filterable = Mockery::mock('Hugorut\Filter\Factories\Filterable')->makePartial();
    }
    
    public function tearDown()
    {
        Mockery::close();
    }

    public function test($value='')
    {
        # code...
    }
}