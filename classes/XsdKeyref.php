<?php
// <keyref
//   id = ID
//   name = NCName
//   refer = QName
//   {any attributes with non-schema namespace . . .}>
//   Content: (annotation?, (selector, field+))
// </keyref>
class XsdKeyref extends XsdBaseElement
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
     * refer = QName
     * 
     * @var 
     */
    public $refer = null;

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
        
        if ( $this->hasXmlAttribute('refer') )
        {
            $this->refer = $this->getXmlAttribute('refer');
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
        $string .= CbUtil::$indent . "@refer => ". var_export($this->refer, true) ."\n";
        if ( $this->hasAnnotation() )
        {
            $string .= CbUtil::$indent ."annotation:";
            $string .= trim(CbUtil::indent((string) $this->getAnnotation(), CbUtil::$indent . CbUtil::$indent)) ."\n";
        }
        if ( $this->hasSelector() )
        {
            $string .= CbUtil::$indent ."selector:";
            $string .= trim(CbUtil::indent((string) $this->getSelector(), CbUtil::$indent . CbUtil::$indent)) ."\n";
        }
        if ( $this->hasFields() )
        {
            $string .= CbUtil::$indent ."fields(". count($this->getComponents("field")) ."): Array (\n";
            foreach ($this->getFields() as $i => $element)
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
    public function hasSelector()
    {
        return $this->hasComponents('selector');
    }

    /**
     * 
     * @return XsdSelector
     */
    public function getSelector()
    {
        return $this->getComponents('selector')[0];
    }

    /**
     * 
     * @return bool
     */
    public function hasFields()
    {
        return $this->hasComponents('field');
    }

    /**
     * 
     * @return XsdField[]
     */
    public function getFields()
    {
        return $this->getComponents('field');
    }
}

