<?php

class WsdlPortTypeOperationElement extends WsdlBaseElement
{
    /**
     * 
     * @var WsdlMessage
     */
    protected $message = null;
    
    public function getMessage()
    {
        if ( !isset($this->message) )
        {
            $type = $this->parseType($this->getMessageName());
            $this->message = $this->parser->findMessage($type->getName(), $type->getNamespaceUri());
        }
        
        return $this->message;
    }
    
    /**
     * 
     * @return string
     */
    public function getMessageName()
    {
        return $this->getXmlAttribute('message');
    }
}