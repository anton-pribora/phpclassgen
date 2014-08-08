<?php

class WsdlService extends WsdlBaseElement
{
	/**
	 * 
	 * @var WsdlPort[]
	 */
	protected $ports = [];
	
	protected function initialize()
	{
		$result = $this->xmlElement->getElementsByTagNameNS($this->parser->getWsdlNs(), 'port');
		
		if ( !count($result) )
			throw new Exception('No ports were found in service '. $this->getName());
		
		foreach ( $result as $node )
		{
			$this->registerPort(new WsdlPort($node, $this->parser, $this->targetNamespace));
		}
	}
	
	public function registerPort(WsdlPort $port)
	{
		$this->ports[] = $port;
	}
	
	/**
	 * 
	 * @return WsdlPort[]
	 */
	public function getPorts()
	{
		return $this->ports;
	}
	
	public function __toString()
	{
		$string = "";
		
		$string .= $this->getName() ."\n";
		$string .= "  Ports (endpoints)\n";
		
		foreach ( $this->getPorts() as $port )
		{
			$string .= CbUtil::indent(trim((string) $port), '    ') ."\n";
		}
		
		return $string;
	}
}