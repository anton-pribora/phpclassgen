<?php
// <schema
//   attributeFormDefault = (qualified | unqualified) : unqualified
//   blockDefault = (#all | List of (extension | restriction | substitution))  : ''
//   elementFormDefault = (qualified | unqualified) : unqualified
//   finalDefault = (#all | List of (extension | restriction | list | union))  : ''
//   id = ID
//   targetNamespace = anyURI
//   version = token
//   xml:lang = language
//   {any attributes with non-schema namespace . . .}>
//   Content: ((include | import | redefine | annotation)*, (((simpleType | complexType | group | attributeGroup) | element | attribute | notation))*)
// </schema>
class XsdSchema extends XsdBaseElement
{
    /**
     * Attribute
     * attributeFormDefault = (qualified | unqualified) : unqualified
     * 
     * @var 
     */
    public $attributeFormDefault = 'unqualified';

    /**
     * Attribute
     * blockDefault = (#all | List of (extension | restriction | substitution))  : ''
     * 
     * @var 
     */
    public $blockDefault = null;

    /**
     * Attribute
     * elementFormDefault = (qualified | unqualified) : unqualified
     * 
     * @var 
     */
    public $elementFormDefault = 'unqualified';

    /**
     * Attribute
     * finalDefault = (#all | List of (extension | restriction | list | union))  : ''
     * 
     * @var 
     */
    public $finalDefault = null;

    /**
     * Attribute
     * id = ID
     * 
     * @var 
     */
    public $id = null;

    /**
     * Attribute
     * targetNamespace = anyURI
     * 
     * @var 
     */
    public $targetNamespace = null;

    /**
     * Attribute
     * version = token
     * 
     * @var 
     */
    public $version = null;

    /**
     * Attribute
     * xml:lang = language
     * 
     * @var 
     */
    public $lang = null;

    /**
     * Some initialization
     * 
     */
    protected function initialize()
    {
        parent::initialize();
        
        if ( $this->hasXmlAttribute('attributeFormDefault') )
        {
            $this->attributeFormDefault = $this->getXmlAttribute('attributeFormDefault');
        }
        
        if ( $this->hasXmlAttribute('blockDefault') )
        {
            $this->blockDefault = $this->getXmlAttribute('blockDefault');
        }
        
        if ( $this->hasXmlAttribute('elementFormDefault') )
        {
            $this->elementFormDefault = $this->getXmlAttribute('elementFormDefault');
        }
        
        if ( $this->hasXmlAttribute('finalDefault') )
        {
            $this->finalDefault = $this->getXmlAttribute('finalDefault');
        }
        
        if ( $this->hasXmlAttribute('id') )
        {
            $this->id = $this->getXmlAttribute('id');
        }
        
        if ( $this->hasXmlAttribute('targetNamespace') )
        {
            $this->targetNamespace = $this->getXmlAttribute('targetNamespace');
        }
        
        if ( $this->hasXmlAttribute('version') )
        {
            $this->version = $this->getXmlAttribute('version');
        }
        
        if ( $this->hasXmlAttribute('xml:lang') )
        {
            $this->lang = $this->getXmlAttribute('xml:lang');
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
        $string .= CbUtil::$indent . "@attributeFormDefault => ". var_export($this->attributeFormDefault, true) ."\n";
        $string .= CbUtil::$indent . "@blockDefault => ". var_export($this->blockDefault, true) ."\n";
        $string .= CbUtil::$indent . "@elementFormDefault => ". var_export($this->elementFormDefault, true) ."\n";
        $string .= CbUtil::$indent . "@finalDefault => ". var_export($this->finalDefault, true) ."\n";
        $string .= CbUtil::$indent . "@id => ". var_export($this->id, true) ."\n";
        $string .= CbUtil::$indent . "@targetNamespace => ". var_export($this->targetNamespace, true) ."\n";
        $string .= CbUtil::$indent . "@version => ". var_export($this->version, true) ."\n";
        $string .= CbUtil::$indent . "@lang => ". var_export($this->lang, true) ."\n";
        if ( $this->hasIncludes() )
        {
            $string .= CbUtil::$indent ."includes(". count($this->getComponents("include")) ."): Array (\n";
            foreach ($this->getIncludes() as $i => $element)
            {
                $string .= CbUtil::$indent . CbUtil::$indent . $i ." => ";
                $string .= trim(CbUtil::indent((string) $element, CbUtil::$indent . CbUtil::$indent)) ."\n";
            }
            $string .= CbUtil::$indent .")\n";
        }
        if ( $this->hasImports() )
        {
            $string .= CbUtil::$indent ."imports(". count($this->getComponents("import")) ."): Array (\n";
            foreach ($this->getImports() as $i => $element)
            {
                $string .= CbUtil::$indent . CbUtil::$indent . $i ." => ";
                $string .= trim(CbUtil::indent((string) $element, CbUtil::$indent . CbUtil::$indent)) ."\n";
            }
            $string .= CbUtil::$indent .")\n";
        }
        if ( $this->hasRedefines() )
        {
            $string .= CbUtil::$indent ."redefines(". count($this->getComponents("redefine")) ."): Array (\n";
            foreach ($this->getRedefines() as $i => $element)
            {
                $string .= CbUtil::$indent . CbUtil::$indent . $i ." => ";
                $string .= trim(CbUtil::indent((string) $element, CbUtil::$indent . CbUtil::$indent)) ."\n";
            }
            $string .= CbUtil::$indent .")\n";
        }
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
        if ( $this->hasElements() )
        {
            $string .= CbUtil::$indent ."elements(". count($this->getComponents("element")) ."): Array (\n";
            foreach ($this->getElements() as $i => $element)
            {
                $string .= CbUtil::$indent . CbUtil::$indent . $i ." => ";
                $string .= trim(CbUtil::indent((string) $element, CbUtil::$indent . CbUtil::$indent)) ."\n";
            }
            $string .= CbUtil::$indent .")\n";
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
        if ( $this->hasNotations() )
        {
            $string .= CbUtil::$indent ."notations(". count($this->getComponents("notation")) ."): Array (\n";
            foreach ($this->getNotations() as $i => $element)
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
    public function hasIncludes()
    {
        return $this->hasComponents('include');
    }

    /**
     * 
     * @return XsdInclude[]
     */
    public function getIncludes()
    {
        return $this->getComponents('include');
    }

    /**
     * 
     * @return bool
     */
    public function hasImports()
    {
        return $this->hasComponents('import');
    }

    /**
     * 
     * @return XsdImport[]
     */
    public function getImports()
    {
        return $this->getComponents('import');
    }

    /**
     * 
     * @return bool
     */
    public function hasRedefines()
    {
        return $this->hasComponents('redefine');
    }

    /**
     * 
     * @return XsdRedefine[]
     */
    public function getRedefines()
    {
        return $this->getComponents('redefine');
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

    /**
     * 
     * @return bool
     */
    public function hasElements()
    {
        return $this->hasComponents('element');
    }

    /**
     * 
     * @return XsdElement[]
     */
    public function getElements()
    {
        return $this->getComponents('element');
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
    public function hasNotations()
    {
        return $this->hasComponents('notation');
    }

    /**
     * 
     * @return XsdNotation[]
     */
    public function getNotations()
    {
        return $this->getComponents('notation');
    }
}

