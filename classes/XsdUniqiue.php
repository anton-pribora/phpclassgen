<?php
// @todo Доделать
// <unique
//   id = ID
//   name = NCName
//   {any attributes with non-schema namespace . . .}>
//   Content: (annotation?, (selector, field+))
// </unique>
class XsdUnique extends XsdBaseElement
{
	protected $annotation = null;
	
	protected $selector = null;
	
	protected $fields = [];
	
	protected function initialize()
	{
		parent::initialize();
		
		foreach ( ['annotation', 'selector'] as $component )
		{
			if ( $this->hasComponents($component) )
				$this->{$component} = $this->getComponents($component)[0];
		}
		
		if ( $this->hasComponents('field') )
			$this->fields = $this->getComponents('field');
	}
	
	public function hasAnnotation()
	{
		return isset($this->annotation);
	}
	
	public function getAnnotation()
	{
		return $this->annotation;
	}

	public function hasSelector()
	{
		return isset($this->selector);
	}
	
	public function getSelector()
	{
		return $this->selector;
	}
	
	public function hasFields()
	{
		return count($this->fields) > 0;
	}
	
	public function getFields()
	{
		return $this->fields;
	}
}