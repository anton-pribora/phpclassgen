<?php
// <complexContent
//   id = ID
//   mixed = boolean
//   {any attributes with non-schema namespace . . .}>
//   Content: (annotation?, (complexContentRestriction | complexContentExtension))
// </complexContent>
class XsdComplexContent extends XsdBaseElement
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
     * mixed = boolean
     * 
     * @var 
     */
    public $mixed = null;

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
        
        if ( $this->hasXmlAttribute('mixed') )
        {
            $this->mixed = $this->getXmlAttribute('mixed');
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
        $string .= CbUtil::$indent . "@mixed => ". var_export($this->mixed, true) ."\n";
        if ( $this->hasAnnotation() )
        {
            $string .= CbUtil::$indent ."annotation:";
            $string .= trim(CbUtil::indent((string) $this->getAnnotation(), CbUtil::$indent . CbUtil::$indent)) ."\n";
        }
        if ( $this->hasRestriction() )
        {
            $string .= CbUtil::$indent ."restriction:";
            $string .= trim(CbUtil::indent((string) $this->getRestriction(), CbUtil::$indent . CbUtil::$indent)) ."\n";
        }
        if ( $this->hasExtension() )
        {
            $string .= CbUtil::$indent ."extension:";
            $string .= trim(CbUtil::indent((string) $this->getExtension(), CbUtil::$indent . CbUtil::$indent)) ."\n";
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

    /**
     * 
     * @return bool
     */
    public function hasRestriction()
    {
        return $this->hasComponents('restriction');
    }

    /**
     * 
     * @return XsdComplexContentRestriction
     */
    public function getRestriction()
    {
        return $this->getComponents('restriction')[0];
    }

    /**
     * 
     * @return bool
     */
    public function hasExtension()
    {
        return $this->hasComponents('extension');
    }

    /**
     * 
     * @return XsdComplexContentExtension
     */
    public function getExtension()
    {
        return $this->getComponents('extension')[0];
    }
}

