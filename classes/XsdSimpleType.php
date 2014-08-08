<?php
// <simpleType
//   final = (#all | List of (list | union | restriction))
//   id = ID
//   name = NCName
//   {any attributes with non-schema namespace . . .}>
//   Content: (annotation?, (restriction | list | union))
// </simpleType>
class XsdSimpleType extends XsdType
{
    /**
     * Attribute
     * final = (#all | List of (list | union | restriction))
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
        
        if ( $this->hasXmlAttribute('final') )
        {
            $this->final = $this->getXmlAttribute('final');
        }
        
        if ( $this->hasXmlAttribute('id') )
        {
            $this->id = $this->getXmlAttribute('id');
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
        $string .= CbUtil::$indent . "@final => ". var_export($this->final, true) ."\n";
        $string .= CbUtil::$indent . "@id => ". var_export($this->id, true) ."\n";
        $string .= CbUtil::$indent . "@name => ". var_export($this->name, true) ."\n";
        if ( $this->hasAnnotation() )
        {
            $string .= CbUtil::$indent ."annotation:";
            $string .= trim(CbUtil::indent((string) $this->getAnnotation(), CbUtil::$indent . CbUtil::$indent)) ."\n";
        }
        if ( $this->hasRestriction() )
        {
            $string .= CbUtil::$indent ."restriction:";
            $string .= trim(CbUtil::indent((string) $this->getRestriction(), CbUtil::$indent . CbUtil::$indent)) ."\n";
        }
        if ( $this->hasList() )
        {
            $string .= CbUtil::$indent ."list:";
            $string .= trim(CbUtil::indent((string) $this->getList(), CbUtil::$indent . CbUtil::$indent)) ."\n";
        }
        if ( $this->hasUnion() )
        {
            $string .= CbUtil::$indent ."union:";
            $string .= trim(CbUtil::indent((string) $this->getUnion(), CbUtil::$indent . CbUtil::$indent)) ."\n";
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
    public function hasRestriction()
    {
        return $this->hasComponents('restriction');
    }

    /**
     * 
     * @return XsdRestriction
     */
    public function getRestriction()
    {
        return $this->getComponents('restriction')[0];
    }

    /**
     * 
     * @return bool
     */
    public function hasList()
    {
        return $this->hasComponents('list');
    }

    /**
     * 
     * @return XsdList
     */
    public function getList()
    {
        return $this->getComponents('list')[0];
    }

    /**
     * 
     * @return bool
     */
    public function hasUnion()
    {
        return $this->hasComponents('union');
    }

    /**
     * 
     * @return XsdUnion
     */
    public function getUnion()
    {
        return $this->getComponents('union')[0];
    }
}

