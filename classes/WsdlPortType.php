<?php

class WsdlPortType extends WsdlBaseElement
{
	/**
	 * 
	 * @var WsdlPortTypeOperation[]
	 */
	protected $operations = [];
	
	protected function initialize()
	{
		$this->loadOperations();
	}
	
	protected function loadOperations()
	{
		$result = $this->xmlElement->getElementsByTagNameNS($this->parser->getWsdlNs(), 'operation');
		
		foreach ( $result as $element )
		{
			$this->registerOperation(new WsdlPortTypeOperation($element, $this->parser, $this->targetNamespace));
		}
	}
	
	public function registerOperation(WsdlPortTypeOperation $operation)
	{
		$this->operations[] = $operation;
	}
	
	/**
	 * 
	 * @return WsdlPortTypeOperation[]
	 */
	public function getOperations()
	{
		return $this->operations;
	}
	
	public function __toString()
	{
		$string  = "";
		$string .= $this->getName() ."\n";
		$string .= "  Operations:\n";
		
		foreach ( $this->getOperations() as $operation )
		{
			$string .= CbUtil::indent(trim((string) $operation), '    ') ."\n";
		}
		
		return $string;
	}
}