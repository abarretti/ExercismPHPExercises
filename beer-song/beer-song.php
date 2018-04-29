<?php

class BeerSong
{
    public $lyricsByVerse;

    public function __construct()
    {
        $this->lyricsByVerse=$this->create();
    }

    public function create()
    {
        $lyricsByVerse=[];

        for($x=99;$x>=0;$x--)
        {
            if($x>2)
            {
                $lyricsByVerse[$x]= $x." bottles of beer on the wall, ".$x." bottles of beer.\n".
                "Take one down and pass it around, ".($x-1)." bottles of beer on the wall.\n";
            }
            elseif($x==2)
            {
                $lyricsByVerse[$x]= $x." bottles of beer on the wall, ".$x." bottles of beer.\n".
                "Take one down and pass it around, ".($x-1)." bottle of beer on the wall.\n";
            }
            elseif($x==1)
            {
                $lyricsByVerse[$x]= $x." bottle of beer on the wall, ".$x." bottle of beer.\n".
                "Take it down and pass it around, no more bottles of beer on the wall.\n";
            }
            elseif($x==0)
            {
                $lyricsByVerse[$x]="No more bottles of beer on the wall, no more bottles of beer.\n".
                "Go to the store and buy some more, 99 bottles of beer on the wall.";
            }
        }
        return $lyricsByVerse;
    }

    public function verse($startVerse)
    {
        return $this->lyricsByVerse[$startVerse];
    }

    public function verses($startVerse, $endVerse)
    {
        $selectVerses="";

        for($x=$startVerse;$x>=$endVerse;$x--)
        {
            if($x==$endVerse)
            {
                $selectVerses.=$this->lyricsByVerse[$x];
            }
            else
            {
                $selectVerses.=$this->lyricsByVerse[$x]."\n";
            }
        }
        return $selectVerses;
    }

    public function lyrics()
    {
        $songLyrics="";
        foreach($this->lyricsByVerse as $verse)
        {
            $songLyrics.= $verse."\n";
        }
        return substr($songLyrics,0,strlen($songLyrics)-1);
    }
}