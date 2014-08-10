<?php
// <redefine
//   id = ID
//   schemaLocation = anyURI
//   {any attributes with non-schema namespace . . .}>
//   Content: (annotation | (simpleType | complexType | group | attributeGroup))*
// </redefine>
class XsdRedefine extends XsdBaseElement
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
        $string .= CbUtil::$indent . "@schemaLocation => ". var_export($this->schemaLocation, true) ."\n";
        if ( $this->hasAnnotations() )
        {
            $string .= CbUtil::$indent ."annotations(". count($this->getComponents("annotation")) ."): Array (\n";
            foreach ($this->getAnnotations() as $i => $element)
            {
                $string .= CbUtil::$indent . CbUtil::$indent . $i ." => ";
                $string .= trim(CbUtil::indent((string) $element, CbUtil::$indent . CbUtil::$indent)) ."\n";
            }
            $string .= CbUtil::$indent .")\n";
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
        if ( $this->hasComplexTypes() )
        {
            $string .= CbUtil::$indent ."complexTypes(". count($this->getComponents("complexType")) ."): Array (\n";
            foreach ($this->getComplexTypes() as $i => $element)
            {
                $string .= CbUtil::$indent . CbUtil::$indent . $i ." => ";
                $string .= trim(CbUtil::indent((string) $element, CbUtil::$indent . CbUtil::$indent)) ."\n";
            }
            $string .= CbUtil::$indent .")\n";
        }
        if ( $this->hasGroups() )
        {
            $string .= CbUtil::$indent ."groups(". count($this->getComponents("group")) ."): Array (\n";
            foreach ($this->getGroups() as $i => $element)
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
        return $string;
    }

    /**
     * 
     * @return bool
     */
    public function hasAnnotations()
    {
        return $this->hasComponents('annotation');
    }

    /**
     * 
     * @return XsdAnnotation[]
     */
    public function getAnnotations()
    {
        return $this->getComponents('annotation');
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

    /**
     * 
     * @return bool
     */
    public function hasComplexTypes()
    {
        return $this->hasComponents('complexType');
    }

    /**
     * 
     * @return XsdComplexType[]
     */
    public function getComplexTypes()
    {
        return $this->getComponents('complexType');
    }

    /**
     * 
     * @return bool
     */
    public function hasGroups()
    {
        return $this->hasComponents('group');
    }

    /**
     * 
     * @return XsdGroup[]
     */
    public function getGroups()
    {
        return $this->getComponents('group');
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
}

