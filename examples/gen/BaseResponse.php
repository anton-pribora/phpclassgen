<?php
/**
 * Базовый ответ, общий для всех ответов
 * 
 */
abstract class BaseResponse
{
    /**
     * Type: xsd:string
     * 
     * @var string
     */
    public $traceId = null;

    /**
     * 
     * @param string $traceId 
     */
    public function setTraceId($traceId)
    {
        $this->traceId = $traceId;
    }

    /**
     * 
     * @return string
     */
    public function getTraceId()
    {
        return $this->traceId;
    }
}

