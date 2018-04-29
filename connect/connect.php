<?php

function resultFor($array)
{
    //assigns coordinates for each spot on the board with value
    $rows=0;
    $columns=0;
    $boardArray=[];
    foreach($array as $line)
    {
        $rows=$rows+1;
        $lineLength= strlen($line);
        $columns=$lineLength;
        for($x=0;$x<$lineLength;$x++)
        {
            $boardArray[(string)$rows.'-'.(string)($x+1)]=$line[$x];
        }
    }

    //searches the board to determine which spaces have X
    $spacesWithX=[];
    for($y=1;$y<=$columns;$y++)
    {
        foreach($boardArray as $key=>$value)
        {
            if($key[-1]==(string)$y && $value=='X')
            {
                array_push($spacesWithX,$key);
            }
        }
    }

    //searches the board to determine which spaces have O
    $spacesWithO=[];
    for($y=1;$y<=$columns;$y++)
    {
        foreach($boardArray as $key=>$value)
        {
            if($key[-1]==(string)$y && $value=='O')
            {
                array_push($spacesWithO,$key);
            }
        }
    }

    //Winner Variable
    $winner=NULL;

    //parses the board to determine if X has won
    $requiredSpacesInCurrentColumn=[];
    $requiredSpacesInNextColumn=[];
    for($columnCount=1;$columnCount<=$columns;$columnCount++)
    {
        foreach($spacesWithX as $space)
        {
            if($space[-1]==(string)$columnCount)
            {
                if (in_array($space,$requiredSpacesInCurrentColumn) || $columnCount==1)
                {
                    if($columnCount==$columns)
                    {
                        $winner="black";
                        break;
                    }
                    array_push($requiredSpacesInNextColumn, (string)((int)$space[0]-1)."-".(string)((int)$space[2]+1),(string)$space[0]."-".(string)((int)$space[2]+1),(string)((int)$space[0]+1)."-".(string)((int)$space[2]+1));
                }

            }    
        }
        
        if(empty($requiredSpacesInNextColumn))
        {
            break;
        }
        else
        {
            $requiredSpacesInCurrentColumn=$requiredSpacesInNextColumn;
            $requiredSpacesInNextColumn=[];
        }
    }

    //parses the board to determine if 0 has won
    $requiredSpacesInCurrentRow=[];
    $requiredSpacesInNextRow=[];
    for($rowCount=1;$rowCount<=$rows;$rowCount++)
    {
        foreach($spacesWithO as $space)
        {
            if($space[0]==(string)$rowCount)
            {
                if (in_array($space,$requiredSpacesInCurrentRow) || $rowCount==1)
                {
                    if($rowCount==$rows)
                    {
                        $winner="white";
                        break;
                    }
                    array_push($requiredSpacesInNextRow, (string)((int)$space[0]+1)."-".(string)((int)$space[2]-1),(string)((int)$space[0]+1)."-".(string)$space[2],(string)((int)$space[0]+1)."-".(string)((int)$space[2]+1));
                }
            }    
        }
        
        if(empty($requiredSpacesInNextRow))
        {
            break;
        }
        else
        {
            $requiredSpacesInCurrentRow=$requiredSpacesInNextRow;
            $requiredSpacesInNextRow=[];
        }
    }
    return $winner;
}