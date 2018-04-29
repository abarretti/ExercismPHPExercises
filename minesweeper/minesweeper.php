<?php

function solve($board)
{
    $boardArray=str_split($board);
    $length=0;
    $height=0;
    $cornerCount=0;
    $lastCell=NULL;
    $rowValidator=0;

    
//Validates Board
    if($boardArray[0] != "\n")
    {
        throw new InvalidArgumentException('Board is not valid');
    }
    if($boardArray[1] != "+")
    {
        throw new InvalidArgumentException('Board is not valid');
    }
    
    foreach($boardArray as $cell)
    {
        if($rowValidator!=0)
        {
            if(!preg_match("/[ *1-9]/", $cell))
            {
                throw new InvalidArgumentException('Value in board is not valid');
            }
            else
            {
                $rowValidator=$rowValidator-1;
            }
        }

        if($lastCell=="+" && ($cornerCount==1 || $cornerCount==3) && $cell!="-")
        {
            throw new InvalidArgumentException('Board is not valid');
        }

        if($lastCell=="+" && ($cornerCount==2 || $cornerCount==4) && $cell!="\n")
        {
            throw new InvalidArgumentException('Board is not valid');
        }

        if($lastCell=="\n" && $cornerCount==2 && !preg_match("/[|+]/", $cell))
        {
            throw new InvalidArgumentException('Board is not valid');
        }
        
        //calculates length of board
        if($cell=="-" && $cornerCount==1 && ($lastCell=="+" || $lastCell=="-"))
        {
            $length=$length+1;
        }

        if($cell=="|" && $lastCell=="\n")
        {
            $height=$height+1;
            $rowValidator=$length;
        }

        //identifies 4 corners of the board
        if($cell=="+")
        {
            $cornerCount=$cornerCount+1;
        }

        $lastCell=$cell;
    }

    if($length*$height<2)
    {
        throw new InvalidArgumentException('Board does not contain atleast 2 spaces');
    }
//End Board Validation
    
//Parse Board
    $cellContentsArray=[];
    $rowCoordinate=0;
    $columnCoordinate=0;
    $lastCell=NULL;

    foreach($boardArray as $cell)
    {
        if($cell=="|" && $lastCell=="\n")
        {
            $rowValidator=$length;
            $rowCoordinate=$rowCoordinate+1;
        }

        elseif($cell=="|" && preg_match("/[ *1-9]/", $lastCell))
        {
            $columnCoordinate=0;
        }
        
        elseif($rowValidator!=0)
        {
            $columnCoordinate=$columnCoordinate+1;
            $cellContentsArray[(string)$rowCoordinate."-".(string)$columnCoordinate]=$cell;
            $rowValidator=$rowValidator-1;
        }

        $lastCell=$cell;
    }

    //find mines and replace empty spaces with number of touching mines
    foreach($cellContentsArray as $key=>$value)
    {
        if($value==" ")
        {
            $rowKey=(int)$key[0];
            $columnKey=(int)$key[2];
            $rowInt= -1;
            $columnInt= -1;
            $counter=0;
            for($x=1;$x<=8;$x++)
            {
                if(array_key_exists((string)($rowKey+$rowInt)."-".(string)($columnKey+$columnInt), $cellContentsArray))
                {
                    if($cellContentsArray[(string)($rowKey+$rowInt)."-".(string)($columnKey+$columnInt)]=="*")
                    {
                        $counter=$counter+1;
                        $cellContentsArray[$key]=$counter;
                    }
                }

                if($x<=2 || $x>=6)
                {
                    $columnInt=$columnInt+1;
                }
                elseif($x==3 || $x==5)
                {
                    $rowInt=$rowInt+1;
                    $columnInt= -1;
                }
                elseif($x==4)
                {
                    $columnInt=$columnInt+2;
                }
            }
        }
    }
//parse finish

//replaces keys in cellContentsArray with indexes
$index=0;
foreach($cellContentsArray as $key=>$value)
{
    $cellContentsArray[$index]=$cellContentsArray[$key];
    unset($cellContentsArray[$key]);
    $index=$index+1;
}

//replace empty spaces on board with number of touching mines
    $rowValidator=0;
    $index=0;
    $lastCell=NULL;

    foreach($boardArray as &$cell)
    {
        if($cell=="|" && $lastCell=="\n")
        {
            $rowValidator=$length;
        }
        
        elseif($rowValidator!=0)
        {
            $cell=(string)$cellContentsArray[$index];
            $rowValidator=$rowValidator-1;
            $index=$index+1;
        }
        $lastCell=$cell;
    }

//returns new board
    return implode("",$boardArray);
}