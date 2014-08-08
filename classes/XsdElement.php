<?php
// <element
//   abstract = boolean : false
//   block = (#all | List of (extension | restriction | substitution))
//   default = string
//   final = (#all | List of (extension | restriction))
//   fixed = string
//   form = (qualified | unqualified)
//   id = ID
//   maxOccurs = (nonNegativeInteger | unbounded)  : 1
//   minOccurs = nonNegativeInteger : 1
//   name = NCName
//   nillable = boolean : false
//   ref = QName
//   substitutionGroup = QName
//   type = QName
//   {any attributes with non-schema namespace . . .}>
//   Content: (annotation?, ((simpleType | complexType)?, (unique | key | keyref)*))
// </element>
class XsdElement extends XsdBaseElement
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
     * block = (#all | List of (extension | restriction | substitution))
     * 
     * @var 
     */
    public $block = null;

    /**
     * Attribute
     * default = string
     * 
     * @var 
     */
    public $default = null;

    /**
     * Attribute
     * final = (#all | List of (extension | restriction))
     * 
     * @var 
     */
    public $final = null;

    /**
     * Attribute
     * fixed = string
     * 
     * @var 
     */
    public $fixed = null;

    /**
     * Attribute
     * form = (qualified | unqualified)
     * 
     * @var 
     */
    public $form = null;

    /**
     * Attribute
     * id = ID
     * 
     * @var 
     */
    public $id = null;

    /**
     * Attribute
     * maxOccurs = (nonNegativeInteger | unbounded)  : 1
     * 
     * @var 
     */
    public $maxOccurs = 1;

    /**
     * Attribute
     * minOccurs = nonNegativeInteger : 1
     * 
     * @var 
     */
    public $minOccurs = 1;

    /**
     * Attribute
     * name = NCName
     * 
     * @var 
     */
    public $name = null;

    /**
     * Attribute
     * nillable = boolean : false
     * 
     * @var 
     */
    public $nillable = false;

    /**
     * Attribute
     * ref = QName
     * 
     * @var 
     */
    public $ref = null;

    /**
     * Attribute
     * substitutionGroup = QName
     * 
     * @var 
     */
    public $substitutionGroup = null;

    /**
     * Attribute
     * type = QName
     * 
     * @var 
     */
    public $type = null;

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
        
        if ( $this->hasXmlAttribute('default') )
        {
            $this->default = $this->getXmlAttribute('default');
        }
        
        if ( $this->hasXmlAttribute('final') )
        {
            $this->final = $this->getXmlAttribute('final');
        }
        
        if ( $this->hasXmlAttribute('fixed') )
        {
            $this->fixed = $this->getXmlAttribute('fixed');
        }
        
        if ( $this->hasXmlAttribute('form') )
        {
            $this->form = $this->getXmlAttribute('form');
        }
        
        if ( $this->hasXmlAttribute('id') )
        {
            $this->id = $this->getXmlAttribute('id');
        }
        
        if ( $this->hasXmlAttribute('maxOccurs') )
        {
            $this->maxOccurs = $this->getXmlAttribute('maxOccurs');
        }
        
        if ( $this->hasXmlAttribute('minOccurs') )
        {
            $this->minOccurs = $this->getXmlAttribute('minOccurs');
        }
        
        if ( $this->hasXmlAttribute('name') )
        {
            $this->name = $this->getXmlAttribute('name');
        }
        
        if ( $this->hasXmlAttribute('nillable') )
        {
            $this->nillable = $this->getXmlAttribute('nillable');
        }
        
        if ( $this->hasXmlAttribute('ref') )
        {
            $this->ref = $this->getXmlAttribute('ref');
        }
        
        if ( $this->hasXmlAttribute('substitutionGroup') )
        {
            $this->substitutionGroup = $this->getXmlAttribute('substitutionGroup');
        }
        
        if ( $this->hasXmlAttribute('type') )
        {
            $this->type = $this->getXmlAttribute('type');
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
        $string .= CbUtil::$indent . "@default => ". var_export($this->default, true) ."\n";
        $string .= CbUtil::$indent . "@final => ". var_export($this->final, true) ."\n";
        $string .= CbUtil::$indent . "@fixed => ". var_export($this->fixed, true) ."\n";
        $string .= CbUtil::$indent . "@form => ". var_export($this->form, true) ."\n";
        $string .= CbUtil::$indent . "@id => ". var_export($this->id, true) ."\n";
        $string .= CbUtil::$indent . "@maxOccurs => ". var_export($this->maxOccurs, true) ."\n";
        $string .= CbUtil::$indent . "@minOccurs => ". var_export($this->minOccurs, true) ."\n";
        $string .= CbUtil::$indent . "@name => ". var_export($this->name, true) ."\n";
        $string .= CbUtil::$indent . "@nillable => ". var_export($this->nillable, true) ."\n";
        $string .= CbUtil::$indent . "@ref => ". var_export($this->ref, true) ."\n";
        $string .= CbUtil::$indent . "@substitutionGroup => ". var_export($this->substitutionGroup, true) ."\n";
        $string .= CbUtil::$indent . "@type => ". var_export($this->type, true) ."\n";
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
        if ( $this->hasComplexType() )
        {
            $string .= CbUtil::$indent ."complexType:";
            $string .= trim(CbUtil::indent((string) $this->getComplexType(), CbUtil::$indent . CbUtil::$indent)) ."\n";
        }
        if ( $this->hasUniques() )
        {
            $string .= CbUtil::$indent ."uniques(". count($this->getComponents("unique")) ."): Array (\n";
            foreach ($this->getUniques() as $i => $element)
            {
                $string .= CbUtil::$indent . CbUtil::$indent . $i ." => ";
                $string .= trim(CbUtil::indent((string) $element, CbUtil::$indent . CbUtil::$indent)) ."\n";
            }
            $string .= CbUtil::$indent .")\n";
        }
        if ( $this->hasKeies() )
        {
            $string .= CbUtil::$indent ."keies(". count($this->getComponents("key")) ."): Array (\n";
            foreach ($this->getKeies() as $i => $element)
            {
                $string .= CbUtil::$indent . CbUtil::$indent . $i ." => ";
                $string .= trim(CbUtil::indent((string) $element, CbUtil::$indent . CbUtil::$indent)) ."\n";
            }
            $string .= CbUtil::$indent .")\n";
        }
        if ( $this->hasKeyrefs() )
        {
            $string .= CbUtil::$indent ."keyrefs(". count($this->getComponents("keyref")) ."): Array (\n";
            foreach ($this->getKeyrefs() as $i => $element)
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

    /**
     * 
     * @return bool
     */
    public function hasComplexType()
    {
        return $this->hasComponents('complexType');
    }

    /**
     * 
     * @return XsdComplexType
     */
    public function getComplexType()
    {
        return $this->getComponents('complexType')[0];
    }

    /**
     * 
     * @return bool
     */
    public function hasUniques()
    {
        return $this->hasComponents('unique');
    }

    /**
     * 
     * @return XsdUnique[]
     */
    public function getUniques()
    {
        return $this->getComponents('unique');
    }

    /**
     * 
     * @return bool
     */
    public function hasKeies()
    {
        return $this->hasComponents('key');
    }

    /**
     * 
     * @return XsdKey[]
     */
    public function getKeies()
    {
        return $this->getComponents('key');
    }

    /**
     * 
     * @return bool
     */
    public function hasKeyrefs()
    {
        return $this->hasComponents('keyref');
    }

    /**
     * 
     * @return XsdKeyref[]
     */
    public function getKeyrefs()
    {
        return $this->getComponents('keyref');
    }
}

