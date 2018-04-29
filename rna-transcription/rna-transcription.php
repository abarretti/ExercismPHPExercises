<?php

function toRna($DNA)
{
    $RNA="";
    for($x=0;$x<strlen($DNA);$x++)
    {
        switch($DNA[$x])
        {
            case 'G':
                $RNA.="C";
                break;
            case 'C':
                $RNA.="G";
                break;
            case 'T':
                $RNA.="A";
                break;
            case 'A':
                $RNA.="U";
                break;
        }
    }
    return $RNA;
}