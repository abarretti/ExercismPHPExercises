<?php

class Triangle
{
    private $side1;
    private $side2;
    private $side3;

    public function __construct($side1, $side2, $side3)
    {
        $this->side1=$side1;
        $this->side2=$side2;
        $this->side3=$side3;
    }

    public function kind()
    {
        $sideArray= array($this->side1, $this->side2, $this->side3);
        sort($sideArray);

        if($sideArray[0]+$sideArray[1] < $sideArray[2])
        {
            throw new InvalidArgumentException('Two sides are too small to be a triangle.');
        }
        elseif($sideArray[0]<=0 || $sideArray[1]<=0 || $sideArray[2]<=0)
        {
            throw new InvalidArgumentException('A side length cannot be 0.');
        }
        elseif($sideArray[0]==$sideArray[1] && $sideArray[1]==$sideArray[2])
        {
            return 'equilateral';
        }
        elseif($sideArray[0]==$sideArray[1] || $sideArray[1]==$sideArray[2])
        {
            return 'isosceles';
        }
        else
        {
            return 'scalene';
        }   
    }
}