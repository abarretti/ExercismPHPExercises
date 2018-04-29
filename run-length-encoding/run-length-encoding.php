<?php

//
// This is only a SKELETON file for the "Run Length Encoding" exercise. It's been provided as a
// convenience to get you started writing code faster.
//

function encode($input)
{
    $encoderString="";
    $current="";
    $count=0;

    for($x=0;$x<strlen($input);$x++)
    {
        if ($current=="") 
        {
            $current= $input[$x];
            $count= $count+1;
        }

        elseif ($input[$x]==$current)
        {
            $count=$count+1;
        }
        
        else
        {
            if($count==1)
            {
                $encoderString.=$current;
            }
            else
            {
                $encoderString.=$count.$current;
            }
            $current=$input[$x];
            $count=1;
        }

        if($x==strlen($input)-1)
        {
            if($count==1)
            {
                $encoderString.=$current;
            }
            else
            {
                $encoderString.=$count.$current;
            }
        }
    }

    return $encoderString;
}

function decode($input)
{
    $count="";
    $decodedString="";
    for($x=0;$x<strlen($input);$x++)
    {
        if(preg_match('/[a-zA-Z ]/', $input[$x]))
        {
            if($count=="")
            {
                $decodedString.=$input[$x];
            }
            else
            {
                for($y=1;$y<=(int)$count;$y++)
                {
                    $decodedString.=$input[$x];
                }
                $count="";
            }
        }

        else
        {
            $count.=$input[$x];
        }
    }
    return $decodedString;
}
