<?php

class CbXsdContent
{
    protected $content = null;
    
    protected $position = null;
    
    protected $length = null;
    
    protected $lastChar = null;
    
    public function __construct($content)
    {
        $this->content  = $content;
        $this->position = -1;
        $this->length   = mb_strlen($content);
    
        $this->next();
    }
    
    public function stripSpaces()
    {
        while ( $this->isSpaceChar() )
            $this->next();
    }
    
    public function isSpaceChar()
    {
        return in_array($this->lastChar, [' ', "\r", "\t"]);
    }
    
    public function isWordChar()
    {
        return preg_match('/\w/', $this->lastChar);
    }
    
    public function getWord()
    {
        $word = $this->char();
    
        while ( $this->next() !== false )
        {
            if ( $this->isWordChar() )
            {
                $word .= $this->char();
                continue;
            }
                
            break;
        }
    
        return $word;
    }
    
    public function char()
    {
        return $this->lastChar;
    }
    
    public function next()
    {
        $this->lastChar = mb_substr($this->content, ++$this->position, 1);
        return $this->char();
    }
    
    public function prev()
    {
        $this->lastChar = mb_substr($this->content, --$this->position, 1);
        return $this->char();
    }
    
    public function eof()
    {
        return $this->position >= $this->length;
    }
    
    public function getPosition()
    {
        return $this->position;
    }
}