<?php
/**
 * Тестовый запрос на получение каких-то данных
 * 
 */
class SomeOperationRequest extends BaseRequest
{
    /**
     * Какой-то идентификатор
     * Type: xsd:string
     * 
     * @var string
     */
    public $someId = null;

    /**
     * 
     * @param string $someId 
     */
    public function setSomeId($someId)
    {
        $this->someId = $someId;
    }

    /**
     * 
     * @return string
     */
    public function getSomeId()
    {
        return $this->someId;
    }
}

