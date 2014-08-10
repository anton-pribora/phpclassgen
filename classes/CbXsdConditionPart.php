<?php

class CbXsdConditionPart
{
    protected $name = null;
    
    protected $isArray = null;
    
    public function __construct($name, $isArray)
    {
        $this->name    = $name;
        $this->isArray = $isArray;
    }
    
    public function isArray()
    {
        return (bool) $this->isArray;
    }
    
    public function getName()
    {
        return $this->name;
    }
    
    public function __toString()
    {
        $string = '';
        
        if ( $this->isArray )
        {
            $string .= "if ( \$this->hasArray($this->name) )\n";
            $string .= "{\n";
            $string .= CbUtil::$indent ."\$this->setArray($this->name);\n";
            $string .= "}\n";
        }
        else
        {
            $string .= "if ( \$this->hasItem($this->name) )\n";
            $string .= "{\n";
            $string .= CbUtil::$indent ."\$this->setItem($this->name);\n";
            $string .= "}\n";
        }
        
        return $string;
    }
}