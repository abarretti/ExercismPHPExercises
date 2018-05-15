<?php

function slices(string $numberString, int $series) {

    if ($series<1 || $series>strlen($numberString)) {
        throw new InvalidArgumentException('Series is larger than string or series is less than 1.');
    }

  $placeHolder=0;
  $holdString='';
  $numberStringArray= str_split($numberString);
  $seriesArray=[];
  
  while($placeHolder+$series<=strlen($numberString)) {
    for($x=$placeHolder;$x<$series+$placeHolder;$x++) {
      $holdString.=$numberStringArray[$x];
    }
    array_push($seriesArray,$holdString);
    $holdString='';
    $placeHolder=$placeHolder+1;
  }
  return $seriesArray;
}
