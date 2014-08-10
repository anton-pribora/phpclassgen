<?php

class WsdlTypes extends WsdlBaseElement
{
    /**
     * 
     * @var XsdSchema[]
     */
    protected $schemas = [];
    
    /**
     * 
     * @var XsdType[]
     */
    protected $types = [];
    
    /**
     * 
     * @var XsdElement[]
     */
    protected $elements = [];
    
    protected function initialize()
    {
        $this->loadSchemas();
        $this->loadTypes();
        $this->loadElements();
    }
    
    protected function loadSchemas()
    {
        $result = $this->xmlElement->getElementsByTagNameNS($this->parser->getXsdNs(), 'schema');
        
        if ( count($result) )
        {
            foreach ( $result as $element )
            {
                $this->registerSchema(new XsdSchema($element, $this->parser, $this->targetNamespace));
            }
        }
    }
    
    /**
     * 
     * @return XsdSchema[]
     */
    public function getSchemas()
    {
        return $this->schemas;
    }
    
    public function registerSchema(XsdSchema $schema)
    {
        $this->schemas[] = $schema;
    }
    
    protected function loadTypes()
    {
        foreach ( $this->schemas as $schema )
        {
            foreach ( $schema->getSimpleTypes() as $type )
            {
                $this->registerType($type);
            }
            
            foreach ( $schema->getComplexTypes() as $type )
            {
                $this->registerType($type);
            }
        }
    }
    
    public function registerType(XsdType $type)
    {
// 		echo 'Зарегистрирован тип '. $type->getName() .'['. $type->getTargetNamespace() .']' . "\n";
        $this->types[ $type->getTargetNamespace() ][ $type->getName() ] = $type;
    }
    
    /**
     * 
     * @param string $name
     * @param string $namespace
     * @return XsdType
     */
    public function getType($name, $namespace = null)
    {
        if ( !isset($namespace) )
            $namespace = $this->targetNamespace;
        
        if ( isset($this->types[ $namespace ][ $name ]) )
            return $this->types[ $namespace ][ $name ];
        
        return null;
    }
    
    /**
     * 
     * @return XsdType[]
     */
    public function getAllTypes($namespace = null)
    {
        if ( !isset($namespace) )
            $namespace = $this->targetNamespace;
        
        return $this->types[ $namespace ];
    }
    
    protected function loadElements()
    {
        foreach ( $this->schemas as $schema )
        {
            foreach ( $schema->getElements() as $element )
            {
                $this->registerElement($element);
            }
        }
    }
    
    public function registerElement(XsdElement $element)
    {
// 		echo 'Зарегистрирован элемент '. $element->getName() .'['. $element->getTargetNamespace() .']' . "\n";
        $this->elements[ $element->getTargetNamespace() ][ $element->getName() ] = $element;
    }
    
    /**
     * 
     * @param string $name
     * @param string $namespace
     * @return XsdElement
     */
    public function getElement($name, $namespace = null)
    {
        if ( !isset($namespace) )
            $namespace = $this->targetNamespace;
        
        if ( isset($this->elements[ $namespace ][ $name ]) )
            return $this->elements[ $namespace ][ $name ];
        
        return null;
    }
}