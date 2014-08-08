<?php

class CbProperty extends CbClassItem
{
	protected $isArray = null;
	
	protected $default = 'null';
	
	protected $rightCommentDocumentation = null;
	
	public function getRightCommentDocumentation()
	{
		return $this->rightCommentDocumentation;
	}

	public function setRightCommentDocumentation($rightCommentDocumentation)
	{
		$this->rightCommentDocumentation = $rightCommentDocumentation;
	}

	public function getDefault()
	{
		return $this->default;
	}

	public function setDefault($default)
	{
		$this->default = $default;
	}

	public function setIsArray($newValue)
	{
		$this->isArray = (bool) $newValue;
	}
	
	public function getTypeForDoc()
	{
		if ( $this->isArray() )
			return parent::getTypeForDoc() .'[]';
		
		return parent::getTypeForDoc();
	}
	
	public function isArray()
	{
		return (bool) $this->isArray;
	}
	
	public function __toString()
	{
		$string = '';
		
		if ( $this->getDocumentation() || $this->getTypeForDoc() )
		{
			$string  = "/**\n";
			$string .= CbUtil::indent($this->getDocumentation(), " * ");
			$string .= "\n";
			$string .= " * @var ". $this->getTypeForDoc() ."\n";
			$string .= " */\n";
		}
		
		$string .= $this->getDeclaration() .' $'. $this->getName() ." = {$this->default};";
		
		if ( $this->rightCommentDocumentation )
		{
			$string .= '  // '. strtr(trim($this->rightCommentDocumentation), "\n", ' ');
		}
		
		$string .= "\n";
		
		return $string;
	}
}