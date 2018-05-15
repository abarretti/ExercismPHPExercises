<?php

function encode(string $plainText, int $rails) {
    
    //create array for each rail
    for($x=1;$x<=$rails;$x++) {
        $_SESSION['rail'.$x]=[];
    }

    //split text and alternate rails
    $plainTextArray=str_split($plainText);

    $railNumber=1;
    $direction='down';
    foreach($plainTextArray as $char) {
        array_push($_SESSION['rail'.$railNumber], $char);
        
        if($railNumber==$rails) {
            $direction='up';
            $railNumber=$railNumber-1;
        }
        elseif($railNumber==1) {
            $direction='down';
            $railNumber=$railNumber+1;
        }
        elseif($direction=='down') {
            $railNumber=$railNumber+1;
        }
        elseif($direction=='up') {
            $railNumber=$railNumber-1;
        }
    }

    //create encoded string
    $encodedString='';

    for($x=1;$x<=$rails;$x++) {
        foreach($_SESSION['rail'.$x] as $char) {
            $encodedString.=$char;
        }
    }

    return $encodedString;
}

function decode(string $encryptedText, int $rails) {

    //create variable for length of each rail
    for($x=1;$x<=$rails;$x++) {
        $_SESSION['railLength'.$x]=0;
    }

    //calculate the length of each rail
    $encryptedTextArray=str_split($encryptedText);

    $railNumber=1;
    $direction='down';
    foreach($encryptedTextArray as $char) {
        $_SESSION['railLength'.$railNumber]= $_SESSION['railLength'.$railNumber]+1;
        
        if($railNumber==$rails) {
            $direction='up';
            $railNumber=$railNumber-1;
        }
        elseif($railNumber==1) {
            $direction='down';
            $railNumber=$railNumber+1;
        }
        elseif($direction=='down') {
            $railNumber=$railNumber+1;
        }
        elseif($direction=='up') {
            $railNumber=$railNumber-1;
        }
    }

    //create an array for each rail
    for($x=1;$x<=$rails;$x++) {
        $_SESSION['rail'.$x]=[];
    }

    //assign encoded message to each rail
    $arrayPosition=0;
    for($x=1;$x<=$rails;$x++) {
        for($y=0;$y<$_SESSION['railLength'.$x];$y++) {
            array_push($_SESSION['rail'.$x],$encryptedTextArray[$arrayPosition]);
            $arrayPosition=$arrayPosition+1;
        }
    }
    
    //create variables for the character number on each rail
    for($x=1;$x<=$rails;$x++) {
        $_SESSION['rail'.$x.'CharNumber']=0;
    }
  
    //read through the arrays and create the decoded string
    $decodedString='';
    $numberOfCharacters=strlen($encryptedText);
    $railNumber=1;
    $direction='down';
    for($x=1;$x<=$numberOfCharacters;$x++) {
        $decodedString.= $_SESSION['rail'.$railNumber][$_SESSION['rail'.$railNumber.'CharNumber']];
        $_SESSION['rail'.$railNumber.'CharNumber']=$_SESSION['rail'.$railNumber.'CharNumber']+1;
      
        if($railNumber==$rails) {
            $direction='up';
            $railNumber=$railNumber-1;
        }
        elseif($railNumber==1) {
            $direction='down';
            $railNumber=$railNumber+1;
        }
        elseif($direction=='down') {
            $railNumber=$railNumber+1;
        }
        elseif($direction=='up') {
            $railNumber=$railNumber-1;
        }
    }
    return $decodedString;
}