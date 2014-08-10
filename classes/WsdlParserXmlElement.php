<?php

abstract class WsdlParserXmlElement extends XmlElement
{
    protected $parser = null;
    
    protected $targetNamespace = null;
    
    public function __construct(DOMElement $element, WsdlParser $parser, $targetNamespace = null)
    {
        $this->parser = $parser;
        $this->targetNamespace = $targetNamespace;
        
        parent::__construct($element);
    }
    
    /**
     * 
     * @return string
     */
    public function getTargetNamespace()
    {
        return $this->targetNamespace;
    }
    
    /**
     * 
     * @param string $type
     * @return WsdlType
     */
    public function parseType($type)
    {
        $parts = explode(':', $type, 2);
        
        $name = null;
        $namespace  = null;
        
        if ( count($parts) == 2 )
        {
            $name      = $parts[1];
            $namespace = $this->xmlElement->lookupNamespaceUri($parts[0]);
        }
        else 
        {
            $name      = $parts[0];
            $namespace = $this->targetNamespace;
        }
        
        $type = new WsdlType($name, $namespace);
        
        return $type;
    }
    
    /**
     * 
     * @param mixed $type
     * @return XsdType
     */
    public function findType($type)
    {
        if ( ! $type instanceof WsdlType )
            $type = $this->parseType($type);
        
        return $this->parser->findXsdType($type->getName(), $type->getNamespaceUri());
    }
}