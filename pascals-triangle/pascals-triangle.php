<?php

function pascalsTriangleRows($numberOfRows) {

    if($numberOfRows<0 || $numberOfRows===NULL) {
        return -1;
    }

    $triangleArray=array();
    $lastRow=array();
    $currentRow=array();

    for($x=1;$x<=$numberOfRows;$x++) {
        for($y=0;$y<$x;$y++) {
            if(array_key_exists($y-1,$lastRow) && array_key_exists($y, $lastRow)) {
                array_push($currentRow,$lastRow[$y-1]+$lastRow[$y]);
            }
            else {
                array_push($currentRow,1);
            }
        }
        array_push($triangleArray, $currentRow);
        $lastRow=$currentRow;
        $currentRow=array();
    }

    return $triangleArray;
}