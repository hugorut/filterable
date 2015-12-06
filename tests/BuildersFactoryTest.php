<?php 

use Hugorut\Filter\Factories\BuildersFactory;

class BuildersFactoryTest extends PHPUnit_Framework_TestCase
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

        $buildersFactory = new BuildersFactory($this->config, $resources);

        $this->assertEquals($resources, $buildersFactory->getResources());
    }    

    public function test_gets_correct_array_from_config()
    {
        $this->config->shouldReceive('get')
                     ->with('filter.Builders')
                     ->once()
                     ->andReturn([]);

        $buildersFactory = new BuildersFactory($this->config);

        $this->assertEquals([], $buildersFactory->getResources());
    }
}