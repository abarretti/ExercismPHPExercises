<?php

function nucleotideCount($dNASequence)
{
    $dNAArray=array('a'=>0,'c'=>0,'t'=>0,'g'=>0);

    $dNASequenceArray=str_split(strtolower($dNASequence));
    foreach($dNASequenceArray as $dNA)
    {
        if(array_key_exists($dNA,$dNAArray))
        {
            $dNAArray[$dNA]= $dNAArray[$dNA]+1;
        }
    }
    return $dNAArray;
}