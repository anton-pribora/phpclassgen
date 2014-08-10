<?php


class CommandLineOption
{
    protected $shortName = null;
    
    protected $longName = null;
    
    protected $description = null;
    
    protected $hasValue = null;
    
    protected $requireValue = null;
    
    protected $value = null;
    
    public function hasValue()
    {
        return isset($this->value);
    }
    
    public function setValue($value)
    {
        $this->value = $value;
    }
    
    public function getValue()
    {
        return $this->value;
    }
    
    public function hasShortName()
    {
        return $this->shortName != '';
    }

    public function hasLongName()
    {
        return $this->longName != '';
    }

    public function hasDescription()
    {
        return $this->description != '';
    }
    
    public function getShortName()
    {
        return $this->shortName;
    }

    public function getLongName()
    {
        return $this->longName;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function isHasValue()
    {
        return (bool) $this->hasValue;
    }

    public function isRequireValue()
    {
        return (bool) $this->requireValue;
    }

    public function setShortName($shortName)
    {
        $this->shortName = $shortName;
    }

    public function setLongName($longName)
    {
        $this->longName = $longName;
    }

    public function setDescription($description)
    {
        $this->description = $description;
    }

    public function setHasValue($hasValue)
    {
        $this->hasValue = $hasValue;
    }

    public function setRequireValue($requireValue)
    {
        $this->requireValue = $requireValue;
    }
    
    public function getShortOpt()
    {
        $opt = $this->getShortName();
        
        if ( $this->isHasValue() )
        {
            $opt .= $this->isRequireValue() ? ':' : '::';
        }
        
        return $opt;
    }
    
    public function getLongOpt()
    {
        $opt = $this->getLongName();
        
        if ( $this->isHasValue() )
        {
            $opt .= $this->isRequireValue() ? ':' : '::';
        }
        
        return $opt;
    }
    
    public function getId()
    {
        return $this->shortName .';'. $this->longName;
    }
    
    public function __toString()
    {
        $string = "";
        
        $keyWords = [];
        
        if ( $this->hasShortName() )
        {
            $keyWords[] = '-'. $this->getShortName();
        }
        
        if ( $this->hasLongName() )
        {
            $keyWords[] = '--'. $this->getLongName();
        }
        
        $string .= join(', ', $keyWords);
        
        if ( $this->isHasValue() )
        {
            $string .= $this->isRequireValue() ? ' VALUE' : ' [VALUE]';
        }
        
        if ( $this->hasDescription() )
        {
            $string = sprintf('%-30s %s', $string, $this->getDescription());
        }
        
        if ( $this->hasValue() )
        {
            $string .= ' (текущее значение '. var_export($this->getValue(), true) .')';
        }
        
        return $string;
    }
}