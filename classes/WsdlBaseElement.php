<?php

abstract class WsdlBaseElement extends WsdlParserXmlElement
{
    public function getName()
    {
        return $this->getXmlAttribute('name');
    }
    
    public function getQName()
    {
        return $this->targetNamespace .'#'. $this->getName();
    }
}