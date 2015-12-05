<?php  
namespace Hugorut\Filter\Factories;

use Exception;

abstract class Factory
{
	
	/**
	 * class resources
	 * 
	 * @var array
	 */
	protected $resources = [];

	/**
	 * return a new resource
	 * @param string $type resource type
	 * @return Resource
	 */
	public function getInstance($type)
	{
		$type = strtolower($type);
		if(!isset($this->resources[$type])) {
			throw new InstanceNotSupportedException("type '".$type."' not supported");
		}

		return new $this->resources[$type];
	}	

	/**
	 * override the main resources array
	 * @param array<array> $resources 
	 */
	public function setResources(array $resources)
	{
		$this->resources = $resources;
	}

	/**
	 * add a resource to the main array
	 * @param array $resource associative array with string factory name
	 */
	public function addResource(array $resource)
	{
		$this->resources[] = $resource;
	}

	/**
	 * get the resources
	 * @return array<array>
	 */
	public function getResources()
	{
		return $this->resources;
	}

	/**
	 * return an array of instances
	 * @return array<object>
	 */
	public function getAllInstances()
	{
		$instances = [];
		
		foreach ($this->resources as $key => $namespace) 
		{
			$obj = new $namespace;
			$instances[] = $obj;
		}

		return $instances;
	}

}

 ?>