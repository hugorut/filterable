<?php 

use Hugorut\Filter\Factories\BuildersFactory;

class BuildersFactoryTest extends PHPUnit_Framework_TestCase
{
    public function test_gets_correct_array_from_constructor()
    {
        $resources = ['test' => 'Stubs\\TestInstance'];
        $buildersFactory = new BuildersFactory($resources);

        $this->assertEquals($resources, $buildersFactory->getResources());
    }    

    public function test_gets_correct_array_from_config()
    {
        $buildersFactory = new BuildersFactory();

        $this->assertEquals([], $buildersFactory->getResources());
    }
}