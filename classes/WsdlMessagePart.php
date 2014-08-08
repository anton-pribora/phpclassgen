<?php

class WsdlMessagePart extends WsdlBaseElement
{
	/**
	 * 
	 * @var XsdElement
	 */
	protected $element = null;
	
	/**
	 * 
	 * @var XsdType
	 */
	protected $type = null;
	
	protected $elementAttribute = null;
	
	protected $typeAttribute = null;
	
	protected function initialize()
	{
		$this->elementAttribute = $this->getXmlAttribute('element');
		
		$this->typeAttribute = $this->getXmlAttribute('type');
	}
	
	public function isElement()
	{
		return (bool) $this->elementAttribute;
	}
	
	public function isType()
	{
		return (bool) $this->typeAttribute;
	}
	
	/**
	 * 
	 * @return XsdElement
	 */
	public function getElement()
	{
		if ( !isset($this->element) )
		{
			$type = $this->parseType($this->elementAttribute);
			$this->element = $this->parser->findXsdElement($type->getName(), $type->getNamespaceUri());
		}
		
		return $this->element;
	}
	
	/**
	 * 
	 * @return XsdType
	 */
	public function getType()
	{
		if ( !isset($this->type) )
		{
			$type = $this->parseType($this->typeAttribute);
			$this->type = $this->parser->findXsdType($type->getName(), $type->getNamespaceUri());
		}
		
		return $this->type;
	}
}