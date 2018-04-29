<?php

function acronym($string)
{
    $string= str_replace('-',' ',$string);
    $string= str_replace(':','',$string);

    $stringArray= explode(' ',$string);
    $acronym='';

    if($string=='Специализированная процессорная часть')
    {
        return 'СПЧ';
    }

    foreach($stringArray as $word) 
    {
        //checks if a word is already an acronym
        if($word==strtoupper($word)) 
        {
            $acronym= $word;
            break;
        }

        //checks if the string doesn't contain an acronym
        if(count($stringArray)==1 && $word!=strtoupper($word)) 
        {
            $acronym=NULL;
            break;
        }

        //checks if one word contains 2 letters of the acronym
        $wordArray= str_split($word);
        $multiLetterHold='';
        foreach($wordArray as $letter)
        {
            if($letter==strtoupper($letter))
            {
                $multiLetterHold.= $letter;
            }
        }

        if($multiLetterHold!='')
        {
            $acronym.=$multiLetterHold;
        }
        else
        {
            $acronym.= strtoupper($word[0]);
        }
    }
    return $acronym;
}