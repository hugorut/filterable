<?php 

class FactoryTest extends PHPUnit_Framework_TestCase
{
    public function setUp()
    {
        $this->factory = Mockery::mock('Hugorut\Filter\Factories\Factory')->makePartial();
    }
    
    public function tearDown()
    {
        Mockery::close();
    }

    /**
     * @expectedException Hugorut\Filter\Exceptions\InstanceNotSupportedException
     * @return test
     */
    public function test_exception_thrown_if_instance_not_present()
    {
        $this->factory->getInstance('test');
    }

    public function test_should_return_valid_class_if_present()
    {
        $this->factory->setResources(['test' => 'Stubs\\TestInstance']);

        $instance = $this->factory->getInstance('test');

        $this->assertInstanceOf(Stubs\TestInstance::class, $instance);
    }

    public function test_add_a_resource_to_the_resources_array()
    {
        $expected = [
            'test' => 'Stubs\\TestInstance',
            'test2' => 'Stubs\\TestInstance'
        ];

        $this->factory->setResources(['test' => 'Stubs\\TestInstance']);

        $this->factory->addResource(['test2' => 'Stubs\\TestInstance']);

        $this->assertEquals($expected, $this->factory->getResources());
    }

    public function test_should_return_an_array_of_instances()
    {
        $this->factory->setResources(['test' => 'Stubs\\TestInstance', 'test2' => 'Stubs\\TestInstance2']);
        
        $this->assertEquals(
            [new Stubs\TestInstance, new Stubs\TestInstance2], 
            $this->factory->getAllInstances()
            );
    }
}