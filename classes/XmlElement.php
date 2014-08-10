<?php

abstract class XmlElement
{
    /**
     * 
     * @var DOMElement
     */
    protected $xmlElement = null;
    
    protected $namespaceURI = null;
    
    public function __construct(DOMElement $element)
    {
        $this->xmlElement   = $element;
        $this->namespaceURI = $element->namespaceURI;
        
        $this->initialize();
    }
    
    protected function initialize()
    {
    }
    
    public function getNamespaceURI()
    {
        return $this->namespaceURI;
    }
    
    /**
     * 
     * @param string $name
     * @param string $ns
     * @return string
     */
    public function getXmlAttribute($name, $ns = null)
    {
        if ( $ns )
            return $this->xmlElement->getAttributeNS($ns, $name);
        else 
            return $this->xmlElement->getAttribute($name);
    }
    
    /**
     * 
     * @return string
     */
    public function getXmlTextContent()
    {
        return trim($this->xmlElement->textContent);
    }
    
    /**
     * 
     * @return boolean
     */
    public function hasXmlTextContent()
    {
        return $this->getXmlTextContent() !== '';
    }
    
    /**
     * 
     * @param string $name
     * @param string $ns
     * @return boolean
     */
    public function hasXmlAttribute($name, $ns = null)
    {
        if ( $ns )
            return $this->xmlElement->hasAttributeNS($ns, $name);
        else 
            return $this->xmlElement->hasAttribute($name);
    }
}