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
        return count($this->someData) > 0;
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

