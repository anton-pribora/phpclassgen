<?php

class CbXsdContentGroup extends CbXsdContentMultiple
{
    /**
     * 
     * @var CbXsdContentSequence
     */
    protected $sequence = null;
    
    public function parse(CbXsdContent $content)
    {
        if ( $content->char() == '(' )
            $content->next();
        
        $this->sequence = new CbXsdContentSequence();
        $this->sequence->parse($content);
        
        if ( $content->char() == ')' )
            $content->next();
    }
    
    public function getSequence()
    {
        return $this->sequence;
    }
}