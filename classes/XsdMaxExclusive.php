<?php
// <maxExclusive
//   fixed = boolean : false
//   id = ID
//   value = anySimpleType
//   {any attributes with non-schema namespace . . .}>
//   Content: (annotation?)
// </maxExclusive>
class XsdMaxExclusive extends XsdBaseElement
{
    /**
     * Attribute
     * fixed = boolean : false
     * 
     * @var 
     */
    public $fixed = false;

    /**
     * Attribute
     * id = ID
     * 
     * @var 
     */
    public $id = null;

    /**
     * Attribute
     * value = anySimpleType
     * 
     * @var 
     */
    public $value = null;

    /**
     * Some initialization
     * 
     */
    protected function initialize()
    {
        parent::initialize();
        
        if ( $this->hasXmlAttribute('fixed') )
        {
            $this->fixed = $this->getXmlAttribute('fixed');
        }
        
        if ( $this->hasXmlAttribute('id') )
        {
            $this->id = $this->getXmlAttribute('id');
        }
        
        if ( $this->hasXmlAttribute('value') )
        {
            $this->value = $this->getXmlAttribute('value');
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
        $string .= CbUtil::$indent . "@fixed => ". var_export($this->fixed, true) ."\n";
        $string .= CbUtil::$indent . "@id => ". var_export($this->id, true) ."\n";
        $string .= CbUtil::$indent . "@value => ". var_export($this->value, true) ."\n";
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

