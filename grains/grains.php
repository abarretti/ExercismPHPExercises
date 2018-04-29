<?php

function square(int $square) {

    if($square<=0 || $square >64) {
        throw new InvalidArgumentException('Not a Valid Chess Board Square.');
    }

    $squaresArray=[];
    for($x=1;$x<=64;$x++) {
        $squaresArray[$x]= (string)intval(2**($x-1));
    }

    if($square==64) {
        return substr($squaresArray[$square],1);
    }
    else {
        return (string)$squaresArray[$square];
    }
}

function total() {
    return implode('', array_reverse( array_reduce(range(1, 64), 
        function ($acc, $n) {
            return sum($acc, array_reverse(str_split(square($n))));
        }, [])));
}

function sum($x, $y)
{
    $shift = 0;
    $result = array_map(function ($a, $b) use (&$shift) {
        $value = $a + $b + $shift;
        if ($value >= 10) {
            $value -= 10;
            $shift = 1;
        } else {
            $shift = 0;
        }
        return $value;
    }, $x, $y);
    if ($shift) {
        array_push($result, $shift);
    }
    return $result;
}