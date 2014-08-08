<?php
// <group
//   id = ID
//   maxOccurs = (nonNegativeInteger | unbounded)  : 1
//   minOccurs = nonNegativeInteger : 1
//   name = NCName
//   ref = QName
//   {any attributes with non-schema namespace . . .}>
//   Content: (annotation?, (all | choice | sequence)?)
// </group>
class XsdGroup extends XsdBaseElement
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
     * Attribute
     * name = NCName
     * 
     * @var 
     */
    public $name = null;

    /**
     * Attribute
     * ref = QName
     * 
     * @var 
     */
    public $ref = null;

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
        
        if ( $this->hasXmlAttribute('name') )
        {
            $this->name = $this->getXmlAttribute('name');
        }
        
        if ( $this->hasXmlAttribute('ref') )
        {
            $this->ref = $this->getXmlAttribute('ref');
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
        $string .= CbUtil::$indent . "@name => ". var_export($this->name, true) ."\n";
        $string .= CbUtil::$indent . "@ref => ". var_export($this->ref, true) ."\n";
        if ( $this->hasAnnotation() )
        {
            $string .= CbUtil::$indent ."annotation:";
            $string .= trim(CbUtil::indent((string) $this->getAnnotation(), CbUtil::$indent . CbUtil::$indent)) ."\n";
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
}

