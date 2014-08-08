<?php

class CbXsdContentSequence extends CbXsdContentMultiple
{
	protected $elements = [];
	
	public function getElements()
	{
		return $this->elements;
	}
	
	public function parse(CbXsdContent $content)
	{
		$lastElement = null;
		
		while ( !$content->eof() )
		{
			if ( !$this->elements )
			{
				$lastElement = $this->getNextElement($content);
				$this->elements[] = $lastElement;
			}
			elseif ( $content->char() == ',' )
			{
				// Новый элемент последовательности
				$content->next();
				$lastElement = $this->getNextElement($content);
				
				if ( $lastElement )
					$this->elements[] = $lastElement;
			}
			elseif ( $content->char() == '|' )
			{
				$content->next();
				
				// Выбор... аднака
				if ( ! $lastElement instanceof CbXsdContentChoice )
				{
					$lastElement = new CbXsdContentChoice();
					$lastElement->addElement( array_pop($this->elements) );
					$this->elements[] = $lastElement;
				}
				
				$subElement = $this->getNextElement($content);
				
				if ( $subElement )
					$lastElement->addElement($subElement);
			}
			elseif ( $content->char() == ')' )
			{
				break;
			}
			elseif ( !$content->isSpaceChar() )
			{
				// Что-то пошло не так
				throw new Exception("Invalid symbol '". $content->char());
			}
			else 
			{
				$content->next();
			}
		}
	}
}