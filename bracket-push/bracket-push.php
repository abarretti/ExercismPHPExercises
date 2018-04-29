<?php

function brackets_match($string)
{

$stringLength=strlen($string);
$bracketArray=[];

for($x=0;$x<$stringLength;$x++)
{
    if($string[$x]=="[" || $string[$x]=="]" || $string[$x]=="{" || $string[$x]=="}" || $string[$x]=="(" || $string[$x]==")")
    {
        $bracketArray[$string[$x]]=$x;
    }
}

// [ Test
if(array_key_exists("[", $bracketArray))
{
    if(!array_key_exists("]", $bracketArray) || $bracketArray["["]>$bracketArray["]"])
    {
        return false;
    }
}

if(array_key_exists("]", $bracketArray) && !array_key_exists("[", $bracketArray))
{
    return false;
}

// { Test
if(array_key_exists("{", $bracketArray))
{
    if(!array_key_exists("}", $bracketArray) || $bracketArray["{"]>$bracketArray["}"])
    {
        return false;
    }
}

if(array_key_exists("}", $bracketArray) && !array_key_exists("{", $bracketArray))
{
    return false;
}

// ( Test
if(array_key_exists("(", $bracketArray))
{
    if(!array_key_exists(")", $bracketArray) || $bracketArray["("]>$bracketArray[")"])
    {
        return false;
    }
}

if(array_key_exists(")", $bracketArray) && !array_key_exists("(", $bracketArray))
{
    return false;
}

//Nesting Test
$nestingTestString="";
$openClosedArray=["["=>"]","{"=>"}","("=>")"];
foreach($bracketArray as $key=>$value)
{
    if($key=="[" || $key=="{" || $key=="(")
    {
        $nestingTestString.=$key;
    }
    elseif($key=="]" || $key=="}" || $key==")")
    {
        if($openClosedArray[$nestingTestString[-1]] != $key)
        {
            return false;
        }
        else
        {
            $nestingTestString=substr($nestingTestString,0,strlen($nestingTestString)-1);
        }
    }
}

return true;
}