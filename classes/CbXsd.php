<?php

class CbXsd
{
    protected $summary = null;
    
    protected $className = null;
    
    protected $parsedArttributes = [];
    
    protected $parsedContent = null;
    
    public function __construct($XmlRepresentationSummary, $className)
    {
        $this->summary   = $XmlRepresentationSummary;
        $this->className = $className;
        
        $this->parseAttributes();
        $this->parseContent();
    }
    
    protected function parseAttributes()
    {
        // Get attributes
        preg_match_all('/(?<attributes>\w\S+) = (?P<values>.*)/', $this->summary, $matches);
        
        foreach ( $matches['attributes'] as $i => $name )
        {
            $this->parsedArttributes[ $name ] = $matches[0][$i];
        }
    }
    
    protected function parseContent()
    {
        // Get content
        preg_match('/Content: (?P<content>.*)/', $this->summary, $matches);
        
        $this->parsedContent = $matches['content'];
    }
    
    protected function convertNameToNames($propertyName)
    {
        if ( preg_match('/(?<part>.*)y$/', $propertyName, $matches) )
            $propertyName = $matches['part'] .'ies';
        elseif ( preg_match('/digits$/i', $propertyName) )
            ;
        elseif ( preg_match('/s$/', $propertyName) )
            $propertyName .= 'es';
        else 
            $propertyName .= 's';
        
        return $propertyName;
    }
    
    protected function getXsdClassName($element)
    {
        return 'Xsd'. ucfirst($element);
    }
    
    protected function getAttributeDefault($definition)
    {
        if ( preg_match('/:\s+(?P<default>\w+)$/', $definition, $matches) )
        {
            $default = $matches['default'];
            
            if ( in_array($default, ['true', 'false']) )
                ;
            elseif ( is_numeric($default) )
                ;
            else 
                $default = var_export($default, true);
            
            return $default;
        }
        
        return null;
    }
    
    protected function stripXmlPrefix($name)
    {
        return preg_replace('/^.*:/', '', $name);
    }
    
    public function createClass()
    {
        $class = new CbClass($this->className);
        
        $initialize = $class->createFunction('initialize');
        $initialize->setDeclarationProtected();
        $initialize->addDocumentation('Some initialization');
        
        $initialize->addContent('parent::initialize();');
        $initialize->addContent('');
        
        $toString = $class->createFunction('__toString', 'string');
        $toString->setDeclarationPublic();
        
        $toString->addContent('$string  = "";');
// 		$toString->addContent('if ( isset($this->name) ) $string .= $this->name .":";');
        $toString->addContent('$string .= __CLASS__ ."\n";');
        
        foreach ( $this->parsedArttributes as $attribute => $definition )
        {
            $property = $class->createProperty($this->stripXmlPrefix($attribute));
            $default  = $this->getAttributeDefault($definition);
            
            if ( isset($default) )
                $property->setDefault($default);
        
            $property->addDocumentation('Attribute');
            $property->addDocumentation($definition);
            
            // Штрилиц крикрнул в тишину. Тишина не ответил.
            $toString->addContent('$string .= CbUtil::$indent . "@'. $property->getName() .' => ". var_export($this->'. $property->getName() .', true) ."\n";');
            
            // 	$construct->addContent('// Attribute '. $property->getName());
            $initialize->addContent('if ( $this->hasXmlAttribute(\''. $attribute .'\') )'. "\n{");
            $initialize->addContent(CbUtil::indent('$this->'. $property->getName() .' = $this->getXmlAttribute(\''. $attribute .'\');'));
            $initialize->addContent("}\n");
        }
        
        if ( $this->className == 'XsdDocumentation' )
        {
            $toString->addContent('if ( $this->hasXmlTextContent() )');
            $toString->addContent('{');
            $toString->addContent(CbUtil::$indent .'$string .= CbUtil::$indent ."~textContent => ". $this->getXmlTextContent() ."\n";');
            $toString->addContent('}');
        }
        
        $content  = new CbXsdContent($this->parsedContent);
        $sequence = new CbXsdContentSequence();
        $sequence->parse($content);
        
        $conditionBuilder = new CbXsdConditionBuilder();
        $conditions = $conditionBuilder->parseSequence($sequence);
        
        $componentNameExceptions = [
            'simpleContentExtension'    => 'extension',
            'simpleContentRestriction'  => 'restriction',
            'complexContentExtension'   => 'extension',
            'complexContentRestriction' => 'restriction',
        ];
        
        // Заполенение нужных свойств
        foreach ( $conditions as $condition )
        {
            /* @var $condition CbXsdCondition */
            foreach ( $condition->getParts() as $part )
            {
                /* @var $part CbXsdConditionPart */
                $partName = $part->getName();
                
                $componentName = $partName;
                $className     = $this->getXsdClassName($componentName);
                
                if ( isset($componentNameExceptions[ $partName ]) )
                {
                    $componentName = $componentNameExceptions[ $partName ];
                }
                
                if ( $part->isArray() )
                {
                    $name = $this->convertNameToNames($componentName);
                    
                    $hasFunction = $class->createFunction('has'. ucfirst($name), 'bool');
                    $hasFunction->addContent('return $this->hasComponents(\''. $componentName .'\');');
                    
                    $getFunction = $class->createFunction('get'. ucfirst($name), $className .'[]');
                    $getFunction->addContent('return $this->getComponents(\''. $componentName .'\');');
                    
                    $toString->addContent('if ( $this->'. $hasFunction->getName() .'() )');
                    $toString->addContent('{');
                    $toString->addContent(CbUtil::$indent .'$string .= CbUtil::$indent ."'. $name .'(". count($this->getComponents("'. $componentName .'")) ."): Array (\n";');
                    $toString->addContent(CbUtil::$indent .'foreach ($this->'. $getFunction->getName() .'() as $i => $element)');
                    $toString->addContent(CbUtil::$indent .'{');
                    $toString->addContent(CbUtil::$indent . CbUtil::$indent .'$string .= CbUtil::$indent . CbUtil::$indent . $i ." => ";');
                    $toString->addContent(CbUtil::$indent . CbUtil::$indent .'$string .= trim(CbUtil::indent((string) $element, CbUtil::$indent . CbUtil::$indent)) ."\n";');
                    $toString->addContent(CbUtil::$indent .'}');
                    $toString->addContent(CbUtil::$indent .'$string .= CbUtil::$indent .")\n";');
                    $toString->addContent('}');
                }
                else
                {
                    $name = $componentName;
                    
                    $hasFunction = $class->createFunction('has'. ucfirst($name), 'bool');
                    $hasFunction->addContent('return $this->hasComponents(\''. $componentName .'\');');
                    
                    $getFunction = $class->createFunction('get'. ucfirst($name), $className);
                    $getFunction->addContent('return $this->getComponents(\''. $componentName .'\')[0];');
                    
                    $toString->addContent('if ( $this->'. $hasFunction->getName() .'() )');
                    $toString->addContent('{');
                    $toString->addContent(CbUtil::$indent .'$string .= CbUtil::$indent ."'. $name .':";');
                    $toString->addContent(CbUtil::$indent .'$string .= trim(CbUtil::indent((string) $this->'. $getFunction->getName().'(), CbUtil::$indent . CbUtil::$indent)) ."\n";');
                    $toString->addContent('}');
                }
            }
        }
        
        $toString->addContent('return $string;');
        
        $class->addComment($this->summary);
        
        if ( in_array($class->getName(), ['XsdComplexType', 'XsdSimpleType']) )
        {
            $class->setParent('XsdType');
        }
        else 
        {
            $class->setParent('XsdBaseElement');
        }
        
        return $class;
    }
}