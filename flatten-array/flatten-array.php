<?php

function flatten(array $inputArray) : array {

$flattenArray=[];

array_walk_recursive($inputArray, function($value) use (&$flattenArray) {
    if($value!==NULL) {
      array_push($flattenArray,$value);
    }
    return $flattenArray;
});

return $flattenArray;
}// function close