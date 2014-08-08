<?php
// <anyAttribute
//   id = ID
//   namespace = ((##any | ##other) | List of (anyURI | (##targetNamespace | ##local)) )  : ##any
//   processContents = (lax | skip | strict) : strict
//   {any attributes with non-schema namespace . . .}>
//   Content: (annotation?)
// </anyAttribute>
class XsdAnyAttribute extends XsdBaseElement
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
     * namespace = ((##any | ##other) | List of (anyURI | (##targetNamespace | ##local)) )  : ##any
     * 
     * @var 
     */
    public $namespace = null;

    /**
     * Attribute
     * processContents = (lax | skip | strict) : strict
     * 
     * @var 
     */
    public $processContents = 'strict';

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
        
        if ( $this->hasXmlAttribute('processContents') )
        {
            $this->processContents = $this->getXmlAttribute('processContents');
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
        $string .= CbUtil::$indent . "@processContents => ". var_export($this->processContents, true) ."\n";
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

