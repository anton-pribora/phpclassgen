<?php
/**
 * Какие-то структурированные данные
 * 
 */
class SomeData
{
    /**
     * Идентификатор записи
     * Type: xsd:string
     * 
     * @var string
     */
    public $id = null;

    /**
     * Название
     * Type: xsd:string
     * 
     * @var string
     */
    public $name = null;

    /**
     * Описание
     * Type: xsd:string
     * 
     * @var string
     */
    public $description = null;

    /**
     * 
     * @param string $id 
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * 
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * 
     * @param string $name 
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * 
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * 
     * @param string $description 
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * 
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }
}

