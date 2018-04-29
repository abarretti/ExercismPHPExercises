<?php

function isIsogram($string)
{
    $values= array();
    for($x=0;$x<strlen($string);$x++)
    {
        if ($string[$x]== " " || $string[$x]== "-")
        {
            continue;
        }

        elseif (in_array($string[$x], $values))
        {
            return false;
        }

        else
        {
            array_push($values, strtolower($string[$x]));
        }
    }
    return true;
}
