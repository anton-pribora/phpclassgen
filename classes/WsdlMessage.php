<?php

class WsdlMessage extends WsdlBaseElement
{
    /**
     * 
     * @var WsdlMessagePart[]
     */
    protected $parts = [];
    
    protected function initialize()
    {
        $this->loadParts();
    }
    
    protected function loadParts()
    {
        $result = $this->xmlElement->getElementsByTagNameNS($this->parser->getWsdlNs(), 'part');
        
        if ( count($result) )
        {
            foreach ( $result as $element )
            {
                $this->parts[] = new WsdlMessagePart($element, $this->parser, $this->targetNamespace);
            }
        }
    }
    
    /**
     * 
     * @return WsdlMessagePart[]
     */
    public function getParts()
    {
        return $this->parts;
    }
}