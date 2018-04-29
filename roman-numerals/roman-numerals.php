<?php

function toRoman($number)
{

    $romanNumeralArray=array("M"=>1000, "D"=>500, "C"=>100, "L"=>50, "X"=>10, "V"=>5, "I"=>1);
    $remainder=$number;
    $romanNumeral=NULL;
    foreach($romanNumeralArray as $key=>$value)
    {
        for($x=1;$x<=($remainder/$value);$x++)
        {
            $romanNumeral.=$key;
        }

        $remainder=$remainder%$value;

        if($key=="L" and $remainder >= .8*$value)
        {
            $romanNumeral.= "X".$key;
            $remainder=$remainder-(.8*$value);
        }

        if($key=="V" and $remainder >= .8*$value)
        {
            $romanNumeral.= "I".$key;
            $remainder=$remainder-(.8*$value);
        }

        if($key=="D" and $remainder >= .8*$value)
        {
            $romanNumeral.= "C".$key;
            $remainder=$remainder-(.8*$value);
        }

        if ($remainder >= .9*$value)
        {
            if($key=='M')
            {
                $romanNumeral.= "C".$key;
            }
            if ($key=="D") 
            {
                $romanNumeral.= "L".$key;
            }
            if ($key=="C") 
            {
                $romanNumeral.= "X".$key;
            }
            if ($key=="L") 
            {
                $romanNumeral.= "V".$key;
            }
            if ($key=="X") 
            {
                $romanNumeral.= "I".$key;
            }
            $remainder=$remainder-(.9*$value);
        }
    }
return $romanNumeral;
}