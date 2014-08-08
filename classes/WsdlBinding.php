<?php

class WsdlBinding extends WsdlBaseElement
{
	/**
	 * 
	 * @var WsdlPortType
	 */
	protected $portType = null;
	
	protected function initialize()
	{
	}
	
	public function getTypeName()
	{
		return $this->getXmlAttribute('type');
	}
	
	/**
	 * 
	 * @return WsdlPortType
	 */
	public function getPortType()
	{
		if ( !isset( $this->portType ) )
		{
			$type = $this->parseType($this->getTypeName());
			$this->portType = $this->parser->findPortType($type->getName(), $type->getNamespaceUri());
		}
		
		return $this->portType;
	}
	
	public function __toString()
	{
		$string  = "";
		$string .= $this->getName() ."\n";
		$string .= "  PortType: ". $this->getPortType()->getName() ."\n";
		
		return $string;
	}
}