<?php 

use Hugorut\Filter\Factories\FiltersFactory;

class FiltersFactoryTest extends PHPUnit_Framework_TestCase
{
    public function test_gets_correct_array_from_constructor()
    {
        $resources = ['test' => 'Stubs\\TestInstance'];
        $filterFactory = new FiltersFactory($resources);

        $this->assertEquals($resources, $filterFactory->getResources());
    }    

    public function test_gets_correct_array_from_config()
    {
        $filterFactory = new FiltersFactory;

        $this->assertEquals([], $filterFactory->getResources());
    }
}