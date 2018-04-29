<?php

function detectAnagrams($string, $anagramArray)
{
    $length=strlen($string);
    $lettersCount=array();
    for($x=0;$x<$length;$x++)
    {
        if (!array_key_exists(strtolower($string[$x]),$lettersCount))
        {
            $lettersCount[strtolower($string[$x])]=1;
        }
        else
        {
            foreach($lettersCount as $key=>&$value)
            {
                if($key==strtolower($string[$x]))
                {
                    $lettersCount[strtolower($string[$x])]=$value+1;
                }
            }
        }        
    }

    //return variable
    $returnAnagramArray=array();

    $arrayLettersCount=array();
    foreach($anagramArray as $word)
    {
        for($y=0;$y<strlen($word);$y++)
        {
            if (!array_key_exists(strtolower($word[$y]),$arrayLettersCount))
            {
                $arrayLettersCount[strtolower($word[$y])]=1;
            }
            else
            {
                foreach($arrayLettersCount as $key=>&$value)
                {
                    if($key==strtolower($word[$y]))
                    {
                        $arrayLettersCount[strtolower($word[$y])]=$value+1;
                    }
                }
            }        
        }

        if($lettersCount==$arrayLettersCount && strcasecmp($word, $string))
        {
            array_push($returnAnagramArray, $word);
        }
        $arrayLettersCount=array();
    }

    return $returnAnagramArray;
}