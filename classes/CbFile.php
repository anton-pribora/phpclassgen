<?php

class CbFile
{
	public static $pathBase = '';
	
	public static $pathExtension = '.php';
	
	protected $documentation = null;
	
	protected $comment = null;
	
	protected $content = null;
	
	protected $path = null;

	public function __construct($data = null)
	{
		if ( $data instanceof CbClass )
		{
			$this->createFromClass($data);
		}
		elseif ( is_string($data) )
		{
			$this->setContent($data);
		}
	}
	
	protected function createFromClass(CbClass $class)
	{
		$this->setContent((string) $class);
		$this->setPath( self::$pathBase . trim(strtr($class->getFullName(), '\\', '/'), '/') . self::$pathExtension );
	}
	
	public function getPath()
	{
		return $this->path;
	}

	public function setPath($path)
	{
		$this->path = $path;
	}
	
	public function getContent()
	{
		return $this->content;
	}

	public function setContent($content)
	{
		$this->content = $content;
	}
	
	public function addDocumentation($text)
	{
		$this->documentation .= $text ."\n";
	}
	
	public function addComment($text)
	{
		$this->comment .= $text ."\n";
	}
	
	public function __toString()
	{
		$string = "<?php\n";
		
		if ( $this->documentation )
		{
			$string .= "/**\n";
			$string .= CbUtil::indent(trim($this->documentation), ' * ') ."\n";
			$string .= " */\n";
		}
		
		if ( $this->comment )
		{
			$string .= CbUtil::indent(trim($this->comment), '// ') ."\n";
		}
		
		$string .= $this->content;
		
		return $string;
	}
}