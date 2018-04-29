<?php

//
// This is only a SKELETON file for the "Hamming" exercise. It's been provided as a
// convenience to get you started writing code faster.
//

function distance($a, $b)
{
    if(preg_match('/^[A-Z]+$/',$a) AND preg_match('/^[A-Z]+$/',$b))
    {
        if(strlen($a) != strlen($b))
        {
            return 'DNA stands must be of equal length.';
            return 'InvalidArgumentException';
        }

        $distance=0;
        for($x=0;$x<strlen($a);$x++)
        {
            if($a[$x] != $b[$x])
            {
                $distance=$distance+1;
            }
        }
        return $distance;
    }

    else
    {
        return 'InvalidArgumentException';
    }
}
