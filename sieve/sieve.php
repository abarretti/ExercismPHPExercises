<?php

function sieve($limit)
{
    $compositeNumbers= array();
    
    //creates Array with all numbers between 2 and limit
    for($x=2;$x<=$limit;$x++)
    {
        array_push($compositeNumbers, $x);
    }
    
    //begins looping through array and removes multiples of primes
    foreach($compositeNumbers as $n)
    {
        for($x=2;$n*$x<=$limit;$x++)
        {
            if (in_array($n*$x, $compositeNumbers))
            {
                $compositeNumbers=array_diff($compositeNumbers,[$n*$x]);
            }
        }
    }
    $compositeNumbers = array_values($compositeNumbers);
    return $compositeNumbers;
}