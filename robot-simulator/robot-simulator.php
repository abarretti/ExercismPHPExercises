<?php

class Robot 
{
    const DIRECTION_NORTH='north';
    const DIRECTION_SOUTH='south';
    const DIRECTION_EAST='east';
    const DIRECTION_WEST='west';

    public $position;
    public $direction;

    public function __construct(array $position, string $direction) {
        $this->position=$position;
        $this->direction=$direction;
    }

    public function turnRight() {
        if ($this->direction==self::DIRECTION_NORTH) {
            $this->direction=self::DIRECTION_EAST;
        }
        elseif ($this->direction==self::DIRECTION_EAST) {
            $this->direction=self::DIRECTION_SOUTH;
        }
        elseif ($this->direction==self::DIRECTION_SOUTH) {
            $this->direction=self::DIRECTION_WEST;
        }
        elseif ($this->direction==self::DIRECTION_WEST) {
            $this->direction=self::DIRECTION_NORTH;
        }
        return $this;
    }

    public function turnLeft() {
        if ($this->direction==self::DIRECTION_NORTH) {
            $this->direction=self::DIRECTION_WEST;
        }
        elseif ($this->direction==self::DIRECTION_WEST) {
            $this->direction=self::DIRECTION_SOUTH;
        }
        elseif ($this->direction==self::DIRECTION_SOUTH) {
            $this->direction=self::DIRECTION_EAST;
        }
        elseif ($this->direction==self::DIRECTION_EAST) {
            $this->direction=self::DIRECTION_NORTH;
        }
        return $this;
    }

    public function advance() {
        if ($this->direction==self::DIRECTION_NORTH) {
            $this->position[1]=$this->position[1]+1;
        }
        elseif ($this->direction==self::DIRECTION_WEST) {
            $this->position[0]=$this->position[0]-1;
        }
        elseif ($this->direction==self::DIRECTION_SOUTH) {
            $this->position[1]=$this->position[1]-1;
        }
        elseif ($this->direction==self::DIRECTION_EAST) {
            $this->position[0]=$this->position[0]+1;
        }
        return $this;
    }

    public function instructions(string $instructions) {
        if(preg_match('/[^LRA]/',$instructions)) {
            throw new InvalidArgumentException('Instructions are invalid!');
        }
        else {
            $instructionsArray= str_split($instructions);
            foreach($instructionsArray as $instruction) {
                if($instruction=='R') {
                    $this->turnRight();
                }
                elseif($instruction=='L') {
                    $this->turnLeft();
                }
                elseif($instruction=='A') {
                    $this->advance();
                }
            }
        }
    }
}