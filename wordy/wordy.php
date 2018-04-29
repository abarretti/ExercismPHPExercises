<?php

function calculate($string)
{
    $string= str_replace("?", "", $string);
    $stringArray= explode(" ", $string);
    
    $equationArray=[];
    //Create Equation Array
    for($x=2;$x<count($stringArray);$x++)
    {
        if($stringArray[$x]=='by')
        {
            continue;
        }

        elseif(preg_match("/[0-9]/",$stringArray[$x]))
        {
            array_push($equationArray, (int)$stringArray[$x]);
        }

        elseif($stringArray[$x]=='plus' || $stringArray[$x]=='minus' || $stringArray[$x]=='multiplied' || $stringArray[$x]=='divided')
        {
            if($stringArray[$x]=='plus' || $stringArray[$x]=='minus')
            {
                array_push($equationArray, $stringArray[$x]);
            }

            elseif($stringArray[$x]=='multiplied' || $stringArray[$x]=='divided')
            {
                array_push($equationArray, $stringArray[$x]);
            }
        }

        else
        {
            throw new InvalidArgumentException('Not a valid string!');
        }
    }
    
    //Build and return equation
    $equationValue=NULL;
    $operatorHold=NULL;
    foreach($equationArray as $n)
    {
        if(is_int($n))
        {
            if($equationValue==NULL)
            {
                $equationValue=$n;
            }

            else
            {
                if($operatorHold=="plus")
                {
                    $equationValue=$equationValue+$n;
                }
                elseif($operatorHold=="minus")
                {
                    $equationValue=$equationValue-$n;
                }
                elseif($operatorHold=="multiplied")
                {
                    $equationValue=$equationValue*$n;
                }
                else
                {
                    $equationValue=$equationValue/$n;
                }
            }
        }
        else
        {
            $operatorHold=$n;
        }
    }
    return $equationValue;
}
