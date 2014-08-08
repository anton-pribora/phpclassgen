<?php
// <appinfo
//   source = anyURI
//   {any attributes with non-schema namespace . . .}>
//   Content: ({any})*
// </appinfo>
class XsdAppinfo extends XsdBaseElement
{
    /**
     * Attribute
     * source = anyURI
     * 
     * @var 
     */
    public $source = null;

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
        return $string;
    }
}

