<?php

abstract class CbXsdContentBaseElement
{
    public function parse(CbXsdContent $content)
    {
    }
    
    protected function getNextElement(CbXsdContent $content)
    {
        $element = null;
        
        while ( !$content->eof() )
        {
            if ( $content->char() == '(' )
            {
                // Группа
                $element = new CbXsdContentGroup();
                $element->parse($content);
            }
            elseif ( $content->isWordChar() )
            {
                // Keyword
                $element = new CbXsdContentKeyWord();
                $element->parse($content);
            }
            elseif ( $content->char() == '{' )
            {
                while ( !$content->eof() )
                {
                    if ( $content->next() == '}' )
                    {
                        $content->next();
                        break;
                    }
                }
            }
            elseif ( in_array($content->char(), ['?', '+', '*']) )
            {
                if ( $element instanceof CbXsdContentMultiple )
                {
                    $element->setMultiple($content->char());
                }
                else 
                {
                    // Ошибка парсинга...
                }
                
                $content->next();
            }
            elseif ( in_array($content->char(), [',', '|', ')', '}']) )
            {
                break;
            }
            elseif ( !$content->isSpaceChar() )
            {
                // Боги.. инвалид симбол
                echo "Invalid symbol '". $content->char() ."'\n";
                break;
            }
            else 
            {
                // Всё в порядке, идём дальше
                $content->next();
            }
        }
        
        return $element;
    }
}