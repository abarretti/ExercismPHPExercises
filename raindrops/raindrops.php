<?php

function raindrops($number)
{
    $returnString="";
    if((int)$number%3==0)
    {
        $returnString.="Pling";
    }

    if((int)$number%5==0)
    {
        $returnString.="Plang";
    }

    if((int)$number%7==0)
    {
        $returnString.="Plong";
    }

    if($returnString=="")
    {
        return (string)$number;
    }

    else
    {
        return $returnString;
    }
}
