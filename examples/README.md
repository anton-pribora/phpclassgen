# Примеры использования phpclassgen
## Генерирование классов

Перейдите в папку `examples` в каталоге, где установлен `phpclassgen`. Затем Выполните комманду:

	% ../phpclassgen.php -w service.wsdl -d gen
	BaseRequest .. ok
	SomeOperationRequest .. ok
	SomeOperationResponse .. ok
	BaseResponse .. ok
	SomeData .. ok

В папке `gen` будут сгенерированы классы:

	% ls gen -1
	BaseRequest.php
	BaseResponse.php
	SomeData.php
	SomeOperationRequest.php
	SomeOperationResponse.php

### Примеры генерируемых классов PHP

#### BaseRequest.php

Генератор понимает абстрактные классы и корректно выставляет ключевое слово `abstract`.

	<?php
	/**
	 * Базовый запрос
	 * 
	 */
	abstract class BaseRequest
	{
	    /**
	     * Логин для авторизации
	     * Type: xsd:string
	     * 
	     * @var string
	     */
	    public $login = null;
	
	    /**
	     * Пароль для авторизации
	     * Type: xsd:string
	     * 
	     * @var string
	     */
	    public $password = null;
	
	    /**
	     * 
	     * @param string $login 
	     */
	    public function setLogin($login)
	    {
	        $this->login = $login;
	    }
	
	    /**
	     * 
	     * @return string
	     */
	    public function getLogin()
	    {
	        return $this->login;
	    }
	
	    /**
	     * 
	     * @param string $password 
	     */
	    public function setPassword($password)
	    {
	        $this->password = $password;
	    }
	
	    /**
	     * 
	     * @return string
	     */
	    public function getPassword()
	    {
	        return $this->password;
	    }
	}

#### SomeOperationResponse.php

Генератор понимает, что некоторые элементы являются массивами и корректно их обрабатывает.

	<?php
	/**
	 * Ответ на тестовый запрос
	 * 
	 */
	class SomeOperationResponse extends BaseResponse
	{
	    /**
	     * Массив каких-то элементов
	     * Type: tns:SomeData
	     * 
	     * @var SomeData[]
	     */
	    public $someData = [];
	
	    /**
	     * 
	     * @return bool
	     */
	    public function hasSomeData()
	    {
	        return count($this->someData) > 1;
	    }
	
	    /**
	     * 
	     * @return SomeData[]
	     */
	    public function getSomeData()
	    {
	        return $this->someData;
	    }
	
	    /**
	     * 
	     * @param SomeData $someData 
	     */
	    public function addSomeData($someData)
	    {
	        $this->someData[] = $someData;
	    }
	}

## Просмотр структуры WSDL-документа

Выполните следующую комманду и структура WSDL-файла будет выведена на экран:

	% ../phpclassgen.php -w service.wsdl --show-wsdl
	Targetnamespace: http://www.example.org/service/
	Services:
	  service
	    Ports (endpoints)
	      serviceSOAP
	        Binding: tns:serviceSOAP
	        Soap Address: http://www.example.org/
	      serviceSOAP-dev
	        Binding: tns:serviceSOAP
	        Soap Address: http://www.example.org/test.php
	  
	Bindings:
	  serviceSOAP
	    PortType: service
	  
	PortTypes:
	  service
	    Operations:
	      someOperation
	        Input: tns:someOperationRequest
	        Output: tns:someOperationResponse
	        Falut: tns:someOperationFault

## Просмотр структуры XSD-схемы

Выполните следующую комманду и структура XSD-схемы будет выведена на экран:

	% ../phpclassgen.php -w service.wsdl --show-xsd 
	XsdSchema
	    @attributeFormDefault => 'unqualified'
	    @blockDefault => NULL
	    @elementFormDefault => 'unqualified'
	    @finalDefault => NULL
	    @id => NULL
	    @targetNamespace => 'http://www.example.org/service/'
	    @version => NULL
	    @lang => NULL
	    complexTypes(5): Array (
	        0 => XsdComplexType
	            @abstract => 'true'
	            @block => NULL
	            @final => NULL
	            @id => NULL
	            @mixed => false
	            @name => 'BaseRequest'
	            annotation:XsdAnnotation
	                    @id => NULL
	                    documentations(1): Array (
	                        0 => XsdDocumentation
	                            @source => NULL
	                            @lang => NULL
	                            ~textContent => Базовый запрос
	                    )
	            sequence:XsdSequence
	                    @id => NULL
	                    @maxOccurs => 1
	                    @minOccurs => 1
	                    elements(2): Array (
	                        0 => XsdElement
	                            @abstract => false
	                            @block => NULL
	                            @default => NULL
	                            @final => NULL
	                            @fixed => NULL
	                            @form => NULL
	                            @id => NULL
	                            @maxOccurs => 1
	                            @minOccurs => 1
	                            @name => 'login'
	                            @nillable => false
	                            @ref => NULL
	                            @substitutionGroup => NULL
	                            @type => 'xsd:string'
	                            annotation:XsdAnnotation
	                                    @id => NULL
	                                    documentations(1): Array (
	                                        0 => XsdDocumentation
	                                            @source => NULL
	                                            @lang => NULL
	                                            ~textContent => Логин для авторизации
	                                    )
	                        1 => XsdElement
	                            @abstract => false
	                            @block => NULL
	                            @default => NULL
	                            @final => NULL
	                            @fixed => NULL
	                            @form => NULL
	                            @id => NULL
	                            @maxOccurs => 1
	                            @minOccurs => 1
	                            @name => 'password'
	                            @nillable => false
	                            @ref => NULL
	                            @substitutionGroup => NULL
	                            @type => 'xsd:string'
	                            annotation:XsdAnnotation
	                                    @id => NULL
	                                    documentations(1): Array (
	                                        0 => XsdDocumentation
	                                            @source => NULL
	                                            @lang => NULL
	                                            ~textContent => Пароль для авторизации
	                                    )
	                    )
	        1 => XsdComplexType
	            @abstract => false
	            @block => NULL
	            @final => NULL
	            @id => NULL
	            @mixed => false
	            @name => 'SomeOperationRequest'
	            annotation:XsdAnnotation
	                    @id => NULL
	                    documentations(1): Array (
	                        0 => XsdDocumentation
	                            @source => NULL
	                            @lang => NULL
	                            ~textContent => Тестовый запрос на получение каких-то данных
	                    )
	            complexContent:XsdComplexContent
	                    @id => NULL
	                    @mixed => NULL
	                    extension:XsdComplexContentExtension
	                            @base => 'tns:BaseRequest'
	                            @id => NULL
	                            sequence:XsdSequence
	                                    @id => NULL
	                                    @maxOccurs => 1
	                                    @minOccurs => 1
	                                    elements(1): Array (
	                                        0 => XsdElement
	                                            @abstract => false
	                                            @block => NULL
	                                            @default => NULL
	                                            @final => NULL
	                                            @fixed => NULL
	                                            @form => NULL
	                                            @id => NULL
	                                            @maxOccurs => 1
	                                            @minOccurs => 1
	                                            @name => 'someId'
	                                            @nillable => false
	                                            @ref => NULL
	                                            @substitutionGroup => NULL
	                                            @type => 'xsd:string'
	                                            annotation:XsdAnnotation
	                                                    @id => NULL
	                                                    documentations(1): Array (
	                                                        0 => XsdDocumentation
	                                                            @source => NULL
	                                                            @lang => NULL
	                                                            ~textContent => Какой-то идентификатор
	                                                    )
	                                    )
	        2 => XsdComplexType
	            @abstract => false
	            @block => NULL
	            @final => NULL
	            @id => NULL
	            @mixed => false
	            @name => 'SomeOperationResponse'
	            annotation:XsdAnnotation
	                    @id => NULL
	                    documentations(1): Array (
	                        0 => XsdDocumentation
	                            @source => NULL
	                            @lang => NULL
	                            ~textContent => Ответ на тестовый запрос
	                    )
	            complexContent:XsdComplexContent
	                    @id => NULL
	                    @mixed => NULL
	                    extension:XsdComplexContentExtension
	                            @base => 'tns:BaseResponse'
	                            @id => NULL
	                            sequence:XsdSequence
	                                    @id => NULL
	                                    @maxOccurs => 1
	                                    @minOccurs => 1
	                                    elements(1): Array (
	                                        0 => XsdElement
	                                            @abstract => false
	                                            @block => NULL
	                                            @default => NULL
	                                            @final => NULL
	                                            @fixed => NULL
	                                            @form => NULL
	                                            @id => NULL
	                                            @maxOccurs => 'unbounded'
	                                            @minOccurs => '0'
	                                            @name => 'someData'
	                                            @nillable => false
	                                            @ref => NULL
	                                            @substitutionGroup => NULL
	                                            @type => 'tns:SomeData'
	                                            annotation:XsdAnnotation
	                                                    @id => NULL
	                                                    documentations(1): Array (
	                                                        0 => XsdDocumentation
	                                                            @source => NULL
	                                                            @lang => NULL
	                                                            ~textContent => Массив каких-то элементов
	                                                    )
	                                    )
	        3 => XsdComplexType
	            @abstract => 'true'
	            @block => NULL
	            @final => NULL
	            @id => NULL
	            @mixed => false
	            @name => 'BaseResponse'
	            annotation:XsdAnnotation
	                    @id => NULL
	                    documentations(1): Array (
	                        0 => XsdDocumentation
	                            @source => NULL
	                            @lang => NULL
	                            ~textContent => Базовый ответ, общий для всех ответов
	                    )
	            sequence:XsdSequence
	                    @id => NULL
	                    @maxOccurs => 1
	                    @minOccurs => 1
	                    elements(1): Array (
	                        0 => XsdElement
	                            @abstract => false
	                            @block => NULL
	                            @default => NULL
	                            @final => NULL
	                            @fixed => NULL
	                            @form => NULL
	                            @id => NULL
	                            @maxOccurs => 1
	                            @minOccurs => 1
	                            @name => 'traceId'
	                            @nillable => false
	                            @ref => NULL
	                            @substitutionGroup => NULL
	                            @type => 'xsd:string'
	                    )
	        4 => XsdComplexType
	            @abstract => false
	            @block => NULL
	            @final => NULL
	            @id => NULL
	            @mixed => false
	            @name => 'SomeData'
	            annotation:XsdAnnotation
	                    @id => NULL
	                    documentations(1): Array (
	                        0 => XsdDocumentation
	                            @source => NULL
	                            @lang => NULL
	                            ~textContent => Какие-то структурированные данные
	                    )
	            sequence:XsdSequence
	                    @id => NULL
	                    @maxOccurs => 1
	                    @minOccurs => 1
	                    elements(3): Array (
	                        0 => XsdElement
	                            @abstract => false
	                            @block => NULL
	                            @default => NULL
	                            @final => NULL
	                            @fixed => NULL
	                            @form => NULL
	                            @id => NULL
	                            @maxOccurs => 1
	                            @minOccurs => 1
	                            @name => 'id'
	                            @nillable => false
	                            @ref => NULL
	                            @substitutionGroup => NULL
	                            @type => 'xsd:string'
	                            annotation:XsdAnnotation
	                                    @id => NULL
	                                    documentations(1): Array (
	                                        0 => XsdDocumentation
	                                            @source => NULL
	                                            @lang => NULL
	                                            ~textContent => Идентификатор записи
	                                    )
	                        1 => XsdElement
	                            @abstract => false
	                            @block => NULL
	                            @default => NULL
	                            @final => NULL
	                            @fixed => NULL
	                            @form => NULL
	                            @id => NULL
	                            @maxOccurs => 1
	                            @minOccurs => 1
	                            @name => 'name'
	                            @nillable => false
	                            @ref => NULL
	                            @substitutionGroup => NULL
	                            @type => 'xsd:string'
	                            annotation:XsdAnnotation
	                                    @id => NULL
	                                    documentations(1): Array (
	                                        0 => XsdDocumentation
	                                            @source => NULL
	                                            @lang => NULL
	                                            ~textContent => Название
	                                    )
	                        2 => XsdElement
	                            @abstract => false
	                            @block => NULL
	                            @default => NULL
	                            @final => NULL
	                            @fixed => NULL
	                            @form => NULL
	                            @id => NULL
	                            @maxOccurs => 1
	                            @minOccurs => 1
	                            @name => 'description'
	                            @nillable => false
	                            @ref => NULL
	                            @substitutionGroup => NULL
	                            @type => 'xsd:string'
	                            annotation:XsdAnnotation
	                                    @id => NULL
	                                    documentations(1): Array (
	                                        0 => XsdDocumentation
	                                            @source => NULL
	                                            @lang => NULL
	                                            ~textContent => Описание
	                                    )
	                    )
	    )
	    elements(3): Array (
	        0 => XsdElement
	            @abstract => false
	            @block => NULL
	            @default => NULL
	            @final => NULL
	            @fixed => NULL
	            @form => NULL
	            @id => NULL
	            @maxOccurs => 1
	            @minOccurs => 1
	            @name => 'someOperation'
	            @nillable => false
	            @ref => NULL
	            @substitutionGroup => NULL
	            @type => 'tns:SomeOperationRequest'
	        1 => XsdElement
	            @abstract => false
	            @block => NULL
	            @default => NULL
	            @final => NULL
	            @fixed => NULL
	            @form => NULL
	            @id => NULL
	            @maxOccurs => 1
	            @minOccurs => 1
	            @name => 'someOperationResponse'
	            @nillable => false
	            @ref => NULL
	            @substitutionGroup => NULL
	            @type => 'tns:SomeOperationResponse'
	        2 => XsdElement
	            @abstract => false
	            @block => NULL
	            @default => NULL
	            @final => NULL
	            @fixed => NULL
	            @form => NULL
	            @id => NULL
	            @maxOccurs => 1
	            @minOccurs => 1
	            @name => 'someOperationFault'
	            @nillable => false
	            @ref => NULL
	            @substitutionGroup => NULL
	            @type => NULL
	            complexType:XsdComplexType
	                    @abstract => false
	                    @block => NULL
	                    @final => NULL
	                    @id => NULL
	                    @mixed => false
	                    @name => NULL
	                    sequence:XsdSequence
	                            @id => NULL
	                            @maxOccurs => 1
	                            @minOccurs => 1
	                            elements(1): Array (
	                                0 => XsdElement
	                                    @abstract => false
	                                    @block => NULL
	                                    @default => NULL
	                                    @final => NULL
	                                    @fixed => NULL
	                                    @form => NULL
	                                    @id => NULL
	                                    @maxOccurs => 1
	                                    @minOccurs => 1
	                                    @name => 'someOperationFault'
	                                    @nillable => false
	                                    @ref => NULL
	                                    @substitutionGroup => NULL
	                                    @type => 'xsd:string'
	                            )
	    )
	