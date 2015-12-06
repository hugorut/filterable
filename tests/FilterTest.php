<?php  

use Hugorut\Filter\Filter;

class FilterTest extends PHPUnit_Framework_TestCase
{
    
    public function setUp()
    {
        $this->builderFactory = Mockery::mock('Hugorut\Filter\Factories\Factory')->makePartial();
        $this->filterFactory = Mockery::mock('Hugorut\Filter\Factories\Factory')->makePartial();
        
        $this->filter = new Filter($this->builderFactory, $this->filterFactory);
    }

    public function tearDown()
    {
        Mockery::close();
    }

    public function test_builder_instance_drives_filter_type()
    {
        $type = 'test';

        $this->builderFactory->shouldReceive('getInstance')
                             ->with($type)
                             ->once();

        $this->filter->setType($type);                             
    }

    public function test_by_method_calls_filterable_and_builder_with_correct_alias()
    {
        $type = 'test';
        $tableName = 'tableName';
        $method = 'without';
        $filterName = 'sites';
        $filterIds = [1, 2]; 

        $builder = Mockery::mock('Hugorut\Filter\Builders\Builder');
        $filterable = Mockery::mock('Hugorut\Filter\Filters\Filterable');

        $this->builderFactory->shouldReceive('getInstance')
                             ->with($type)
                             ->once()
                             ->andReturn($builder);

        $this->filter->setType($type);

        $this->filterFactory->shouldReceive('getInstance')
                            ->with($filterName)
                            ->once()
                            ->andReturn($filterable);

        $builder->shouldReceive('getTableName')
                ->andReturn($tableName)
                ->once();

        $filterable->shouldReceive('setTable')
                   ->with($tableName)
                   ->once();        
        $filterable->shouldReceive('buildSql')
                   ->with($filterIds, $method)
                   ->once();

        $builder->shouldReceive('addFilter')
                ->with($filterable)
                ->once();

        $this->filter->by([$filterName => $filterIds], $method);
    }
}