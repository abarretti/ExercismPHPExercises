<?php

function sumOfMultiples(int $numberMax, array $multiples) {

    if(in_array(0,$multiples)) {
        return 0;
    }

    //find get all multiples into an array
    $multiplesArray=array();
    foreach($multiples as $multiple) {
        for($x=$numberMax-1;$x>0;$x--) {
            if($x%$multiple==0) {
                if(!in_array($x,$multiplesArray)) {
                    array_push($multiplesArray,$x);
                }
            }
        }
    }

    //calculate sum of multiples
    $sum=0;
    foreach($multiplesArray as $multiple) {
        $sum=$sum+$multiple;
    }

    return $sum;
}