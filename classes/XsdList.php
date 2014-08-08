<?php
// <list
//   id = ID
//   itemType = QName
//   {any attributes with non-schema namespace . . .}>
//   Content: (annotation?, simpleType?)
// </list>
class XsdList extends XsdBaseElement
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
     * itemType = QName
     * 
     * @var 
     */
    public $itemType = null;

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
        
        if ( $this->hasXmlAttribute('itemType') )
        {
            $this->itemType = $this->getXmlAttribute('itemType');
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
        $string .= CbUtil::$indent . "@itemType => ". var_export($this->itemType, true) ."\n";
        if ( $this->hasAnnotation() )
        {
            $string .= CbUtil::$indent ."annotation:";
            $string .= trim(CbUtil::indent((string) $this->getAnnotation(), CbUtil::$indent . CbUtil::$indent)) ."\n";
        }
        if ( $this->hasSimpleType() )
        {
            $string .= CbUtil::$indent ."simpleType:";
            $string .= trim(CbUtil::indent((string) $this->getSimpleType(), CbUtil::$indent . CbUtil::$indent)) ."\n";
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
    public function hasSimpleType()
    {
        return $this->hasComponents('simpleType');
    }

    /**
     * 
     * @return XsdSimpleType
     */
    public function getSimpleType()
    {
        return $this->getComponents('simpleType')[0];
    }
}

