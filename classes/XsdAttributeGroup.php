<?php
// <attributeGroup
//   id = ID
//   name = NCName
//   ref = QName
//   {any attributes with non-schema namespace . . .}>
//   Content: (annotation?, ((attribute | attributeGroup)*, anyAttribute?))
// </attributeGroup>
class XsdAttributeGroup extends XsdBaseElement
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
     * ref = QName
     * 
     * @var 
     */
    public $ref = null;

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
        
        if ( $this->hasXmlAttribute('ref') )
        {
            $this->ref = $this->getXmlAttribute('ref');
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
        $string .= CbUtil::$indent . "@ref => ". var_export($this->ref, true) ."\n";
        if ( $this->hasAnnotation() )
        {
            $string .= CbUtil::$indent ."annotation:";
            $string .= trim(CbUtil::indent((string) $this->getAnnotation(), CbUtil::$indent . CbUtil::$indent)) ."\n";
        }
        if ( $this->hasAttributes() )
        {
            $string .= CbUtil::$indent ."attributes(". count($this->getComponents("attribute")) ."): Array (\n";
            foreach ($this->getAttributes() as $i => $element)
            {
                $string .= CbUtil::$indent . CbUtil::$indent . $i ." => ";
                $string .= trim(CbUtil::indent((string) $element, CbUtil::$indent . CbUtil::$indent)) ."\n";
            }
            $string .= CbUtil::$indent .")\n";
        }
        if ( $this->hasAttributeGroups() )
        {
            $string .= CbUtil::$indent ."attributeGroups(". count($this->getComponents("attributeGroup")) ."): Array (\n";
            foreach ($this->getAttributeGroups() as $i => $element)
            {
                $string .= CbUtil::$indent . CbUtil::$indent . $i ." => ";
                $string .= trim(CbUtil::indent((string) $element, CbUtil::$indent . CbUtil::$indent)) ."\n";
            }
            $string .= CbUtil::$indent .")\n";
        }
        if ( $this->hasAnyAttribute() )
        {
            $string .= CbUtil::$indent ."anyAttribute:";
            $string .= trim(CbUtil::indent((string) $this->getAnyAttribute(), CbUtil::$indent . CbUtil::$indent)) ."\n";
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
    public function hasAttributes()
    {
        return $this->hasComponents('attribute');
    }

    /**
     * 
     * @return XsdAttribute[]
     */
    public function getAttributes()
    {
        return $this->getComponents('attribute');
    }

    /**
     * 
     * @return bool
     */
    public function hasAttributeGroups()
    {
        return $this->hasComponents('attributeGroup');
    }

    /**
     * 
     * @return XsdAttributeGroup[]
     */
    public function getAttributeGroups()
    {
        return $this->getComponents('attributeGroup');
    }

    /**
     * 
     * @return bool
     */
    public function hasAnyAttribute()
    {
        return $this->hasComponents('anyAttribute');
    }

    /**
     * 
     * @return XsdAnyAttribute
     */
    public function getAnyAttribute()
    {
        return $this->getComponents('anyAttribute')[0];
    }
}

