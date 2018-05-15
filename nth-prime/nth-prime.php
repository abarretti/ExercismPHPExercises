<?php

function prime(int $number) {

    if($number<1) {
        return false;
    }

  $primeNumbersArray=array(2);
  
  $testNumber=3;
  while(count($primeNumbersArray)<$number){
    for($x=2;$x<$testNumber;$x++) {
      if($testNumber%$x==0) {
        $testNumber=$testNumber+1;
        break;
      }
      if($x==$testNumber-1 && $testNumber%$x!=0) {
        array_push($primeNumbersArray,$testNumber); 
        $testNumber=$testNumber+1;
        break;
      }
    }
  }
  
  return $primeNumbersArray[$number-1];
}
