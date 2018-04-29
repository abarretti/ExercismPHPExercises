<?php

function encode($word)
{
    $cipherArray=['a'=>'z','b'=>'y','c'=>'x','d'=>'w','e'=>'v','f'=>'u','g'=>'t','h'=>'s','i'=>'r','j'=>'q','k'=>'p','l'=>'o','m'=>'n','n'=>'m','o'=>'l','p'=>'k','q'=>'j','r'=>'i','s'=>'h','t'=>'g','u'=>'f','v'=>'e','w'=>'d','x'=>'c','y'=>'b','z'=>'a'];
    
    $encodedString="";
    $wordNoSpaces=str_split(strtolower(preg_replace("/[,. ]/","",$word)));   
    
    $counter=0;
    foreach($wordNoSpaces as $letter)
    {
        if($counter==5)
        {
            $encodedString.=" ";
            $counter=0;
        }

        $counter=$counter+1;
        if(array_key_exists($letter, $cipherArray))
        {
            $encodedString.=$cipherArray[$letter];
        }
        else
        {
            $encodedString.=$letter;
        }
    }
    return $encodedString;
}
