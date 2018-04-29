<?php

function wordCount($string)
{
    $string= strtolower($string);
    $string= preg_replace('/[!&@^$%&,:]/','', $string);
    $string= str_replace("\n", " ", $string);
    $string= str_replace("\t", " ", $string);

    $stringArray= explode(" ", $string);

    $wordCountArray= array();

    foreach($stringArray as $word)
    {
        if (!array_key_exists($word, $wordCountArray) && $word!="")
        {
            $wordCountArray[$word]=1;
        }

        else
        {
            foreach($wordCountArray as $key=>&$value)
            {
                if($word==$key)
                {
                    $value=$value+1;
                }
            }
        }
    }
    return $wordCountArray;
}