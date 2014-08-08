<?php
// <documentation
//   source = anyURI
//   xml:lang = language
//   {any attributes with non-schema namespace . . .}>
//   Content: ({any})*
// </documentation>
class XsdDocumentation extends XsdBaseElement
{
    /**
     * Attribute
     * source = anyURI
     * 
     * @var 
     */
    public $source = null;

    /**
     * Attribute
     * xml:lang = language
     * 
     * @var 
     */
    public $lang = null;

    /**
     * Some initialization
     * 
     */
    protected function initialize()
    {
        parent::initialize();
        
        if ( $this->hasXmlAttribute('source') )
        {
            $this->source = $this->getXmlAttribute('source');
        }
        
        if ( $this->hasXmlAttribute('xml:lang') )
        {
            $this->lang = $this->getXmlAttribute('xml:lang');
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
        $string .= CbUtil::$indent . "@source => ". var_export($this->source, true) ."\n";
        $string .= CbUtil::$indent . "@lang => ". var_export($this->lang, true) ."\n";
        if ( $this->hasXmlTextContent() )
        {
            $string .= CbUtil::$indent ."~textContent => ". $this->getXmlTextContent() ."\n";
        }
        return $string;
    }
}

