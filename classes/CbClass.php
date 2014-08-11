<?php

class CbClass
{
    protected $comment = null;
    
    protected $documentation = null;
    
    /**
     * Признак абстрактности класса
     * 
     * @var bool
     */
    protected $isAbstract = null;
    
    /**
     * Родительский класс
     * 
     * @var mixed
     */
    protected $parent = null;
    
    /**
     * Пространство имён
     * 
     * @var string
     */
    protected $namespace = null;
    
    /**
     * Список свойств класса
     * 
     * @var CbProperty[]
     */
    protected $properties = [];
    
    /**
     * 
     * @var CbFunction[]
     */
    protected $functions = [];
    
    protected $name = null;

    public function __construct($name = null, $parent = null, $namespace = null)
    {
        if ( isset($name) )
            $this->setName($name);
        
        if ( isset($parent) )
            $this->setParent($parent);
        
        if ( isset($namespace) )
            $this->setNamespace($namespace);
    }
    
    public function setName($name)
    {
        $this->name = $name;
    }
    
    public function getName()
    {
        return $this->name;
    }
    
    public function getParent()
    {
        return $this->parent;
    }
    
    public function getParentForFunction()
    {
        if ( $this->parent instanceof CbClass )
            return $this->parent->getFullname();
        
        return $this->parent;
    }
    
    public function hasNamespace()
    {
        return (bool) $this->namespace;
    }
    
    public function getFullName()
    {
        if ( $this->hasNamespace() )
            return $this->getNamespace() .'/'. $this->getName();
        
        return $this->getName();
    }

    public function getNamespace()
    {
        return $this->namespace;
    }

    public function setParent($parent)
    {
        $this->parent = $parent;
    }

    public function setNamespace($namespace)
    {
        $this->namespace = $namespace;
    }
    
    /**
     * 
     * @return CbProperty
     */
    public function createProperty($name = null, $type = null)
    {
        $property = new CbProperty($this);
        $this->properties[] = $property;
        
        if ( isset($name) )
            $property->setName($name);
        
        if ( isset($type) )
            $property->setType($type);
        
        return $property;
    }
    
    /**
     * 
     * @return CbFunction
     */
    public function createFunction($name = null, $type = null)
    {
        $function = new CbFunction($this);
        $this->functions[] = $function;
        
        if ( isset($name) )
            $function->setName($name);
        
        if ( isset($type) )
            $function->setType($type);
        
        return $function;
    }
    
    public function setAbstract($abstract)
    {
        $this->isAbstract = (bool) $abstract;
    }
    
    public function isAbstract()
    {
        return (bool) $this->isAbstract;
    }
    
    public function addDocumentation($text)
    {
        $this->documentation .= $text ."\n";
    }
    
    public function getDocumentation()
    {
        return $this->documentation;
    }
    
    public function addComment($text)
    {
        $this->comment .= $text ."\n";
    }
    
    public function getComment()
    {
        return $this->comment;
    }
    
    public function createPropertyFunctions(CbProperty $property)
    {
        $propname = $property->getName();
        $ucname = ucfirst($propname);
        
        if ( $property->isArray() )
        {
            $hasFunction = $this->createFunction('has'. $ucname, 'bool');
            $hasFunction->addContent('return count($this->'. $propname .') > 0;');
            
            $getFunction = $this->createFunction('get'. $ucname, $property->getTypeForDoc());
            $getFunction->addContent('return $this->'. $propname .';');
            
            $addFunction = $this->createFunction('add'. $ucname);
            $addFunction->createArgument($propname, $property->getType());
            $addFunction->addContent('$this->'. $propname .'[] = $'. $propname .';');
        }
        else 
        {
            $setFunction = $this->createFunction('set'. $ucname);
            $setFunction->createArgument($propname, $property->getType());
            $setFunction->addContent('$this->'. $propname .' = $'. $propname .';');
            
            $getFunction = $this->createFunction('get'. $ucname, $property->getType());
            $getFunction->addContent('return $this->'. $propname .';');
        }
    }
    
    public function __toString()
    {
        $string = '';
        
        if ( $this->namespace )
        {
            $string .= "namespace ". $this->namespace .";\n\n";
        }
        
        if ( $this->comment )
        {
            $string .= CbUtil::indent(trim($this->comment), "// ") ."\n";
        }
        
        if ( $this->documentation )
        {
            $string .= "/**\n";
            $string .= CbUtil::indent($this->getDocumentation(), " * ") ."\n";
            $string .= " */\n";
        }
        
        if ( $this->isAbstract() )
            $string .= 'abstract ';
        
        $string .= "class {$this->name}";
        
        if ( isset($this->parent) )
        {
            $extends = $this->getParentForFunction();
            
            if ( $this->namespace )
                $extends = preg_replace('~\\\\?'. preg_quote($this->namespace) .'\\\\?~', '', $extends);
            
            $string .= ' extends '. $extends;
        }
        
        $string .= "\n{\n";
        
        foreach ( $this->properties as $property )
        {
            $string .= CbUtil::indent(trim((string) $property)) ."\n\n";
        }
        
        foreach ( $this->functions as $function )
        {
            $string .= CbUtil::indent(trim((string) $function)) ."\n\n";
        }
        
        $string = trim($string) . "\n";
        
        $string .= "}\n\n";
        
        return $string;
        
    }
}