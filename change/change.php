<?php

function findFewestCoins(array $coins, $change)
{

    //Error Handling
    if($change==0)
    {
        return array();
    }
    
    $smallestCoin= min($coins);
    if($change<$smallestCoin)
    {
        throw new InvalidArgumentException('No coins small enough to make change');
    }

    if($change<0)
    {
        throw new InvalidArgumentException('Cannot make change for negative value');
    }
    //Error Handling END

    $coinsReverse= array_reverse($coins);
    $remainingChange=$change;
    $coinOfFirstLoop=[];
    $masterCoinArray=[];

    for($x=1;$x<=count($coins);$x++)
    {
        $coinArray=[];
        $loopCounter=0;
        foreach($coinsReverse as $coin)
        {
            while(($remainingChange/$coin)>=1 && $remainingChange>0 && !in_array($coin,$coinOfFirstLoop))
            {
                $loopCounter=$loopCounter+1;
            
                if($loopCounter==1)
                {
                    $coinToAdd=$coin;
                }
            
                array_push($coinArray,$coin);
                $remainingChange= $remainingChange-$coin;
            }

            if(isset($coinToAdd))
            {
                array_push($coinOfFirstLoop,$coinToAdd);            
            }
        }
        $coinToAdd=NULL;
        $remainingChange=$change;
        array_push($masterCoinArray, array_reverse($coinArray));
    }

    $smallestNumberofCoins=NULL;
    foreach($masterCoinArray as $array)
    {
        if(($smallestNumberofCoins==NULL || count($array)<count($smallestNumberofCoins)) && count($array)>0)
        {
            $smallestNumberofCoins=$array;
        }
    }

    return $smallestNumberofCoins;
}