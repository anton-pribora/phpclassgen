<?php

// @todo Дописать класс

// http://www.w3.org/TR/xmlschema-1/#element-complexContent..extension
// <extension
//   base = QName
//   id = ID
//   {any attributes with non-schema namespace . . .}>
//   Content: (annotation?, ((group | all | choice | sequence)?, ((attribute | attributeGroup)*, anyAttribute?)))
// </extension>

// http://www.w3.org/TR/xmlschema-1/#element-simpleContent..extension
// <extension
//   base = QName
//   id = ID
//   {any attributes with non-schema namespace . . .}>
//   Content: (annotation?, ((attribute | attributeGroup)*, anyAttribute?))
// </extension>

class XsdExtension extends XsdBaseElement
{
	public $id = null;
	public $base = null;
	
	/**
	 * 
	 * @var XsdAnnotation
	 */
	protected $annotation = null;
	
	/**
	 * 
	 * @var XsdGroup
	 */
	protected $group = null;

	/**
	 * 
	 * @var XsdAll
	 */
	protected $all = null;

	/**
	 * 
	 * @var XsdChoice
	 */
	protected $choice = null;

	/**
	 * 
	 * @var XsdSequence
	 */
	protected $sequence = null;
	
	/**
	 * 
	 * @var XsdAttribute[]
	 */
	protected $attributes = [];

	/**
	 * 
	 * @var XsdAttributeGroup[]
	 */
	protected $attributeGroups = [];
	
	/**
	 * 
	 * @var XsdAnyAttribute
	 */
	protected $anyAttribute = null;
	
	protected function initialize()
	{
		parent::initialize();
		
		foreach ( ['id', 'base'] as $attribute )
		{
			if ( $this->hasXmlAttribute($attribute) )
				$this->{$attribute} = $this->getXmlAttribute($attribute);
		}
		
		foreach ( ['annotation', 'group', 'all', 'choice', 'sequence'] as $component )
		{
			if ( $this->hasComponents($component) )
				$this->{$component} = $this->getComponents($component)[0];
		}
		
		if ( $this->hasComponents('attribute') )
			$this->attributes = $this->getComponents('attribute');

		if ( $this->hasComponents('attributeGroup') )
			$this->attributeGroups = $this->getComponents('attributeGroup');
	}
	
	public function hasAnnotation()
	{
		return isset($this->annotation);
	}
	
	/**
	 * 
	 * @return XsdAnnotation
	 */
	public function getAnnotation()
	{
		return $this->annotation;
	}

	public function hasGroup()
	{
		return isset($this->group);
	}
	
	/**
	 * 
	 * @return XsdGroup
	 */
	public function getGroup()
	{
		return $this->group;
	}

	public function hasAll()
	{
		return isset($this->all);
	}
	
	/**
	 * 
	 * @return XsdAll
	 */
	public function getAll()
	{
		return $this->all;
	}

	public function hasChoice()
	{
		return isset($this->choice);
	}
	
	/**
	 * 
	 * @return XsdChoice
	 */
	public function getChoice()
	{
		return $this->choice;
	}

	public function hasSequence()
	{
		return isset($this->sequence);
	}
	
	/**
	 * 
	 * @return XsdSequence
	 */
	public function getSequence()
	{
		return $this->sequence;
	}

	public function hasAttributes()
	{
		return count($this->attributes) > 0;
	}
	
	/**
	 * 
	 * @return XsdAttribute[]
	 */
	public function getAttributes()
	{
		return $this->attributes;
	}

	public function hasAttributeGroups()
	{
		return count($this->attributeGroups) > 0;
	}
	
	/**
	 * 
	 * @return XsdAttributeGroup[]
	 */
	public function getAttributeGroups()
	{
		return $this->attributeGroups;
	}

	public function hasAnyAttribute()
	{
		return isset($this->anyAttribute);
	}
	
	/**
	 * 
	 * @return XsdAnyAttribute
	 */
	public function getAnyAttribute()
	{
		return $this->anyAttribute;
	}
}