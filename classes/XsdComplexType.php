<?php
// <complexType
//   abstract = boolean : false
//   block = (#all | List of (extension | restriction))
//   final = (#all | List of (extension | restriction))
//   id = ID
//   mixed = boolean : false
//   name = NCName
//   {any attributes with non-schema namespace . . .}>
//   Content: (annotation?, (simpleContent | complexContent | ((group | all | choice | sequence)?, ((attribute | attributeGroup)*, anyAttribute?))))
// </complexType>
class XsdComplexType extends XsdType
{
    /**
     * Attribute
     * abstract = boolean : false
     * 
     * @var 
     */
    public $abstract = false;

    /**
     * Attribute
     * block = (#all | List of (extension | restriction))
     * 
     * @var 
     */
    public $block = null;

    /**
     * Attribute
     * final = (#all | List of (extension | restriction))
     * 
     * @var 
     */
    public $final = null;

    /**
     * Attribute
     * id = ID
     * 
     * @var 
     */
    public $id = null;

    /**
     * Attribute
     * mixed = boolean : false
     * 
     * @var 
     */
    public $mixed = false;

    /**
     * Attribute
     * name = NCName
     * 
     * @var 
     */
    public $name = null;

    /**
     * Some initialization
     * 
     */
    protected function initialize()
    {
        parent::initialize();
        
        if ( $this->hasXmlAttribute('abstract') )
        {
            $this->abstract = $this->getXmlAttribute('abstract');
        }
        
        if ( $this->hasXmlAttribute('block') )
        {
            $this->block = $this->getXmlAttribute('block');
        }
        
        if ( $this->hasXmlAttribute('final') )
        {
            $this->final = $this->getXmlAttribute('final');
        }
        
        if ( $this->hasXmlAttribute('id') )
        {
            $this->id = $this->getXmlAttribute('id');
        }
        
        if ( $this->hasXmlAttribute('mixed') )
        {
            $this->mixed = $this->getXmlAttribute('mixed');
        }
        
        if ( $this->hasXmlAttribute('name') )
        {
            $this->name = $this->getXmlAttribute('name');
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
        $string .= CbUtil::$indent . "@abstract => ". var_export($this->abstract, true) ."\n";
        $string .= CbUtil::$indent . "@block => ". var_export($this->block, true) ."\n";
        $string .= CbUtil::$indent . "@final => ". var_export($this->final, true) ."\n";
        $string .= CbUtil::$indent . "@id => ". var_export($this->id, true) ."\n";
        $string .= CbUtil::$indent . "@mixed => ". var_export($this->mixed, true) ."\n";
        $string .= CbUtil::$indent . "@name => ". var_export($this->name, true) ."\n";
        if ( $this->hasAnnotation() )
        {
            $string .= CbUtil::$indent ."annotation:";
            $string .= trim(CbUtil::indent((string) $this->getAnnotation(), CbUtil::$indent . CbUtil::$indent)) ."\n";
        }
        if ( $this->hasGroup() )
        {
            $string .= CbUtil::$indent ."group:";
            $string .= trim(CbUtil::indent((string) $this->getGroup(), CbUtil::$indent . CbUtil::$indent)) ."\n";
        }
        if ( $this->hasAll() )
        {
            $string .= CbUtil::$indent ."all:";
            $string .= trim(CbUtil::indent((string) $this->getAll(), CbUtil::$indent . CbUtil::$indent)) ."\n";
        }
        if ( $this->hasChoice() )
        {
            $string .= CbUtil::$indent ."choice:";
            $string .= trim(CbUtil::indent((string) $this->getChoice(), CbUtil::$indent . CbUtil::$indent)) ."\n";
        }
        if ( $this->hasSequence() )
        {
            $string .= CbUtil::$indent ."sequence:";
            $string .= trim(CbUtil::indent((string) $this->getSequence(), CbUtil::$indent . CbUtil::$indent)) ."\n";
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
        if ( $this->hasSimpleContent() )
        {
            $string .= CbUtil::$indent ."simpleContent:";
            $string .= trim(CbUtil::indent((string) $this->getSimpleContent(), CbUtil::$indent . CbUtil::$indent)) ."\n";
        }
        if ( $this->hasComplexContent() )
        {
            $string .= CbUtil::$indent ."complexContent:";
            $string .= trim(CbUtil::indent((string) $this->getComplexContent(), CbUtil::$indent . CbUtil::$indent)) ."\n";
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
    public function hasGroup()
    {
        return $this->hasComponents('group');
    }

    /**
     * 
     * @return XsdGroup
     */
    public function getGroup()
    {
        return $this->getComponents('group')[0];
    }

    /**
     * 
     * @return bool
     */
    public function hasAll()
    {
        return $this->hasComponents('all');
    }

    /**
     * 
     * @return XsdAll
     */
    public function getAll()
    {
        return $this->getComponents('all')[0];
    }

    /**
     * 
     * @return bool
     */
    public function hasChoice()
    {
        return $this->hasComponents('choice');
    }

    /**
     * 
     * @return XsdChoice
     */
    public function getChoice()
    {
        return $this->getComponents('choice')[0];
    }

    /**
     * 
     * @return bool
     */
    public function hasSequence()
    {
        return $this->hasComponents('sequence');
    }

    /**
     * 
     * @return XsdSequence
     */
    public function getSequence()
    {
        return $this->getComponents('sequence')[0];
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

    /**
     * 
     * @return bool
     */
    public function hasSimpleContent()
    {
        return $this->hasComponents('simpleContent');
    }

    /**
     * 
     * @return XsdSimpleContent
     */
    public function getSimpleContent()
    {
        return $this->getComponents('simpleContent')[0];
    }

    /**
     * 
     * @return bool
     */
    public function hasComplexContent()
    {
        return $this->hasComponents('complexContent');
    }

    /**
     * 
     * @return XsdComplexContent
     */
    public function getComplexContent()
    {
        return $this->getComponents('complexContent')[0];
    }
}

