<?php

class PhoneNumber
{
    private $number;

    public function __construct($number)
    {
        $this->number= $this->setNumber($number);
    }

    public function setNumber($number)
    {
        $strippedNumber=preg_replace("/[(). ]/","",$number);
        $strippedNumber= str_replace("-","",$strippedNumber);
        if(preg_match("/^[0-9]{10}$/",$strippedNumber))
        {
            return $strippedNumber;
        }
        elseif(preg_match("/^[1]{1}[0-9]{10}$/",$strippedNumber))
        {
            $strippedNumber=substr($strippedNumber,1);
            return $strippedNumber;
        }
        else
        {
            throw new InvalidArgumentException('Not a valid phone number');
        }
    }

    public function number()
    {
        return $this->number;
    }

    public function areaCode()
    {
        return substr($this->number,0,3);
    }

    public function prettyPrint()
    {
        if(strlen($this->number)==10)
        {
            $prettyPrintNumber= "(".substr($this->number,0,3).") ".substr($this->number,3,3)."-".substr($this->number,6);
        }
        else
        {
            $prettyPrintNumber= "(".substr($this->number,1,3).") ".substr($this->number,4,3)."-".substr($this->number,7);
        }
        return $prettyPrintNumber;
    }
}
