<?php

class CbFunction extends CbClassItem
{
	/**
	 * 
	 * @var CbFunctionArgument[]
	 */
	protected $arguments = [];
	
	protected $content = '';
	
	/**
	 * 
	 * @return CbFunctionArgument
	 */
	public function createArgument($name = null, $type = null)
	{
		$argument = new CbFunctionArgument($this);
		$this->arguments[] = $argument;
		
		if ( isset($name) )
			$argument->setName($name);
		
		if ( isset($type) )
			$argument->setType($type);
		
		return $argument;
	}
	
	public function addContent($text)
	{
		$this->content .= $text . "\n";
	}
	
	public function __toString()
	{
		$string  = "/**\n";
		$string .= CbUtil::indent($this->getDocumentation(), " * ");
		$string .= "\n";
		
		$arguments = [];
		
		foreach ( $this->arguments as $argument )
		{
			$string .= " * @param ". $argument->getTypeForDoc() .' $'. $argument->getName() .' '. trim($argument->getDescription()) ."\n";
			$arguments[] = ($argument->getTypeForFunction() ? $argument->getTypeForFunction() .' ' : '') .'$'. $argument->getName();
		}
		
		if ( $this->getTypeForDoc() )
		{
			$string .= " * @return ". $this->getTypeForDoc() ."\n";
		}
		
		$string .= " */\n";
		
		$string .= $this->getDeclaration() .' function '. $this->getName() ."(". join(", ", $arguments) .")\n{\n";
		
		if ( $this->content )
		{
			$string .= CbUtil::indent(trim($this->content)) ."\n";
		}
		
		$string .= "}\n";
	
		return $string;
	}
}