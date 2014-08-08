<?php

class WsdlPort extends WsdlBaseElement
{
	/**
	 * 
	 * @var SoapAddress
	 */
	protected $address = null;
	
	/**
	 * 
	 * @var WsdlBinding
	 */
	protected $binding = null;
	
	public function initialize()
	{
		$this->loadAddress();
	}
	
	protected function loadAddress()
	{
// 		$result = $this->xmlElement->getElementsByTagNameNS($this->parser->getSoapNs(), 'address');
		$result = $this->xmlElement->getElementsByTagName('address');
		
		if ( !$result->length )
			throw new WsdlParserException('No address element found for port '. $this->getName());
		
		$this->address = new SoapAddress($result->item(0), $this->parser, $this->targetNamespace);
	}
	
	public function getBindingName()
	{
		return $this->getXmlAttribute('binding');
	}
	
	/**
	 * 
	 * @return WsdlBinding
	 */
	public function getBinding()
	{
		if ( !isset($this->binding) )
		{
			$type = $this->parseType($this->getBindingName());
			$this->binding = $this->parser->findBinding($type->getName(), $type->getNamespaceUri());
		}
		
		return $this->binding;
	}
	
	public function getAddress()
	{
		return $this->address;
	}
	
	public function __toString()
	{
		$string = "";
		$string .= $this->getName() ."\n";
		$string .= "  Binding: ". $this->getBindingName() ."\n";
		$string .= "  Soap Address: ". $this->getAddress()->getLocation() ."\n";

		return $string;
	}
}