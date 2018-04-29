<?php

function translate($string)
{
    $wordsArray= explode(" ", $string);
    foreach($wordsArray as &$word)
    {
        if(preg_match("/^[aeiou]/", $word) || in_array(substr($word,0,2),["xr","yt"]))
        {
            $word=$word."ay";
        }

        elseif(in_array(substr($word,0,3),["thr","sch"]))
        {
            $latinWord= substr($word,3).substr($word,0,3)."ay";
            $word= $latinWord;
        }

        elseif(preg_match("/^[^aeiou]/", $word) && in_array(substr($word,1,2),["qu"]))
        {
            $latinWord= substr($word,3).substr($word,0,3)."ay";
            $word= $latinWord;
        }

        elseif(in_array(substr($word,0,2),["ch","qu","th"]))
        {
            $latinWord= substr($word,2).substr($word,0,2)."ay";
            $word= $latinWord;
        }

        else
        {
            $latinWord= substr($word,1).substr($word,0,1)."ay";
            $word= $latinWord;
        }
    }
    
    $pigLatinString= implode(" ",$wordsArray);
    return $pigLatinString;
}