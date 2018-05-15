<?php

function toRoman($number) {

    $romanNumeralArray=[
    "M"=>1000,
    "CM"=>900, 
    "D"=>500,
    "CD"=>400,
    "C"=>100,
    "XC"=>90, 
    "L"=>50,
    "XL"=>40, 
    "X"=>10, 
    "IX"=>9,
    "V"=>5,
    "IV"=>4, 
    "I"=>1];
    
    $remainder=$number;
    $romanNumeral=NULL;
    
    foreach($romanNumeralArray as $key=>$value) {
        $romanQuotient=$remainder/$value;
                
        for($x=1;$x<=$romanQuotient;$x++) {
            $romanNumeral.=$key;
        }
        $remainder=$remainder%$value;
    }   
    
    return $romanNumeral;
}