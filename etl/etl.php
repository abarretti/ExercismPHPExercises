<?php

function transform(array $old)
{
    $newArray=[];
    foreach($old as $key=>$value)
    {
        $newValue= (int)$key;
        foreach($value as $letter)
        {
            $lowerCaseKey=strtolower($letter);
            if(array_key_exists($lowerCaseKey, $newArray))
            {
                $newArray[$lowerCaseKey]=$newArray[$lowerCaseKey]+$newValue;
            }
            else
            {
                $newArray[$lowerCaseKey]=$newValue;
            }
        }
    }
    return $newArray;
}