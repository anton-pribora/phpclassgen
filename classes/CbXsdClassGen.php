<?php

class CbXsdClassGen
{
    /**
     * 
     * @var CbClass
     */
    protected $class = null;
    
    protected $namespaces = [];

    public function getNamespaces()
    {
        return $this->namespaces;
    }

    public function setNamespaces($namespaces)
    {
        $this->namespaces = $namespaces;
    }
    
    public function hasNamespace($namespace)
    {
        return isset($this->namespaces[ $namespace ]);
    }
    
    public function getPhpNamespace($targetNamespace)
    {
        return $this->namespaces[ $targetNamespace ];
    }
    
    public function registerNamespace($targetNamespace, $phpNamespace)
    {
        $this->namespaces[ $targetNamespace ] = $phpNamespace;
    }
    
    public function getPhpClassName($targetNamespace, $name)
    {
        if ( $this->hasNamespace($targetNamespace) )
        {
            $class = '\\'. $this->getPhpNamespace($targetNamespace) .'\\'. $name;
        }
        else
        {
            $class = $name;
        }
        
        return $class;
    }

    public function createClass(XsdComplexType $complexType)
    {
        $this->class = new CbClass();
        
        if ( $this->hasNamespace($complexType->getTargetNamespace()) )
        {
            $this->class->setNamespace( $this->getPhpNamespace( $complexType->getTargetNamespace() )  );
        }
        
        $this->applyComplexType($complexType);
        
        return $this->class;
    }
    
    protected function applyComplexType(XsdComplexType $complexType)
    {
        // <complexType
        //   abstract = boolean : false
        //   block = (#all | List of (extension | restriction))
        //   final = (#all | List of (extension | restriction))
        //   id = ID
        //   mixed = boolean : false
        //   name = NCName
        //   {any attributes with non-schema namespace . . .}>
        //   Content: (annotation?, (simpleContent | complexContent | ((group | all | choice | sequence)?, ((attribute | attributeGroup)*, anyAttribute?))))
        // </complexType>
        
        if ( $complexType->abstract === true || $complexType->abstract === 'true' )
            $this->class->setAbstract(true);
        
        if ( $complexType->name )
            $this->class->setName($complexType->name);
        
        // Документация к классу
        if ( $complexType->hasAnnotation() )
        {
            foreach ( $complexType->getAnnotation()->getDocumentations() as $documentation )
            {
                $this->class->addDocumentation($documentation->getXmlTextContent());
            }
        }
        
        if ( $complexType->hasSimpleContent() )
        {
            // Тип имеет простое содержимое
            // Анонимный простой тип
            // В принципе можно от души забить на него
            $this->applySimpleContent($complexType->getSimpleContent());
        }
        elseif ( $complexType->hasComplexContent() )
        {
            // Тип имеет сложное содержимое
            $this->applyComplexContent($complexType->getComplexContent());
        }
        else 
        {
            if ( $complexType->hasGroup() )
            {
                // Есть группа элементов
                $this->applyGroup($complexType->getGroup());
                
            }
            elseif ( $complexType->hasAll() ) 
            {
                // Есть всё... зачем оно???
                $this->applyAll($complexType->getAll());
            }
            elseif ( $complexType->hasChoice() )
            {
                // Нам дали выбор... уже неплохо
                $this->applyChoice($complexType->getChoice());
            }
            elseif ( $complexType->hasSequence() )
            {
                // У нас есть последовательность, это хорошо
                $this->applySequence($complexType->getSequence());
            }
            
            // Аттрибутики
            $this->applyAttributes($complexType->getAttributes());
            $this->applyAttributeGroups($complexType->getAttributeGroups());
            
            if ( $complexType->hasAnyAttribute() )
            {
                // Таинственный аникей
                $this->applyAnyAttribute($complexType->getAnyAttribute());
            }
        }
    }
    
    protected function applyComplexContent(XsdComplexContent $complexContent)
    {
        // Content: (annotation?, (restriction | extension))
        if ( $complexContent->hasRestriction() )
        {
            // Какое-то ограничение
            $this->applyComplexContentRestriction($complexContent->getRestriction());
        }
        elseif ( $complexContent->hasExtension() )
        {
            // Расширение... мать его
            $this->applyComplexContentExtension($complexContent->getExtension());
        }
        else 
        {
            // Вау.. пустой контент... непорядок
            // @todo Нужно бросить чем-нить тяжелым в создателя WSDL
            throw new WsdlParserException('Вау.. пустой контент... непорядок');
        }
    }
    
    protected function applyComplexContentRestriction(XsdComplexContentRestriction $restriction)
    {
        // <restriction
        //   base = QName
        //   id = ID
        //   {any attributes with non-schema namespace . . .}>
        //   Content: (annotation?, (group | all | choice | sequence)?, ((attribute | attributeGroup)*, anyAttribute?))
        // </restriction>
        
        // Нет слов... Хз что тут делать
        
        // Базовый тип, чтоб его
        $baseType    = $restriction->findType($restriction->base);
        $parentClass = $this->builder->createClassFromType($baseType);
        
        $this->prototype = $parentClass->getFullClassName();
        
        if ( $restriction->hasGroup() )
        {
            // Группа мать его 
            $this->applyGroup($restriction->getGroup());
        }
        elseif ( $restriction->hasAll() )
        {
            // Май ол
            $this->applyAll($restriction->getAll());
        }
        elseif ( $restriction->hasSequence() )
        {
            // Секвенция
            $this->applySequence($restriction->getSequence());
        }
        
        // Аттрибуты
        $this->applyAttributes($restriction->getAttributes());
        
        // Группы аттрибутов
        $this->applyAttributeGroups($restriction->getAttributeGroups());
        
        if ( $restriction->hasAnyAttribute() )
        {
            $this->applyAnyAttribute($restriction->getAnyAttribute());
        }
    }
    
    protected function applyComplexContentExtension(XsdComplexContentExtension $extension)
    {
        // <extension
        //   base = QName
        //   id = ID
        //   {any attributes with non-schema namespace . . .}>
        //   Content: (annotation?, ((group | all | choice | sequence)?, ((attribute | attributeGroup)*, anyAttribute?)))
        // </extension>
        
        // Базовый тип, чтоб его
        $baseType = $extension->parseType($extension->base);
        $this->class->setParent($this->getPhpClassName($baseType->getNamespaceUri(), $baseType->getName()));
        
        if ( $extension->hasGroup() )
        {
            // Группа мать его 
            $this->applyGroup($extension->getGroup());
        }
        elseif ( $extension->hasAll() )
        {
            // Май ол
            $this->applyAll($extension->getAll());
        }
        elseif ( $extension->hasSequence() )
        {
            // Секвенция
            $this->applySequence($extension->getSequence());
        }
        
        // Аттрибуты
        $this->applyAttributes($extension->getAttributes());
        
        // Группы аттрибутов
        $this->applyAttributeGroups($extension->getAttributeGroups());
        
        if ( $extension->hasAnyAttribute() )
        {
            $this->applyAnyAttribute($extension->getAnyAttribute());
        }
    }
    
    protected function applySimpleContent(XsdSimpleContent $simpleContent)
    {
        // <simpleContent
        //   id = ID
        //   {any attributes with non-schema namespace . . .}>
        //   Content: (annotation?, (restriction | extension))
        // </simpleContent>
        
        if ( $simpleContent->hasExtension() )
        {
            // Расширение... мать его
            $this->applySimpleContentExtension($simpleContent->getExtension());
        }
        elseif ( $simpleContent->hasRestriction() )
        {
            // Какое-то ограничение
            $this->applySimpleContentRestriction($simpleContent->getRestriction());
        }
        else 
        {
            // Вау.. пустой контент... непорядок
            // @todo Нужно бросить чем-нить тяжелым в создателя WSDL
            throw new WsdlParserException('Нужно бросить чем-нить тяжелым в создателя WSDL');
        }
    }
    
    protected function applySimpleContentExtension(XsdSimpleContentExtension $extension)
    {
        // <extension
        //   base = QName
        //   id = ID
        //   {any attributes with non-schema namespace . . .}>
        //   Content: (annotation?, ((attribute | attributeGroup)*, anyAttribute?))
        // </extension>
        
        // Раширение...
        
        $this->applyAttributes($extension->getAttributes());
        $this->applyAttributeGroups($extension->getAttributeGroups());
        
        if ( $extension->hasAnyAttribute() )
        {
            $this->applyAnyAttribute($extension->getAnyAttribute());
        }
    }
    
    protected function applySimpleContentRestriction(XsdSimpleContentRestriction $restriction)
    {
        // <restriction
        //   base = QName
        //   id = ID
        //   {any attributes with non-schema namespace . . .}>
        //   Content: (annotation?, (simpleType?, (minExclusive | minInclusive | maxExclusive | maxInclusive | 
        //               totalDigits | fractionDigits | length | minLength | maxLength | enumeration | whiteSpace | 
        //               pattern)*)?, ((attribute | attributeGroup)*, anyAttribute?))
        // </restriction>
        
        // Ещё один гемморой на нашу голову...
    }
    
    /**
     * 
     * @param XsdSequence[] $sequences
     */
    protected function applySequences($sequences)
    {
        foreach ( $sequences as $sequence )
        {
            $this->applySequence($sequence);
        }
    }
    
    protected function applySequence(XsdSequence $sequence)
    {
        // <sequence
        //   id = ID
        //   maxOccurs = (nonNegativeInteger | unbounded)  : 1
        //   minOccurs = nonNegativeInteger : 1
        //   {any attributes with non-schema namespace . . .}>
        //   Content: (annotation?, (element | group | choice | sequence | any)*)
        // </sequence>
        
        if ( $sequence->maxOccurs > 1 )
        {
            // Что-то надо думать...
        }
        
        $this->applyElements($sequence->getElements());
        $this->applyGroups($sequence->getGroups());
        $this->applyChoices($sequence->getChoices());
        $this->applySequences($sequence->getSequences());
        $this->applyAnies($sequence->getAnies());
    }
    
    protected function applyAll(XsdAll $all)
    {
        // Content: (annotation?, element*)
        $this->applyElements($all->getElements());
    }
    
    protected function applyAnyAttribute(XsdAnyAttribute $anyAttribute)
    {
        // <anyAttribute
        //   id = ID
        //   namespace = ((##any | ##other) | List of (anyURI | (##targetNamespace | ##local)) )  : ##any
        //   processContents = (lax | skip | strict) : strict
        //   {any attributes with non-schema namespace . . .}>
        //   Content: (annotation?)
        // </anyAttribute>
        
        // Блин, а это ещё что за ересь????
    }
    
    /**
     * 
     * @param XsdAny[] $anies
     */
    protected function applyAnies($anies)
    {
        foreach ( $anies as $any )
        {
            $this->applyAny($any);
        }
    }
    
    protected function applyAny(XsdAny $any)
    {
        // <any
        //   id = ID
        //   maxOccurs = (nonNegativeInteger | unbounded)  : 1
        //   minOccurs = nonNegativeInteger : 1
        //   namespace = ((##any | ##other) | List of (anyURI | (##targetNamespace | ##local)) )  : ##any
        //   processContents = (lax | skip | strict) : strict
        //   {any attributes with non-schema namespace . . .}>
        //   Content: (annotation?)
        // </any>
        
        // Что-то стращное
    }
    
    /**
     * 
     * @param XsdChoice[] $choices
     */
    protected function applyChoices($choices)
    {
        foreach ( $choices as $choice )
        {
            $this->applyChoice($choice);
        }
    }
    
    protected function applyChoice(XsdChoice $choice)
    {
        // <choice
        //   id = ID
        //   maxOccurs = (nonNegativeInteger | unbounded)  : 1
        //   minOccurs = nonNegativeInteger : 1
        //   {any attributes with non-schema namespace . . .}>
        //   Content: (annotation?, (element | group | choice | sequence | any)*)
        // </choice>
        
        $this->applyElements($choice->getElements());
        $this->applyGroups($choice->getGroups());
        $this->applySequences($choice->getSequences());
        $this->applyAnies($choice->getAnies());
    }
    
    protected function applyGroups($groups)
    {
        foreach ( $groups as $group )
        {
            $this->applyGroups($groups);
        }
    }
    
    protected function applyGroup(XsdGroup $group)
    {
        // The XML representation for a model group definition schema component is a <group> element information item. 
        // It provides for naming a model group for use by reference in the XML representation of complex type 
        // definitions and model groups. The correspondences between the properties of the information item and 
        // properties of the component it corresponds to are as follows:
        
        // <group
        //   id = ID
        //   maxOccurs = (nonNegativeInteger | unbounded)  : 1
        //   minOccurs = nonNegativeInteger : 1
        //   name = NCName
        //   ref = QName
        //   {any attributes with non-schema namespace . . .}>
        //   Content: (annotation?, (all | choice | sequence)?)
        // </group>
        
        // Мать вашу, какому идиоту понадобилось использовать группы???
        throw new Exception('Мать вашу, какому идиоту понадобилось использовать группы???');
    }
    
    /**
     * 
     * @param XsdElement[] $elements
     */
    protected function applyElements($elements)
    {
        foreach ( $elements as $element )
        {
            $this->applyElement($element);
        }
    }
    
    protected function applyElement(XsdElement $element)
    {
        // <element
        //   abstract = boolean : false
        //   block = (#all | List of (extension | restriction | substitution))
        //   default = string
        //   final = (#all | List of (extension | restriction))
        //   fixed = string
        //   form = (qualified | unqualified)
        //   id = ID
        //   maxOccurs = (nonNegativeInteger | unbounded)  : 1
        //   minOccurs = nonNegativeInteger : 1
        //   name = NCName
        //   nillable = boolean : false
        //   ref = QName
        //   substitutionGroup = QName
        //   type = QName
        //   {any attributes with non-schema namespace . . .}>
        //   Content: (annotation?, ((simpleType | complexType)?, (unique | key | keyref)*))
        // </element>
        
        // Чё делать будем??
        
        $property = $this->createProperty($element->name);
        
        if ( $element->hasAnnotation() )
        {
            foreach ( $element->getAnnotation()->getDocumentations() as $documentation )
            {
                $property->addDocumentation($documentation->getXmlTextContent());
            }
        }
        
        if ( $element->maxOccurs > 1 || $element->maxOccurs == 'unbounded' )
        {
            $property->setIsArray(true);
            $property->setDefault('[]');
        }
        
        $property->addDocumentation('Type: '. $element->type);
        $type = $element->findType($element->type);
        
        if ( $type instanceof XsdSimpleType )
        {
            if ( in_array( $type->getName(), ['float', 'bool', 'boolean', 'int', 'string', 'date', 'datetime'] ) )
                $property->setType( $type->getName() );
            else 
                $property->setType('string');
        }
        elseif ( $type instanceof XsdComplexType )
        {
            $property->setType( $this->getPhpClassName($type->getTargetNamespace(), $type->getName()) );
        }
        
        $this->class->createPropertyFunctions($property);
        
        if ( $element->hasSimpleType() )
        {
             // ...
             throw new Exception('ну не умею я обращаться с простыми анонимными типами');
        }
        elseif ( $element->hasComplexType() )
        {
            // ...
            throw new Exception('Да не умею я обращаться с комплексными анонимными типами!'); 
        }
    }
    
    /**
     * 
     * @param XsdAttributeGroup $attributeGroups
     */
    protected function applyAttributeGroups($attributeGroups)
    {
        foreach ( $attributeGroups as $attributeGroup )
        {
            $this->applyAttributeGroup($attributeGroup);
        }
    }
    
    protected function applyAttributeGroup(XsdAttributeGroup $attributeGroup)
    {
        // <attributeGroup
        //   id = ID
        //   name = NCName
        //   ref = QName
        //   {any attributes with non-schema namespace . . .}>
        //   Content: (annotation?, ((attribute | attributeGroup)*, anyAttribute?))
        // </attributeGroup>
        
        $this->applyAttributes($attributeGroup->getAttributes());
        $this->applyAttributeGroups($attributeGroup->getAttributeGroups());
        
        if ( $attributeGroup->hasAnyAttribute() )
        {
            $this->applyAnyAttribute($attributeGroup->getAnyAttribute());
        }
    }
    
    /**
     * 
     * @param XsdAttribute[] $attributes
     */
    protected function applyAttributes($attributes)
    {
        // Есть какие-то аттрибуты
        foreach ( $attributes as $attribute )
        {
            $this->applyAttribute($attribute);
        }
    }
    
    protected function applyAttribute(XsdAttribute $attribute)
    {
        // <attribute
        //   default = string
        //   fixed = string
        //   form = (qualified | unqualified)
        //   id = ID
        //   name = NCName
        //   ref = QName
        //   type = QName
        //   use = (optional | prohibited | required) : optional
        //   {any attributes with non-schema namespace . . .}>
        //   Content: (annotation?, simpleType?)
        // </attribute>
        
        $this->createProperty($attribute->name, $attribute->type);
    }
    

    /**
     * 
     * @return string
     */
    protected function getFullClassName()
    {
        return $this->id;
    }
    
    /**
     * 
     * @param string $name
     * @param string $type
     * @return CbProperty
     */
    protected function createProperty($name, $type = null)
    {
        $property = $this->class->createProperty($name, $type);
        
        return $property;
    }
}