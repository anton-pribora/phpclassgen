<?php
// <choice
//   id = ID
//   maxOccurs = (nonNegativeInteger | unbounded)  : 1
//   minOccurs = nonNegativeInteger : 1
//   {any attributes with non-schema namespace . . .}>
//   Content: (annotation?, (element | group | choice | sequence | any)*)
// </choice>
class XsdChoice extends XsdBaseElement
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
        
        if ( $this->hasXmlAttribute('maxOccurs') )
        {
            $this->maxOccurs = $this->getXmlAttribute('maxOccurs');
        }
        
        if ( $this->hasXmlAttribute('minOccurs') )
        {
            $this->minOccurs = $this->getXmlAttribute('minOccurs');
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
        $string .= CbUtil::$indent . "@maxOccurs => ". var_export($this->maxOccurs, true) ."\n";
        $string .= CbUtil::$indent . "@minOccurs => ". var_export($this->minOccurs, true) ."\n";
        if ( $this->hasAnnotation() )
        {
            $string .= CbUtil::$indent ."annotation:";
            $string .= trim(CbUtil::indent((string) $this->getAnnotation(), CbUtil::$indent . CbUtil::$indent)) ."\n";
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
        if ( $this->hasChoices() )
        {
            $string .= CbUtil::$indent ."choices(". count($this->getComponents("choice")) ."): Array (\n";
            foreach ($this->getChoices() as $i => $element)
            {
                $string .= CbUtil::$indent . CbUtil::$indent . $i ." => ";
                $string .= trim(CbUtil::indent((string) $element, CbUtil::$indent . CbUtil::$indent)) ."\n";
            }
            $string .= CbUtil::$indent .")\n";
        }
        if ( $this->hasSequences() )
        {
            $string .= CbUtil::$indent ."sequences(". count($this->getComponents("sequence")) ."): Array (\n";
            foreach ($this->getSequences() as $i => $element)
            {
                $string .= CbUtil::$indent . CbUtil::$indent . $i ." => ";
                $string .= trim(CbUtil::indent((string) $element, CbUtil::$indent . CbUtil::$indent)) ."\n";
            }
            $string .= CbUtil::$indent .")\n";
        }
        if ( $this->hasAnies() )
        {
            $string .= CbUtil::$indent ."anies(". count($this->getComponents("any")) ."): Array (\n";
            foreach ($this->getAnies() as $i => $element)
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
    public function hasChoices()
    {
        return $this->hasComponents('choice');
    }

    /**
     * 
     * @return XsdChoice[]
     */
    public function getChoices()
    {
        return $this->getComponents('choice');
    }

    /**
     * 
     * @return bool
     */
    public function hasSequences()
    {
        return $this->hasComponents('sequence');
    }

    /**
     * 
     * @return XsdSequence[]
     */
    public function getSequences()
    {
        return $this->getComponents('sequence');
    }

    /**
     * 
     * @return bool
     */
    public function hasAnies()
    {
        return $this->hasComponents('any');
    }

    /**
     * 
     * @return XsdAny[]
     */
    public function getAnies()
    {
        return $this->getComponents('any');
    }
}

