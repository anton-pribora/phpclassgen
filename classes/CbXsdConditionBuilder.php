<?php

class CbXsdConditionBuilder
{
    /**
     * 
     * @param CbXsdContentSequence $sequence
     * @param bool $isArray
     * @return CbXsdCondition[]
     */
    public function parseSequence(CbXsdContentSequence $sequence, $isArray = null)
    {
        $conditions = [];
        
        foreach ( $sequence->getElements() as $element )
        {
            if ( $element instanceof CbXsdContentKeyWord )
            {
                // Оно самое
                $part = new CbXsdConditionPart($element->getName(), $isArray ?: $element->isArray());
                $conditions[] = new CbXsdCondition($part);
            }
            elseif ( $element instanceof CbXsdContentGroup )
            {
                // Группа элементов
                $conditions = array_merge($conditions, $this->parseSequence($element->getSequence(), $isArray ?: $element->isArray()));
            }
            elseif ( $element instanceof CbXsdContentChoice )
            {
                $condition = new CbXsdCondition();
                
                // Я люблю конечно всех, но кого-то больше всех...
                foreach ( $element->getElements() as $subElement )
                {
                    if ( $subElement instanceof CbXsdContentGroup )
                    {
                        // Это элсе
                        // А что делать если элсов больше чем один??? Их орда, да и нас рать
                        $conditions = array_merge($conditions, $this->parseSequence($subElement->getSequence(), $isArray ?: $subElement->isArray()));
                    }
                    elseif ( $subElement instanceof CbXsdContentKeyWord )
                    {
                        // Это часть условия
                        $part = new CbXsdConditionPart($subElement->getName(), $isArray ?: $subElement->isArray());
                        
                        if ( $part->isArray() )
                        {
	                        $conditions[] = new CbXsdCondition($part);
                        }
                        else 
                        {
	                        $condition->addPart($part);
                        }
                    }
                    else 
                    {
                        // Мир сошёл с ума
                    }
                }
                
                if ( $condition->hasParts() )
                {
                    $conditions[] = $condition;
                }
            }
        }
        
        return $conditions;
    }
}