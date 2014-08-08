<?php
// <import
//   id = ID
//   namespace = anyURI
//   schemaLocation = anyURI
//   {any attributes with non-schema namespace . . .}>
//   Content: (annotation?)
// </import>
class XsdImport extends XsdBaseElement
{
    /**
     * Attribute
     * id = ID
     * 
     * @var 
     */
    public $id = null;

    /**
     * Attribute
     * namespace = anyURI
     * 
     * @var 
     */
    public $namespace = null;

    /**
     * Attribute
     * schemaLocation = anyURI
     * 
     * @var 
     */
    public $schemaLocation = null;

    /**
     * Some initialization
     * 
     */
    protected function initialize()
    {
        parent::initialize();
        
        if ( $this->hasXmlAttribute('id') )
        {
            $this->id = $this->getXmlAttribute('id');
        }
        
        if ( $this->hasXmlAttribute('namespace') )
        {
            $this->namespace = $this->getXmlAttribute('namespace');
        }
        
        if ( $this->hasXmlAttribute('schemaLocation') )
        {
            $this->schemaLocation = $this->getXmlAttribute('schemaLocation');
        }
    }

    /**
     * 
     * @return string
     */
    public function __toString()
    {
        $string  = "";
        $string .= __CLASS__ ."\n";
        $string .= CbUtil::$indent . "@id => ". var_export($this->id, true) ."\n";
        $string .= CbUtil::$indent . "@namespace => ". var_export($this->namespace, true) ."\n";
        $string .= CbUtil::$indent . "@schemaLocation => ". var_export($this->schemaLocation, true) ."\n";
        if ( $this->hasAnnotation() )
        {
            $string .= CbUtil::$indent ."annotation:";
            $string .= trim(CbUtil::indent((string) $this->getAnnotation(), CbUtil::$indent . CbUtil::$indent)) ."\n";
        }
        return $string;
    }

    /**
     * 
     * @return bool
     */
    public function hasAnnotation()
    {
        return $this->hasComponents('annotation');
    }

    /**
     * 
     * @return XsdAnnotation
     */
    public function getAnnotation()
    {
        return $this->getComponents('annotation')[0];
    }
}

