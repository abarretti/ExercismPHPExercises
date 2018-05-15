<?php

function crypto_square(string $string) {

  //check if string is empty
  if($string=="") {
    return "";
  }

  $string=strtolower(preg_replace('/[ %@,.!?]/','',$string));
  if (strlen($string)==8) {
    $row=3;
    $column=3;
  }
  elseif(sqrt(strlen($string))!=floor(sqrt(strlen($string)))) {
    $row=floor(sqrt(strlen($string)));
    $column=$row+1;
  }
  else {
    $row=sqrt(strlen($string));
    $column=sqrt(strlen($string));
  }
  
  //create normalized array
  $rowString='';
  $letterCounter=0;
  $normalizedArray=[];
  for($x=0;$x<$row;$x++){
    for($y=0;$y<$column;$y++) {
        $rowString.=substr($string,$letterCounter,1);
        if(substr($string,$letterCounter,1)!='') {
            $letterCounter=$letterCounter+1;
        }
    }
    array_push($normalizedArray,$rowString);
    $rowString='';
  }

  //create crypto square array
  $cryptoArray=[];
  $cryptoString='';
  $placeCounter=0;

    while($placeCounter<strlen($normalizedArray[0])) {
        foreach($normalizedArray as $string) {
            $cryptoString.=substr($string,$placeCounter,1);
        }
        array_push($cryptoArray,$cryptoString);
        $cryptoString='';
        $placeCounter=$placeCounter+1;
    }

  //add trailing spaces to short lines
  $cryptoLength=strlen($cryptoArray[0]);
  foreach($cryptoArray as &$cryptoLine) {
    if($cryptoLine<$cryptoLength) {
      $spaceToAdd=$cryptoLength-strlen($cryptoLine);
      for($x=1;$x<=$spaceToAdd;$x++) {
        $cryptoLine=$cryptoLine." ";
      }
    }
  }
  
  //return crypto string
  return implode(' ',$cryptoArray);
}