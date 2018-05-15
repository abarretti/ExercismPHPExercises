<?php

function transpose(array $lines) {

  //adds spaces to the ends of any line that is shorter than the longest line (excludes last line)
  $adjustedLinesArray=[];
  $longestLine = max(array_map('strlen', $lines));
  $linesInArray=count($lines);
  $lineCounter=0;
  foreach($lines as $line) {
    $lineCounter=$lineCounter+1;
    $currentLineLength=strlen($line);

    if($currentLineLength<$longestLine && $lineCounter!=$linesInArray) {
      $spacesToAdd=$longestLine-$currentLineLength;
      for($x=0;$x<$spacesToAdd;$x++) {
        $line.=' ';
      }
    }
    array_push($adjustedLinesArray,$line);
  }

  //builds transposed array
  $transposeArray=[];
  $counter=0;
  foreach($adjustedLinesArray as $line) {

    $lineArray=str_split($line);
    
    foreach($lineArray as $character) {
      if (array_key_exists($counter,$transposeArray)) {
        $transposeArray[$counter].=$character;
      }
      else {
        array_push($transposeArray,$character);
      }
      $counter=$counter+1;
    }
    $counter=0;
  }

  //removes blank space from the end of the last string
  $transposeArrayLength=count($transposeArray);
  $transposeArray[$transposeArrayLength-1]=rtrim($transposeArray[$transposeArrayLength-1]," ");

  return $transposeArray;
}