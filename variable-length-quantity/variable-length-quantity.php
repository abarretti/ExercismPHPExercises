<?php

function vlq_encode(array $hexis)
{
    $binaryArray= [];
    foreach($hexis as $hexi)
    {
        $binarySubArray=[];
        $binaryString= strrev(decbin($hexi));
        $binaryStringLength=strlen($binaryString);
        $binaryHold="";
        $arrayCount="0";
        for($x=0;$x<$binaryStringLength;$x++)
        {
            $binaryHold=$binaryString[$x].$binaryHold;
            if(strlen($binaryHold)<7 && $x==$binaryStringLength-1)
            {
                $zeroFill="";              
                for($y=1;$y<=7-strlen($binaryHold);$y++)
                {
                    $zeroFill.='0';
                }
                $binaryHold=$arrayCount.$zeroFill.$binaryHold;
                array_push($binarySubArray, $binaryHold);
            }
            elseif(strlen($binaryHold)==7)
            {
                array_push($binarySubArray,$arrayCount.$binaryHold);
                $arrayCount="1";
                $binaryHold="";
            }
        }
        array_push($binaryArray,$binarySubArray);
    }
    
    $hexiArray=[];
    foreach($binaryArray as $binarySubArray)
    {
        $revBinarySubArray=array_reverse($binarySubArray);
        foreach($revBinarySubArray as $binary)
        {
            array_push($hexiArray,(int)base_convert($binary,2,10));
        }
    }
    return $hexiArray;
}

function vlq_decode(array $hexis)
{
    $binaryArray= [];
    foreach(array_reverse($hexis) as $hexi)
    {
        $binary=decbin($hexi);
        if(strlen($binary)<8)
        {
            $zeroFill="";
            $placesToAdd= 8-strlen($binary);
            for($x=1;$x<=$placesToAdd;$x++)
            {
                $zeroFill.="0";
            }
            $binary=$zeroFill.$binary;
        }
        array_push($binaryArray, $binary);
    }

    //Test Complete Byte Sequence
    $complete=FALSE;
    foreach($binaryArray as $binaryString)
    {
        if($binaryString[0]=='0')
        {
            $complete=TRUE;
        }
    }
    if($complete==FALSE)
    {
        throw new InvalidArgumentException('Incomplete byte sequence.');
    }
    
    $hexiArray=[];
    $total=0;
    $binExponent=6;
    $firstIteration=1;
    foreach($binaryArray as $binaryString)
    {
        $binaryStringArray= str_split($binaryString);
        $count=0;
        foreach($binaryStringArray as $binary)
        {   
            $count=$count+1;
            if($firstIteration==1)
            {
                $firstIteration=0;
                continue;
            }
            elseif($count==1 && $binary==0)
            {
                array_push($hexiArray, $total);
                $total=0;
                $binExponent=6;
            }
            elseif($count==1)
            {
                continue;
            }
            else
            {
                $total=$total+(int)$binary*(2**$binExponent);
                $binExponent=$binExponent-1;
            }
        }
        $binExponent=$binExponent+14;
    }
    array_push($hexiArray,$total);
    if($total>0xFFFFFFF)
    {
        throw new OverflowException('Overflow Exception.');
    }
    return array_reverse($hexiArray);
}