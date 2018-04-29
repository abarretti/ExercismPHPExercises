<?php


function squareOfSums($number)
{
    $sum=0;
    for($x=1;$x<=(int)$number;$x++)
    {
        $sum=$sum+$x;
    }
    return $sum**2;
}

function sumOfSquares($number)
{
    $sum=0;
    for($x=1;$x<=(int)$number;$x++)
    {
        $sum=$sum+($x**2);
    }
    return $sum;
}

function difference($number)
{
    return squareOfSums($number)-sumOfSquares($number);
}