<?php

class CbUtil
{
    static $indent = "    ";
    
    /**
     * Indent multiline sting
     *
     * @param string $string
     * @param string $indent
     * @return $string
     */
    static function indent($string, $indent = null)
    {
        if ( !isset($indent) )
            $indent = static::$indent;
        
        return $indent . strtr($string, ["\n" => "\n". $indent]);
    }
}