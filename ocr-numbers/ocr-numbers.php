<?php

function recognize(array $input) {

    //Line Error Check
    if(count($input)%4!=0) {
        throw new InvalidArgumentException('Input is not 4 lines.');
    }
    foreach($input as $line) {
        if(strlen($line)%3!=0) {
            throw new InvalidArgumentException('A line does not contain the correct number of columns.');
        }
    }

    //splits multiple number strings into separate arrays
    for($x=0;$x<(strlen($input[0])/3);$x++) {
        $_SESSION['number'.$x]=array();
    }

    $arrayCount=0;
    $string="";
    foreach($input as $line) {
        for($y=0;$y<=strlen($line);$y++) {
            if(strlen($string)==3 || $y==strlen($line)) {
                array_push($_SESSION['number'.$arrayCount],$string);
                $string="";
                $arrayCount=$arrayCount+1;
                if($y==strlen($line)) {
                    break;
                }
            }
            $string.=$line[$y];
        }
        $arrayCount=0;
        $string="";
    }
    
    //loops through the numbers in the arrays and creates the return string
    $returnString="";
    $firstLoop= TRUE;
    //$x=0;
    //$z=0;
    for($z=0;$z<count($_SESSION['number0']);$z+=4) 
    {
        if($firstLoop==FALSE) {
            $returnString.=",";
        }
        $firstLoop=FALSE;

        for($x=0;$x<(strlen($input[0])/3);$x++) 
        {
            //recognize 0
            if($_SESSION['number'.$x][$z]==" _ " && $_SESSION['number'.$x][$z+1]=="| |" && $_SESSION['number'.$x][$z+2]=="|_|") {
                $returnString.="0";
            }

            //recognize 1
            elseif($_SESSION['number'.$x][$z]=="   " && $_SESSION['number'.$x][$z+1]=="  |" && $_SESSION['number'.$x][$z+2]=="  |" ) {
                $returnString.="1";
            }

            //recognize 2
            elseif($_SESSION['number'.$x][$z]==" _ " && $_SESSION['number'.$x][$z+1]==" _|" && $_SESSION['number'.$x][$z+2]=="|_ " ) {
                $returnString.="2";
            }

            //recognize 3
            elseif($_SESSION['number'.$x][$z]==" _ " && $_SESSION['number'.$x][$z+1]==" _|" && $_SESSION['number'.$x][$z+2]==" _|") {
                $returnString.="3";
            }

            //recognize 4
            elseif($_SESSION['number'.$x][$z]=="   " && $_SESSION['number'.$x][$z+1]=="|_|" && $_SESSION['number'.$x][$z+2]=="  |") {
                $returnString.="4";
            }

            //recognize 5
            elseif($_SESSION['number'.$x][$z]==" _ " && $_SESSION['number'.$x][$z+1]=="|_ " && $_SESSION['number'.$x][$z+2]==" _|") {
                $returnString.="5";
            }

            //recognize 6
            elseif($_SESSION['number'.$x][$z]==" _ " && $_SESSION['number'.$x][$z+1]=="|_ " && $_SESSION['number'.$x][$z+2]=="|_|") {
                $returnString.="6";
            }

            //recognize 7
            elseif($_SESSION['number'.$x][$z]==" _ " && $_SESSION['number'.$x][$z+1]=="  |" && $_SESSION['number'.$x][$z+2]=="  |") {
                $returnString.="7";
            }

            //recognize 8
            elseif($_SESSION['number'.$x][$z]==" _ " && $_SESSION['number'.$x][$z+1]=="|_|" && $_SESSION['number'.$x][$z+2]=="|_|") {
                $returnString.="8";
            }

            //recognize 9
            elseif($_SESSION['number'.$x][$z]==" _ " && $_SESSION['number'.$x][$z+1]=="|_|" && $_SESSION['number'.$x][$z+2]==" _|") {
                $returnString.="9";
            }

            else {
                $returnString.="?";
            }
        } //end x
    }//end z
    
    return $returnString;
}