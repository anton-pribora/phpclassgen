<?php

class WsdlParser
{
    /**
     * Документ
     * 
     * @var DOMDocument
     */
    protected $dom = null;
    
    /**
     * Корневой эелемент
     * 
     * @var WsdlDefinitions
     */
    protected $definitions = null;
    
    /**
     * Процессор xpath
     * 
     * @var DOMXPath
     */
    protected $xpath = null;
    
    protected $types = [];
    
    const NS_WSDL_PREFIX = 'wsdl';
    const NS_WSDL_URI    = 'http://schemas.xmlsoap.org/wsdl/';
    
    const NS_XSD_PREFIX  = 'xsd';
    const NS_XSD_URI     = 'http://www.w3.org/2001/XMLSchema';
    
    const NS_SOAP_PREFIX = 'soap';
    const NS_SOAP_URI    = 'http://schemas.xmlsoap.org/wsdl/soap/';
    
    const NS_XML_PREFIX  = 'xml';
    const NS_XML_URI     = 'http://www.w3.org/XML/1998/namespace';
    
    protected $ns = [
        self::NS_WSDL_PREFIX => self::NS_WSDL_URI,
        self::NS_SOAP_PREFIX => self::NS_SOAP_URI,
        self::NS_XSD_PREFIX  => self::NS_XSD_URI,
        self::NS_XML_PREFIX  => self::NS_XML_URI,
    ];
    
    public function __construct($wsdUri)
    {
        $dom = new DOMDocument();
        
        $this->dom = $dom;
        $this->dom->preserveWhiteSpace = false;
        
        if ( !$dom->load($wsdUri, XML_OPTION_SKIP_WHITE) )
            throw new WsdlParserException('Cann\'t load wsdl');
        
        $this->xpath = new DOMXPath($dom);
        
        foreach ( $this->ns as $prefix => $namespace )
        {
            $this->xpath->registerNamespace($prefix, $namespace);
        }
        
        $result = $this->dom->getElementsByTagNameNS(self::NS_WSDL_URI, 'definitions')->item(0);
        
        if ( !$result )
            throw new WsdlParserException('Element <wsdl:definitions> was not found');
        
        $this->definitions = new WsdlDefinitions($result, $this);
    }
    
    /**
     * 
     * @return WsdlDefinitions
     */
    public function getDefinitions()
    {
        return $this->definitions;
    }
    
    public function getWsdlNs()
    {
        return self::NS_WSDL_URI;
    }
    
    public function getSoapNs()
    {
        return self::NS_SOAP_URI;
    }
    
    public function getXsdNs()
    {
        return self::NS_XSD_URI;
    }
    
    public function getXsdNsPrefix()
    {
        return self::NS_XSD_PREFIX;
    }
    
    public function getXmlNs()
    {
        return self::NS_XML_URI;
    }
    
    /**
     * 
     * @return DOMXPath
     */
    public function getXPath()
    {
        return $this->xpath;
    }
    
    public function findBinding($name, $namespace = null)
    {
        return $this->definitions->getBinding($name, $namespace);
    }
    
    public function findPortType($name, $namespace = null)
    {
        return $this->definitions->getPortType($name, $namespace);
    }
    
    public function findMessage($name, $namespace = null)
    {
        return $this->definitions->getMessage($name, $namespace);
    }
    
    public function findXsdElement($name, $namespace = null)
    {
        return $this->definitions->getTypes()->getElement($name, $namespace);
    }
    
    public function findXsdType($name, $namespace = null)
    {
        if ( $namespace == $this->getXsdNs() )
        {
            $element = $this->dom->createElementNS($this->getXsdNs(), 'simpleType');
            $element->setAttribute('name', $name);
            $xsdSimpleType = new XsdSimpleType($element, $this, $this->getXsdNs());
            
            return $xsdSimpleType;
        }
        
        return $this->definitions->getTypes()->getType($name, $namespace);
    }
    
    public function __toString()
    {
        $string = "";
        
        $string .= "Targetnamespace: ". $this->getDefinitions()->getTargetNamespace() ."\n";
        $string .= "Services:\n";
        
        foreach ( $this->definitions->getServices() as $service )
        {
            $string .= CbUtil::indent((string) $service, '  ');
        }
        
        $string .= "\nBindings:\n";
        
        foreach ( $this->definitions->getBindings() as $binding )
        {
            $string .= CbUtil::indent((string) $binding, '  ');
        }
        
        $string .= "\nPortTypes:\n";
        
        foreach ( $this->definitions->getPortTypes() as $portType )
        {
            $string .= CbUtil::indent((string) $portType, '  ');
        }
        
        $string = trim($string) ."\n";
        
        return $string;
    }
}