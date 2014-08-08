<?php
// <union
//   id = ID
//   memberTypes = List of QName
//   {any attributes with non-schema namespace . . .}>
//   Content: (annotation?, simpleType*)
// </union>
class XsdUnion extends XsdBaseElement
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
     * memberTypes = List of QName
     * 
     * @var 
     */
    public $memberTypes = null;

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
        
        if ( $this->hasXmlAttribute('memberTypes') )
        {
            $this->memberTypes = $this->getXmlAttribute('memberTypes');
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
        $string .= CbUtil::$indent . "@memberTypes => ". var_export($this->memberTypes, true) ."\n";
        if ( $this->hasAnnotation() )
        {
            $string .= CbUtil::$indent ."annotation:";
            $string .= trim(CbUtil::indent((string) $this->getAnnotation(), CbUtil::$indent . CbUtil::$indent)) ."\n";
        }
        if ( $this->hasSimpleTypes() )
        {
            $string .= CbUtil::$indent ."simpleTypes(". count($this->getComponents("simpleType")) ."): Array (\n";
            foreach ($this->getSimpleTypes() as $i => $element)
            {
                $string .= CbUtil::$indent . CbUtil::$indent . $i ." => ";
                $string .= trim(CbUtil::indent((string) $element, CbUtil::$indent . CbUtil::$indent)) ."\n";
            }
            $string .= CbUtil::$indent .")\n";
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
    public function hasSimpleTypes()
    {
        return $this->hasComponents('simpleType');
    }

    /**
     * 
     * @return XsdSimpleType[]
     */
    public function getSimpleTypes()
    {
        return $this->getComponents('simpleType');
    }
}

