<?php

class Game
{
    private $score;
    private $lastRoll;
    private $throwCount;
    public $frameThrow;
    public $frameCount;
    public $totalThrows;
    public $markedThrows;

    public function __construct()
    {
        $this->score=0;
        $this->lastRoll=NULL;
        $this->throwCount=0;
        $this->frameThrow=1;
        $this->frameCount=1;
        $this->totalThrows= array();
        $this->markedThrows= array();
    }

    public function roll($pins)
    {
        //EXCEPTIONS
        if ($pins<0 || $pins>10)
        {
            throw new InvalidArgumentException('Invalid throw. You can only hit between 0 - 10 pins.');
        }

        if ($this->frameThrow==2 && $pins+$this->lastRoll>10 && $this->frameCount>=1 && $this->frameCount<=9)
        {
            throw new InvalidArgumentException('Invalid throw. You can only hit a maximum of 10 pins in a frame.');
        }

        if ($this->frameCount==10 && $this->frameThrow==3 && $this->lastRoll!=10 && $pins+$this->lastRoll>10)
        {
            throw new InvalidArgumentException('Invalid throw. You can only hit a maximum of 10 pins in a frame.');
        }

        if ($this->frameThrow=='END')
        {
            throw new InvalidArgumentException('The game is over! You cannot roll again');
        }

        //ROLL START
        $this->throwCount= $this->throwCount+1;
        
        //10th frame rolls only
        if($this->frameCount==10)
        {
            //strike
            if($pins==10)
            {
                $this->totalThrows[$this->throwCount]=10;
                
                if($this->frameThrow==1)
                {
                    $this->markedThrows[$this->throwCount]='strike';
                }

                if($this->frameThrow==2 || $this->frameThrow==3)
                {
                    $this->markedThrows[$this->throwCount]='remove';
                }

                $this->frameThrow= $this->frameThrow+1;
                
                if($this->frameThrow>3)
                {
                    $this->frameThrow='END';
                }
    
                $this->lastRoll=10;
            }

            //spare
            elseif($this->frameThrow==2 && $pins+$this->lastRoll==10)
            {
                $this->totalThrows[$this->throwCount]=$pins;
                $this->markedThrows[$this->throwCount]='spare';
                $this->frameThrow=3;
                $this->lastRoll=NULL;
            }

            //miss on extra shot
            elseif($this->frameThrow==3 && $pins<10)
            {
                $this->totalThrows[$this->throwCount]=$pins;
                $this->markedThrows[$this->throwCount]='remove';
                $this->lastRoll=$pins;
                $this->frameThrow='END';
            }

            //open frame
            elseif($this->frameThrow==2 && $pins+$this->lastRoll<10 && $this->lastRoll!=10)
            {
                $this->totalThrows[$this->throwCount]=$pins;
                $this->frameThrow='END';
                $this->lastRoll=NULL;
            }

            //open 2nd shot after strike
            elseif($this->frameThrow==2 && $pins<10 && $this->lastRoll==10)
            {
                $this->totalThrows[$this->throwCount]=$pins;
                $this->markedThrows[$this->throwCount]='remove';
                $this->frameThrow=3;
                $this->lastRoll=$pins;
            }

            //first throw miss
            elseif($this->frameThrow==1 && $pins<10)
            {
                $this->totalThrows[$this->throwCount]=$pins;
                $this->lastRoll=$pins;
                $this->frameThrow=2;
            }

            //second throw miss
            else
            {
                $this->totalThrows[$this->throwCount]=$pins;
                $this->lastRoll=NULL;
                $this->frameThrow='END';
            }
        }

        //FRAMES 1 - 9 ROLLS
        //strike
        else
        {
            if($pins==10 && $this->frameThrow==1)
            {
                $this->totalThrows[$this->throwCount]=10;
                $this->markedThrows[$this->throwCount]='strike';
                $this->frameThrow=1;
                $this->lastRoll=NULL;
                $this->frameCount= $this->frameCount+1;
            }

            //spare
            elseif($this->frameThrow==2 && $pins+$this->lastRoll==10)
            {
                $this->totalThrows[$this->throwCount]=$pins;
                $this->markedThrows[$this->throwCount]='spare';
                $this->frameThrow=1;
                $this->lastRoll=NULL;
                $this->frameCount= $this->frameCount+1;
            }

            //open frame
            elseif($this->frameThrow==2 && $pins+$this->lastRoll<10)
            {
                $this->totalThrows[$this->throwCount]=$pins;
                $this->frameThrow=1;
                $this->lastRoll=NULL;
                $this->frameCount= $this->frameCount+1;
            }

            //first throw miss
            elseif($this->frameThrow==1 && $pins<10)
            {
                $this->totalThrows[$this->throwCount]=$pins;
                $this->lastRoll=$pins;
                $this->frameThrow=2;
            }

            //second throw miss
            else
            {
                $this->totalThrows[$this->throwCount]=$pins;
                $this->lastRoll=NULL;
                $this->frameThrow=1;
                $this->frameCount= $this->frameCount+1;
            }
        }
    }

    public function score()
    {
        if ($this->frameThrow!='END')
        {
            throw new InvalidArgumentException('Game is incomplete and cannot be scored.');
        }
        
        $totalScore=0;
        $throwCount= count($this->totalThrows);

        for($x=1;$x<=$throwCount;$x++)
        {
            if(array_key_exists($x, $this->markedThrows))
            {
                if($this->markedThrows[$x]=='strike')
                {
                    $totalScore= $totalScore+$this->totalThrows[$x]+$this->totalThrows[$x+1]+$this->totalThrows[$x+2];
                }
                elseif($this->markedThrows[$x]=='spare')
                {
                    $totalScore= $totalScore+$this->totalThrows[$x]+$this->totalThrows[$x+1];
                }
                else
                {
                    continue;
                }
            } 
            
            else
            {
                $totalScore= $totalScore+$this->totalThrows[$x];
            }
        }
        return $totalScore;
    }
}
