<?php


function factors(int $number) {

$remainder=$number;
$factor=2;
$factorArray=array();

  while($remainder>1) {
    if($remainder%$factor==0) {
      array_push($factorArray,$factor);
      $remainder=$remainder/$factor;
    }
    else {
      $factor=$factor+1;
    }
  }
  
  return $factorArray;
}