<?php
// <extension
//   base = QName
//   id = ID
//   {any attributes with non-schema namespace . . .}>
//   Content: (annotation?, ((group | all | choice | sequence)?, ((attribute | attributeGroup)*, anyAttribute?)))
// </extension>
class XsdComplexContentExtension extends XsdBaseElement
{
    /**
     * Attribute
     * base = QName
     * 
     * @var 
     */
    public $base = null;

    /**
     * Attribute
     * id = ID
     * 
     * @var 
     */
    public $id = null;

    /**
     * Some initialization
     * 
     */
    protected function initialize()
    {
        parent::initialize();
        
        if ( $this->hasXmlAttribute('base') )
        {
            $this->base = $this->getXmlAttribute('base');
        }
        
        if ( $this->hasXmlAttribute('id') )
        {
            $this->id = $this->getXmlAttribute('id');
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
        $string .= CbUtil::$indent . "@base => ". var_export($this->base, true) ."\n";
        $string .= CbUtil::$indent . "@id => ". var_export($this->id, true) ."\n";
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
}

