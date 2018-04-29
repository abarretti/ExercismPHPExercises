<?php

function total(array $basket) {
    
    $comboArray=[];
    $currentArray=NULL;

    foreach($basket as $book) {

        if (empty($comboArray)) {
            array_push($comboArray, array($book));
        }
        else {
            foreach ($comboArray as &$subArray) {
                if (!in_array($book,$subArray)) {
                    array_push($subArray,$book);
                    break;
                }
            }

            if($currentArray===$comboArray && ($book!=2 || count($comboArray)==1)) {
                array_push($comboArray, array($book));
            }
        }
        $currentArray=$comboArray;
    }

    if(count($basket)>=3 && count($basket)<=5){
        for($x=3;$x<=count($basket);$x++) {
            array_pop($comboArray);
        }
    }

    $total=0;
    foreach($comboArray as $array) {
        if(count($array)==5) {
            $total=$total+30;
        }
        elseif(count($array)==4) {
            $total=$total+25.60;
        }
        elseif(count($array)==3) {
            $total=$total+21.60;
        }
        elseif(count($array)==2) {
            $total=$total+15.20;
        }
        else {
            $total=$total+8;
        }

    }

    return $total;
}