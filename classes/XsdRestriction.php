<?php
// <restriction
//   base = QName
//   id = ID
//   {any attributes with non-schema namespace . . .}>
//   Content: (annotation?, (simpleType?, (minExclusive | minInclusive | maxExclusive | maxInclusive | totalDigits | fractionDigits | length | minLength | maxLength | enumeration | whiteSpace | pattern)*))
// </restriction>
class XsdRestriction extends XsdBaseElement
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
        if ( $this->hasSimpleType() )
        {
            $string .= CbUtil::$indent ."simpleType:";
            $string .= trim(CbUtil::indent((string) $this->getSimpleType(), CbUtil::$indent . CbUtil::$indent)) ."\n";
        }
        if ( $this->hasMinExclusives() )
        {
            $string .= CbUtil::$indent ."minExclusives(". count($this->getComponents("minExclusive")) ."): Array (\n";
            foreach ($this->getMinExclusives() as $i => $element)
            {
                $string .= CbUtil::$indent . CbUtil::$indent . $i ." => ";
                $string .= trim(CbUtil::indent((string) $element, CbUtil::$indent . CbUtil::$indent)) ."\n";
            }
            $string .= CbUtil::$indent .")\n";
        }
        if ( $this->hasMinInclusives() )
        {
            $string .= CbUtil::$indent ."minInclusives(". count($this->getComponents("minInclusive")) ."): Array (\n";
            foreach ($this->getMinInclusives() as $i => $element)
            {
                $string .= CbUtil::$indent . CbUtil::$indent . $i ." => ";
                $string .= trim(CbUtil::indent((string) $element, CbUtil::$indent . CbUtil::$indent)) ."\n";
            }
            $string .= CbUtil::$indent .")\n";
        }
        if ( $this->hasMaxExclusives() )
        {
            $string .= CbUtil::$indent ."maxExclusives(". count($this->getComponents("maxExclusive")) ."): Array (\n";
            foreach ($this->getMaxExclusives() as $i => $element)
            {
                $string .= CbUtil::$indent . CbUtil::$indent . $i ." => ";
                $string .= trim(CbUtil::indent((string) $element, CbUtil::$indent . CbUtil::$indent)) ."\n";
            }
            $string .= CbUtil::$indent .")\n";
        }
        if ( $this->hasMaxInclusives() )
        {
            $string .= CbUtil::$indent ."maxInclusives(". count($this->getComponents("maxInclusive")) ."): Array (\n";
            foreach ($this->getMaxInclusives() as $i => $element)
            {
                $string .= CbUtil::$indent . CbUtil::$indent . $i ." => ";
                $string .= trim(CbUtil::indent((string) $element, CbUtil::$indent . CbUtil::$indent)) ."\n";
            }
            $string .= CbUtil::$indent .")\n";
        }
        if ( $this->hasTotalDigits() )
        {
            $string .= CbUtil::$indent ."totalDigits(". count($this->getComponents("totalDigits")) ."): Array (\n";
            foreach ($this->getTotalDigits() as $i => $element)
            {
                $string .= CbUtil::$indent . CbUtil::$indent . $i ." => ";
                $string .= trim(CbUtil::indent((string) $element, CbUtil::$indent . CbUtil::$indent)) ."\n";
            }
            $string .= CbUtil::$indent .")\n";
        }
        if ( $this->hasFractionDigits() )
        {
            $string .= CbUtil::$indent ."fractionDigits(". count($this->getComponents("fractionDigits")) ."): Array (\n";
            foreach ($this->getFractionDigits() as $i => $element)
            {
                $string .= CbUtil::$indent . CbUtil::$indent . $i ." => ";
                $string .= trim(CbUtil::indent((string) $element, CbUtil::$indent . CbUtil::$indent)) ."\n";
            }
            $string .= CbUtil::$indent .")\n";
        }
        if ( $this->hasLengths() )
        {
            $string .= CbUtil::$indent ."lengths(". count($this->getComponents("length")) ."): Array (\n";
            foreach ($this->getLengths() as $i => $element)
            {
                $string .= CbUtil::$indent . CbUtil::$indent . $i ." => ";
                $string .= trim(CbUtil::indent((string) $element, CbUtil::$indent . CbUtil::$indent)) ."\n";
            }
            $string .= CbUtil::$indent .")\n";
        }
        if ( $this->hasMinLengths() )
        {
            $string .= CbUtil::$indent ."minLengths(". count($this->getComponents("minLength")) ."): Array (\n";
            foreach ($this->getMinLengths() as $i => $element)
            {
                $string .= CbUtil::$indent . CbUtil::$indent . $i ." => ";
                $string .= trim(CbUtil::indent((string) $element, CbUtil::$indent . CbUtil::$indent)) ."\n";
            }
            $string .= CbUtil::$indent .")\n";
        }
        if ( $this->hasMaxLengths() )
        {
            $string .= CbUtil::$indent ."maxLengths(". count($this->getComponents("maxLength")) ."): Array (\n";
            foreach ($this->getMaxLengths() as $i => $element)
            {
                $string .= CbUtil::$indent . CbUtil::$indent . $i ." => ";
                $string .= trim(CbUtil::indent((string) $element, CbUtil::$indent . CbUtil::$indent)) ."\n";
            }
            $string .= CbUtil::$indent .")\n";
        }
        if ( $this->hasEnumerations() )
        {
            $string .= CbUtil::$indent ."enumerations(". count($this->getComponents("enumeration")) ."): Array (\n";
            foreach ($this->getEnumerations() as $i => $element)
            {
                $string .= CbUtil::$indent . CbUtil::$indent . $i ." => ";
                $string .= trim(CbUtil::indent((string) $element, CbUtil::$indent . CbUtil::$indent)) ."\n";
            }
            $string .= CbUtil::$indent .")\n";
        }
        if ( $this->hasWhiteSpaces() )
        {
            $string .= CbUtil::$indent ."whiteSpaces(". count($this->getComponents("whiteSpace")) ."): Array (\n";
            foreach ($this->getWhiteSpaces() as $i => $element)
            {
                $string .= CbUtil::$indent . CbUtil::$indent . $i ." => ";
                $string .= trim(CbUtil::indent((string) $element, CbUtil::$indent . CbUtil::$indent)) ."\n";
            }
            $string .= CbUtil::$indent .")\n";
        }
        if ( $this->hasPatterns() )
        {
            $string .= CbUtil::$indent ."patterns(". count($this->getComponents("pattern")) ."): Array (\n";
            foreach ($this->getPatterns() as $i => $element)
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
    public function hasMinExclusives()
    {
        return $this->hasComponents('minExclusive');
    }

    /**
     * 
     * @return XsdMinExclusive[]
     */
    public function getMinExclusives()
    {
        return $this->getComponents('minExclusive');
    }

    /**
     * 
     * @return bool
     */
    public function hasMinInclusives()
    {
        return $this->hasComponents('minInclusive');
    }

    /**
     * 
     * @return XsdMinInclusive[]
     */
    public function getMinInclusives()
    {
        return $this->getComponents('minInclusive');
    }

    /**
     * 
     * @return bool
     */
    public function hasMaxExclusives()
    {
        return $this->hasComponents('maxExclusive');
    }

    /**
     * 
     * @return XsdMaxExclusive[]
     */
    public function getMaxExclusives()
    {
        return $this->getComponents('maxExclusive');
    }

    /**
     * 
     * @return bool
     */
    public function hasMaxInclusives()
    {
        return $this->hasComponents('maxInclusive');
    }

    /**
     * 
     * @return XsdMaxInclusive[]
     */
    public function getMaxInclusives()
    {
        return $this->getComponents('maxInclusive');
    }

    /**
     * 
     * @return bool
     */
    public function hasTotalDigits()
    {
        return $this->hasComponents('totalDigits');
    }

    /**
     * 
     * @return XsdTotalDigits[]
     */
    public function getTotalDigits()
    {
        return $this->getComponents('totalDigits');
    }

    /**
     * 
     * @return bool
     */
    public function hasFractionDigits()
    {
        return $this->hasComponents('fractionDigits');
    }

    /**
     * 
     * @return XsdFractionDigits[]
     */
    public function getFractionDigits()
    {
        return $this->getComponents('fractionDigits');
    }

    /**
     * 
     * @return bool
     */
    public function hasLengths()
    {
        return $this->hasComponents('length');
    }

    /**
     * 
     * @return XsdLength[]
     */
    public function getLengths()
    {
        return $this->getComponents('length');
    }

    /**
     * 
     * @return bool
     */
    public function hasMinLengths()
    {
        return $this->hasComponents('minLength');
    }

    /**
     * 
     * @return XsdMinLength[]
     */
    public function getMinLengths()
    {
        return $this->getComponents('minLength');
    }

    /**
     * 
     * @return bool
     */
    public function hasMaxLengths()
    {
        return $this->hasComponents('maxLength');
    }

    /**
     * 
     * @return XsdMaxLength[]
     */
    public function getMaxLengths()
    {
        return $this->getComponents('maxLength');
    }

    /**
     * 
     * @return bool
     */
    public function hasEnumerations()
    {
        return $this->hasComponents('enumeration');
    }

    /**
     * 
     * @return XsdEnumeration[]
     */
    public function getEnumerations()
    {
        return $this->getComponents('enumeration');
    }

    /**
     * 
     * @return bool
     */
    public function hasWhiteSpaces()
    {
        return $this->hasComponents('whiteSpace');
    }

    /**
     * 
     * @return XsdWhiteSpace[]
     */
    public function getWhiteSpaces()
    {
        return $this->getComponents('whiteSpace');
    }

    /**
     * 
     * @return bool
     */
    public function hasPatterns()
    {
        return $this->hasComponents('pattern');
    }

    /**
     * 
     * @return XsdPattern[]
     */
    public function getPatterns()
    {
        return $this->getComponents('pattern');
    }
}

