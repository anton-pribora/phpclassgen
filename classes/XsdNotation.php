<?php
// <notation
//   id = ID
//   name = NCName
//   public = token
//   system = anyURI
//   {any attributes with non-schema namespace . . .}>
//   Content: (annotation?)
// </notation>
class XsdNotation extends XsdBaseElement
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
     * name = NCName
     * 
     * @var 
     */
    public $name = null;

    /**
     * Attribute
     * public = token
     * 
     * @var 
     */
    public $public = null;

    /**
     * Attribute
     * system = anyURI
     * 
     * @var 
     */
    public $system = null;

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
        
        if ( $this->hasXmlAttribute('name') )
        {
            $this->name = $this->getXmlAttribute('name');
        }
        
        if ( $this->hasXmlAttribute('public') )
        {
            $this->public = $this->getXmlAttribute('public');
        }
        
        if ( $this->hasXmlAttribute('system') )
        {
            $this->system = $this->getXmlAttribute('system');
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
        $string .= CbUtil::$indent . "@name => ". var_export($this->name, true) ."\n";
        $string .= CbUtil::$indent . "@public => ". var_export($this->public, true) ."\n";
        $string .= CbUtil::$indent . "@system => ". var_export($this->system, true) ."\n";
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

