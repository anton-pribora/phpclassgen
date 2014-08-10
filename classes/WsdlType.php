<?php

class WsdlType
{
    protected $name = null;
    
    protected $namespace  = null;
    
    public function __construct($name, $namespace)
    {
        $this->name = $name;
        $this->namespace  = $namespace;
    }
    
    public function getName()
    {
        return $this->name;
    }
    
    public function getNamespaceUri()
    {
        return $this->namespace;
    }
    
    public function isSimpleXsdType()
    {
        return $this->namespace == 'http://www.w3.org/2001/XMLSchema';
    }
}