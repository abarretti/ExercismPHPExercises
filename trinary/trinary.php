<?php

function toDecimal($integerString)
{
    if(preg_match("/[3-9]/",$integerString))
    {
        return 0;
    }

    $trinaryLength=strlen($integerString)-1;
    $trinaryLengthExponent=$trinaryLength;
    $trinaryStore=0;

    for($x=0;$x<=$trinaryLength;$x++)
    {
        $number=(int)$integerString[$x]*(3**$trinaryLengthExponent);
        $trinaryStore= $trinaryStore+$number;
        $trinaryLengthExponent=$trinaryLengthExponent-1;
    }

    return $trinaryStore;
}