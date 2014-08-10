<?php

abstract class CbClassItem
{
    protected $documentation = null;
    
    protected $name = null;
    
    protected $declaration = 'public';
    
    protected $type = null;
    
    /**
     *
     * @var CbClass
     */
    protected $class = null;
    
    public function __construct(CbClass $class)
    {
        $this->class = $class;
    }
    
    public function setName($name)
    {
        $this->name = $name;
    }
    
    public function getName()
    {
        return $this->name;
    }
    
    public function setDeclaration($declaration)
    {
        $this->declaration = $declaration;
    }
    
    public function setDeclarationPrivate()
    {
        $this->setDeclaration('private');
    }
    
    public function setDeclarationProtected()
    {
        $this->setDeclaration('protected');
    }
    
    public function setDeclarationPublic()
    {
        $this->setDeclaration('public');
    }
    
    public function getDeclaration()
    {
        return $this->declaration;
    }
    
    public function setType($type)
    {
        $this->type = $type;
    }
    
    public function getType()
    {
        return $this->type;
    }
    
    public function getTypeForDoc()
    {
        if ( $this->type instanceof CbClass )
        {
            return $this->type->getName();
        }
        
        return $this->getType();
    }
    
    public function addDocumentation($text)
    {
        $this->documentation .= $text ."\n";
    }
    
    public function getDocumentation()
    {
        return $this->documentation;
    }
}