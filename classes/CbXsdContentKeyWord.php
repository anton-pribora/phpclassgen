<?php

class CbXsdContentKeyWord extends CbXsdContentMultiple
{
    protected $name = null;
    
    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;
    }
    
    public function parse(CbXsdContent $content)
    {
        while ( !$content->eof() )
        {
            if ( $content->isWordChar() )
            {
                $this->name .= $content->char();
                $content->next();
            }
            else 
            {
                break;
            }
        }
    }
}