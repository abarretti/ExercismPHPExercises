<?php

function isValid(string $number) {

    //checks if string contains all digits and spaces. And if length is less than or equal to 1
    if(!preg_match('/^[\d ]+$/',$number)) {
        return false;
    }
    
    $number= str_replace(' ','',$number);

    if(strlen($number)<=1) {
        return false;
    }

    //strip the spaces
    $number= str_replace(' ','',$number);
    
    //loop through number starting from right
    $marker=0;
    $numberArray=str_split($number);
    $numberArray=array_reverse($numberArray);
    foreach($numberArray as &$number) {
        if($marker==0) {
            $marker=1;
            continue;
        }
        elseif($marker==1) {
            $marker=0;
            $number=2*(int)$number;
            if($number>9) {
                $number=$number-9;
            }
            $number=(string)$number;
        }
    }
    $doubledNumber=strrev(implode($numberArray));

    //checks if the doubled Number is divisible by 10
    $sum=0;
    $doubledNumberArray=str_split($doubledNumber);
    foreach($doubledNumberArray as $number) {
        $sum=$sum+(int)$number;
    }

    if($sum%10==0) {
        return true;
    }
    else{
        return false;
    }
}