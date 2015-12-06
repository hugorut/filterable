<?php 

use Hugorut\Filter\Factories\FiltersFactory;

class FiltersFactoryTest extends PHPUnit_Framework_TestCase
{
    public function setUp()
    {
        $this->config = Mockery::mock('Hugorut\Filter\Helpers\Configable[get]');
    }

    public function tearDown()
    {
        Mockery::close();
    }

    public function test_gets_correct_array_from_constructor()
    {
        $resources = ['test' => 'Stubs\\TestInstance'];
        $filterFactory = new FiltersFactory($this->config, $resources);

        $this->assertEquals($resources, $filterFactory->getResources());
    }    

    public function test_gets_correct_array_from_config()
    {
        $this->config->shouldReceive('get')
                     ->with('filter.Filters')
                     ->once()
                     ->andReturn([]);

        $filterFactory = new FiltersFactory($this->config);

        $this->assertEquals([], $filterFactory->getResources());
    }
}