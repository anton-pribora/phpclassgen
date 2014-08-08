<?php

class CbXsdCondition
{
	protected $parts = null;
	
	public function __construct($parts = null)
	{
		if ( is_array($parts) )
		{
			foreach ( $parts as $part )
			{
				$this->addPart($part);
			}
		}
		elseif ( isset($parts) )
		{
			$this->addPart($parts);
		}
	}
	
	public function getIsArray()
	{
		return (bool) $this->isArray;
	}

	public function addPart(CbXsdConditionPart $part)
	{
		$this->parts[] = $part;
	}
	
	public function getParts()
	{
		return $this->parts;
	}
	
	public function hasParts()
	{
		return count($this->parts) > 0;
	}
	
	public function __toString()
	{
		$string = '';
		
		if ( $this->parts )
		{
			$parts = [];
			
			foreach ( $this->parts as $part )
			{
				$parts[] = (string) $part;
			}
			
			$string .= join('else', $parts);
		}
		
		return $string;
	}
}