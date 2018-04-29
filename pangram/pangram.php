<?php

function isPangram($string)
{
    if(preg_match('/[aA]/', $string) AND
    preg_match('/[bB]/', $string) AND
    preg_match('/[cC]/', $string) AND
    preg_match('/[dD]/', $string) AND
    preg_match('/[eE]/', $string) AND
    preg_match('/[fF]/', $string) AND
    preg_match('/[gG]/', $string) AND
    preg_match('/[hH]/', $string) AND
    preg_match('/[iI]/', $string) AND
    preg_match('/[jJ]/', $string) AND
    preg_match('/[kK]/', $string) AND
    preg_match('/[lL]/', $string) AND
    preg_match('/[mM]/', $string) AND
    preg_match('/[nN]/', $string) AND
    preg_match('/[oO]/', $string) AND
    preg_match('/[pP]/', $string) AND
    preg_match('/[qQ]/', $string) AND
    preg_match('/[rR]/', $string) AND
    preg_match('/[sS]/', $string) AND
    preg_match('/[tT]/', $string) AND
    preg_match('/[uU]/', $string) AND
    preg_match('/[vV]/', $string) AND
    preg_match('/[wW]/', $string) AND
    preg_match('/[xX]/', $string) AND
    preg_match('/[yY]/', $string) AND
    preg_match('/[zZ]/', $string))
    {
        return true;
    }    
    else
    {
        return false;
    }
}