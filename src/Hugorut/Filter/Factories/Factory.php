<?php  
namespace Hugorut\Filter\Factories;

use Exception;
use Hugorut\Filter\Exceptions\InstanceNotSupportedException;

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
	 * 
	 * @param   array<array> $resources 
	 * @return  self 
	 */
	public function setResources(array $resources)
	{
		$this->resources = $resources;

		return $this;
	}

	/**
	 * add a resource to the main array
	 * 
	 * @param array $resource 
	 * @return self
	 */
	public function addResource(array $resource)
	{
		$this->resources = array_merge($this->resources, $resource);

		return $this;
	}

	/**
	 * get the resources
	 * 
	 * @return array<array>
	 */
	public function getResources()
	{
		return $this->resources;
	}

	/**
	 * return an array of instances
	 * 
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