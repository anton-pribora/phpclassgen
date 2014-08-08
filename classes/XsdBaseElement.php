<?php

class XsdBaseElement extends WsdlParserXmlElement
{
	protected $components = [];

	protected function initialize()
	{
		$this->registerComponents();
	}
	
	protected function registerComponents()
	{
		foreach ( $this->xmlElement->childNodes as $node )
		{
			if ( $node->namespaceURI != $this->parser->getXsdNs() )
			{
				continue;
			}
			
			// Костыль для рестрикшинов и экстешнинов, если они в контексте контентов
			if ( in_array($node->localName, ['extension', 'restriction']) && in_array($this->xmlElement->localName, ['simpleContent', 'complexContent']) )
			{
				$class = 'Xsd'. ucfirst($this->xmlElement->localName) . ucfirst($node->localName);
			}
			else 
			{
				$class = 'Xsd'. ucfirst($node->localName);
			}
			
			if ( !class_exists($class) )
			{
				echo 'Class '. $class .' not found', "\n";
				continue;
			}
			
			$element = new $class($node, $this->parser, $this->targetNamespace);
			
			$this->components[ $node->localName ][ $element->getTargetNamespace() ][] = $element;
		}
	}
	
	/**
	 * 
	 * @param string $tag
	 * @param string $namespace
	 */
	public function hasComponents($tag, $namespace = null)
	{
		if ( !isset($namespace) )
			$namespace = $this->targetNamespace;
		
		return isset($this->components[ $tag ][ $namespace ]);
	}
	
	/**
	 * 
	 * @param string $tag
	 * @param string $namespace
	 * @return XsdType[]
	 */
	public function getComponents($tag, $namespace = null)
	{
		if ( !isset($namespace) )
			$namespace = $this->targetNamespace;
		
		if ( $this->hasComponents($tag, $namespace) )
			return $this->components[ $tag ][ $namespace ];
		
		return [];
	}
	
	public function getAllComponents()
	{
		return $this->components;
	}
	
	public function getName()
	{
		return $this->getXmlAttribute('name');
	}
	
	public function getQName()
	{
		return $this->targetNamespace .'#'. $this->getName();
	}
}