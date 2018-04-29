<?php

function getClassification(int $number) {

    //check if number is less than 1
    if($number<1) {
        throw new InvalidArgumentException('Number must be greater than 0.');
    }

    //get factorals of number
    $factorals=array();
    for($x=$number-1;$x>0;$x--) {
        if($number%$x==0) {
            array_push($factorals,$x);
        }
    }
    
    //calculate aligquot sum
    $aliquotSum=0;
    foreach($factorals as $factor) {
        $aliquotSum=$aliquotSum+$factor;
    }

    //determine if number is perfect, abundant or deficient
    if($number==$aliquotSum) {
        return 'perfect';
    }
    elseif($aliquotSum>$number) {
        return 'abundant';
    }
    elseif($aliquotSum<$number) {
        return 'deficient';
    }
}
