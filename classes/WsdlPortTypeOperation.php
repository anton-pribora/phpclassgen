<?php

class WsdlPortTypeOperation extends WsdlBaseElement
{
    /**
     * 
     * @var WsdlPortTypeOperationElement[]
     */
    protected $inputs = [];
    
    /**
     * 
     * @var WsdlPortTypeOperationElement[]
     */
    protected $outputs = [];
    
    /**
     * 
     * @var WsdlPortTypeOperationElement[]
     */
    protected $faults = [];
    
    protected function initialize() 
    {
        $this->loadInputs();
        $this->loadOutputs();
        $this->loadFaults();
    }
    
    protected function loadInputs()
    {
        $result = $this->xmlElement->getElementsByTagNameNS($this->parser->getWsdlNs(), 'input');
        
        foreach ( $result as $element )
        {
            $this->inputs[] = new WsdlPortTypeOperationElement($element, $this->parser, $this->targetNamespace);
        }
    }
    
    /**
     * 
     * @return WsdlPortTypeOperationElement[]
     */
    public function getInputs()
    {
        return $this->inputs;
    }
    
    protected function loadOutputs()
    {
        $result = $this->xmlElement->getElementsByTagNameNS($this->parser->getWsdlNs(), 'output');
        
        foreach ( $result as $element )
        {
            $this->outputs[] = new WsdlPortTypeOperationElement($element, $this->parser, $this->targetNamespace);
        }
    }
    
    /**
     * 
     * @return WsdlPortTypeOperationElement[]
     */
    public function getOutputs()
    {
        return $this->outputs;
    }
    
    protected function loadFaults()
    {
        $result = $this->xmlElement->getElementsByTagNameNS($this->parser->getWsdlNs(), 'fault');
        
        foreach ( $result as $element )
        {
            $this->faults[] = new WsdlPortTypeOperationElement($element, $this->parser, $this->targetNamespace);
        }
    }
    
    /**
     * 
     * @return WsdlPortTypeOperationElement[]
     */
    public function getFaults()
    {
        return $this->faults;
    }
    
    public function __toString()
    {
        $string = "";
        $string .= $this->getName() ."\n";
        
        foreach ( $this->getInputs() as $element )
        {
            $string .= "  Input: ". $element->getMessageName() ."\n";
        }
        
        foreach ( $this->getOutputs() as $element )
        {
            $string .= "  Output: ". $element->getMessageName() ."\n";
        }
        
        foreach ( $this->getFaults() as $element )
        {
            $string .= "  Falut: ". $element->getMessageName() ."\n";
        }
        
        return $string;
    }
}