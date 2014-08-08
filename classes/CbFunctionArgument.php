<?php

class CbFunctionArgument
{
	protected $description = null;
	
	protected $name = null;
	
	protected $type = null;

	/**
	 *
	 * @var CbFunction
	 */
	protected $function = null;
	
	public function __construct(CbFunction $function)
	{
		$this->function = $function;
	}
	
	public function setName($name)
	{
		$this->name = $name;
	}
	
	public function getName()
	{
		return $this->name;
	}
	
	public function setType($type)
	{
		$this->type = $type;
	}
	
	public function getType()
	{
		return $this->type;
	}
	
	public function getTypeForDoc()
	{
		if ( $this->type instanceof CbClass )
		{
			return $this->type->getName();
		}
		
		return $this->getType();
	}
	
	public function getTypeForFunction()
	{
		if ( $this->type instanceof CbClass )
		{
			return $this->type->getName();
		}
// 		elseif ( preg_match('/string|int|bool|boolean/', $this->type) )
// 		{
// 			return $this->type;
// 		}
		
		return null;
	}
	
	public function setDescription($description)
	{
		$this->description = $description;
	}
	
	public function getDescription()
	{
		return $this->description;
	}
}