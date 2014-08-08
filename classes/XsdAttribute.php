<?php
// <attribute
//   default = string
//   fixed = string
//   form = (qualified | unqualified)
//   id = ID
//   name = NCName
//   ref = QName
//   type = QName
//   use = (optional | prohibited | required) : optional
//   {any attributes with non-schema namespace . . .}>
//   Content: (annotation?, simpleType?)
// </attribute>
class XsdAttribute extends XsdBaseElement
{
    /**
     * Attribute
     * default = string
     * 
     * @var 
     */
    public $default = null;

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
     * Attribute
     * type = QName
     * 
     * @var 
     */
    public $type = null;

    /**
     * Attribute
     * use = (optional | prohibited | required) : optional
     * 
     * @var 
     */
    public $use = 'optional';

    /**
     * Some initialization
     * 
     */
    protected function initialize()
    {
        parent::initialize();
        
        if ( $this->hasXmlAttribute('default') )
        {
            $this->default = $this->getXmlAttribute('default');
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
        
        if ( $this->hasXmlAttribute('name') )
        {
            $this->name = $this->getXmlAttribute('name');
        }
        
        if ( $this->hasXmlAttribute('ref') )
        {
            $this->ref = $this->getXmlAttribute('ref');
        }
        
        if ( $this->hasXmlAttribute('type') )
        {
            $this->type = $this->getXmlAttribute('type');
        }
        
        if ( $this->hasXmlAttribute('use') )
        {
            $this->use = $this->getXmlAttribute('use');
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
        $string .= CbUtil::$indent . "@default => ". var_export($this->default, true) ."\n";
        $string .= CbUtil::$indent . "@fixed => ". var_export($this->fixed, true) ."\n";
        $string .= CbUtil::$indent . "@form => ". var_export($this->form, true) ."\n";
        $string .= CbUtil::$indent . "@id => ". var_export($this->id, true) ."\n";
        $string .= CbUtil::$indent . "@name => ". var_export($this->name, true) ."\n";
        $string .= CbUtil::$indent . "@ref => ". var_export($this->ref, true) ."\n";
        $string .= CbUtil::$indent . "@type => ". var_export($this->type, true) ."\n";
        $string .= CbUtil::$indent . "@use => ". var_export($this->use, true) ."\n";
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
}

