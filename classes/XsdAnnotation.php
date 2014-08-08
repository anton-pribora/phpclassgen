<?php
// <annotation
//   id = ID
//   {any attributes with non-schema namespace . . .}>
//   Content: (appinfo | documentation)*
// </annotation>
class XsdAnnotation extends XsdBaseElement
{
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
        $string .= CbUtil::$indent . "@id => ". var_export($this->id, true) ."\n";
        if ( $this->hasAppinfos() )
        {
            $string .= CbUtil::$indent ."appinfos(". count($this->getComponents("appinfo")) ."): Array (\n";
            foreach ($this->getAppinfos() as $i => $element)
            {
                $string .= CbUtil::$indent . CbUtil::$indent . $i ." => ";
                $string .= trim(CbUtil::indent((string) $element, CbUtil::$indent . CbUtil::$indent)) ."\n";
            }
            $string .= CbUtil::$indent .")\n";
        }
        if ( $this->hasDocumentations() )
        {
            $string .= CbUtil::$indent ."documentations(". count($this->getComponents("documentation")) ."): Array (\n";
            foreach ($this->getDocumentations() as $i => $element)
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
    public function hasAppinfos()
    {
        return $this->hasComponents('appinfo');
    }

    /**
     * 
     * @return XsdAppinfo[]
     */
    public function getAppinfos()
    {
        return $this->getComponents('appinfo');
    }

    /**
     * 
     * @return bool
     */
    public function hasDocumentations()
    {
        return $this->hasComponents('documentation');
    }

    /**
     * 
     * @return XsdDocumentation[]
     */
    public function getDocumentations()
    {
        return $this->getComponents('documentation');
    }
}

