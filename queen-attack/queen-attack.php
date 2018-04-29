<?php

function placeQueen(int $row, int $column) {
  
  if($row<0 || $column<0) {
   throw new InvalidArgumentException('The rank and file numbers must be positive.');
  }
  
  if($row>7 || $column>7) {
    throw new InvalidArgumentException('The position must be on a standard size chess board.'); 
  }

  return TRUE;
}

function canAttack(array $queen1Position, array $queen2Position) {

    $attackingPositions=[];

    //insert all positions in the same row and column as the 1st queen
    for($y=0;$y<=7;$y++) {
        if([$queen1Position[0],$y] != $queen1Position)
        array_push($attackingPositions,[$queen1Position[0],$y]);
    }
    for($x=0;$x<=7;$x++) {
        if([$x,$queen1Position[1]] != $queen1Position)
        array_push($attackingPositions,[$x,$queen1Position[1]]);
    }

    //insert all positions diagonal to the 1st queen
    $z=1;
    while($queen1Position[0]-$z>=0 && $queen1Position[1]-$z>=0) {
      array_push($attackingPositions,[$queen1Position[0]-$z,$queen1Position[1]-$z]);
      $z=$z+1;
    }
    $z=1;
    while($queen1Position[0]+$z<=7 && $queen1Position[1]+$z<=7) {
      array_push($attackingPositions,[$queen1Position[0]+$z,$queen1Position[1]+$z]);
      $z=$z+1;
    }
    $z=1;
    while($queen1Position[0]+$z<=7 && $queen1Position[1]-$z>=0) {
      array_push($attackingPositions,[$queen1Position[0]+$z,$queen1Position[1]-$z]);
      $z=$z+1;
    }
    $z=1;
    while($queen1Position[0]-$z>=0 && $queen1Position[1]+$z<=7) {
      array_push($attackingPositions,[$queen1Position[0]-$z,$queen1Position[1]+$z]);
      $z=$z+1;
    }

    if(in_array($queen2Position,$attackingPositions)) {
      return TRUE;
    }

    else {
      return FALSE;
    }
}