<?php
// <all
//   id = ID
//   maxOccurs = 1 : 1
//   minOccurs = (0 | 1) : 1
//   {any attributes with non-schema namespace . . .}>
//   Content: (annotation?, element*)
// </all>
class XsdAll extends XsdBaseElement
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
     * maxOccurs = 1 : 1
     * 
     * @var 
     */
    public $maxOccurs = 1;

    /**
     * Attribute
     * minOccurs = (0 | 1) : 1
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
}

