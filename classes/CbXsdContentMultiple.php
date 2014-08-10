<?php

abstract class CbXsdContentMultiple extends CbXsdContentBaseElement
{
    protected $multiple = null;
    
    protected $arrayElements = ['*', '+'];
    
    public function getMultiple()
    {
        return $this->multiple;
    }

    public function setMultiple($multiple)
    {
        $this->multiple = $multiple;
    }
    
    public function isArray($parentMultiple = null)
    {
        if ( $parentMultiple != '' )
        {
            return in_array($parentMultiple, $this->arrayElements);
        }
        
        if ( $this->multiple != '' )
        {
            return in_array($this->multiple, $this->arrayElements);
        }
        
        return false;
    }
}