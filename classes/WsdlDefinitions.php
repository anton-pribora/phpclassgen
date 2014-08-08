<?php

class WsdlDefinitions extends WsdlBaseElement
{
	/**
	 * 
	 * @var WsdlMessage[]
	 */
	protected $messages = [];
	
	/**
	 * 
	 * @var WsdlPortType[]
	 */
	protected $portTypes = [];
	
	/**
	 * 
	 * @var WsdlBinding[]
	 */
	protected $bindings = [];
	
	/**
	 * 
	 * @var WsdlService[]
	 */
	protected $services = [];
	
	/**
	 * 
	 * @var WsdlTypesuri
	 */
	protected $types = [];
	
	protected function initialize()
	{
		$this->targetNamespace = $this->getXmlAttribute('targetNamespace');
		
		if ( !$this->targetNamespace )
			throw new WsdlParserException('Target namespace is empty');
		
		$this->loadTypes();
		$this->loadMessages();
		$this->loadPortTypes();
		$this->loadBindings();
		$this->loadServices();
	}
	
	protected function loadTypes()
	{
		$result = $this->xmlElement->getElementsByTagNameNS($this->parser->getWsdlNs(), 'types');
		
		if ( !count($result) )
			throw new WsdlParserException('Element <wsdl:types> was not found');
		
		$this->types = new WsdlTypes($result->item(0), $this->parser, $this->targetNamespace);
	}
	
	/**
	 * 
	 * @return WsdlTypes
	 */
	public function getTypes()
	{
		return $this->types;
	}
	
	protected function loadMessages()
	{
		$result = $this->xmlElement->getElementsByTagNameNS($this->parser->getWsdlNs(), 'message');
		
		foreach ( $result as $element )
		{
			$this->registerMessage(new WsdlMessage($element, $this->parser, $this->targetNamespace));
		}
	}
	
	public function registerMessage(WsdlMessage $message)
	{
		$this->messages[ $message->getTargetNamespace() ][ $message->getName() ] = $message;
	}
	
	/**
	 * 
	 * @param string $name
	 * @param string $namespace
	 * @return WsdlPortType
	 */
	public function getMessage($name, $namespace = null)
	{
		if ( !isset($namespace) )
			$namespace = $this->targetNamespace;
		
		if ( isset($this->messages[ $namespace ][ $name ]) )
			return $this->messages[ $namespace ][ $name ];
		
		return null;
	}
	
	public function loadPortTypes()
	{
		$result = $this->xmlElement->getElementsByTagNameNS($this->parser->getWsdlNs(), 'portType');
		
		foreach ( $result as $element )
		{
			$this->registerPortType(new WsdlPortType($element, $this->parser, $this->targetNamespace));
		}
	}
	
	public function registerPortType(WsdlPortType $portType)
	{
		$this->portTypes[ $portType->getTargetNamespace() ][ $portType->getName() ] = $portType;
	}
	
	/**
	 * 
	 * @param string $name
	 * @param string $namespace
	 * @return WsdlPortType
	 */
	public function getPortType($name, $namespace = null)
	{
		if ( !isset($namespace) )
			$namespace = $this->targetNamespace;
		
		if ( isset($this->portTypes[ $namespace ][ $name ]) )
			return $this->portTypes[ $namespace ][ $name ];
		
		return null;
	}
	
	protected function loadBindings()
	{
		$result = $this->xmlElement->getElementsByTagNameNS($this->parser->getWsdlNs(), 'binding');
		
		foreach ( $result as $element )
		{
			$this->registerBinding(new WsdlBinding($element, $this->parser, $this->targetNamespace));
		}
	}
	
	public function registerBinding(WsdlBinding $binding)
	{
		$this->bindings[ $binding->getTargetNamespace() ][ $binding->getName() ] = $binding;
	}
	
	/**
	 * 
	 * @param string $name
	 * @param string $namespace
	 * @return WsdlBinding
	 */
	public function getBinding($name, $namespace = null)
	{
		if ( !isset($namespace) )
			$namespace = $this->targetNamespace;
		
		if ( isset($this->bindings[ $namespace ][ $name ]) )
			return $this->bindings[ $namespace ][ $name ];
		
		return null;
	}
	
	protected function loadServices()
	{
		$result = $this->xmlElement->getElementsByTagNameNS($this->parser->getWsdlNs(), 'service');
		
		foreach ( $result as $element )
		{
			$this->registerService(new WsdlService($element, $this->parser, $this->targetNamespace));
		}
	}
	
	public function registerService(WsdlService $service)
	{
		$this->services[ $service->getTargetNamespace() ][ $service->getName() ] = $service;
	}
	
	/**
	 * 
	 * @param string $namespace
	 * @return WsdlService[]
	 */
	public function getServices($namespace = null)
	{
		if ( !isset($namespace) )
			$namespace = $this->targetNamespace;
		
		return $this->services[ $namespace ];
	}
	
	/**
	 * 
	 * @param string $namespace
	 * @return WsdlBinding[]
	 */
	public function getBindings($namespace = null)
	{
		if ( !isset($namespace) )
			$namespace = $this->targetNamespace;
		
		return $this->bindings[ $namespace ];
	}
	
	/**
	 * 
	 * @param string $namespace
	 * @return WsdlPortType[]
	 */
	public function getPortTypes($namespace = null)
	{
		if ( !isset($namespace) )
			$namespace = $this->targetNamespace;
		
		return $this->portTypes[ $namespace ];
	}
}