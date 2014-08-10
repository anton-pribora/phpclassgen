<?php

class SoapAddress extends WsdlParserXmlElement
{
    public function getLocation()
    {
        return $this->getXmlAttribute('location');
    }
}