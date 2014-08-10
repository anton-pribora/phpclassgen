<?php

class CbXsdContentChoice extends CbXsdContentBaseElement
{
    protected $elements = [];
    
    public function addElement(CbXsdContentBaseElement $keyword)
    {
        $this->elements[] = $keyword;
    }
    
    public function getElements()
    {
        return $this->elements;
    }
}