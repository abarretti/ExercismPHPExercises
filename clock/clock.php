<?php

class Clock
{

    private $hoursMinutesArray;

    public function __construct($hours, $minutes=0)
    {
        $this->hoursMinutesArray= $this->conversion($hours, $minutes);
    }

    public function conversion($hours, $minutes)
    {
        $hourDeduction=0;
        while($minutes<0)
        {
            $minutes=60-(-$minutes);
            $hourDeduction=$hourDeduction+1;
        }
        $hours=$hours-$hourDeduction;
        
        while($hours<0)
        {
            $hours=24-(-$hours);
        }

        $hoursMinutesArray= array();
        $totalMinutes= ($hours*60)+$minutes;

        $hoursOnly= floor($totalMinutes/60);
        if($hoursOnly>=24)
        {  
            while($hoursOnly>=24)
            {
                $hoursOnly=$hoursOnly-24;
            }
        }
        $hoursMinutesArray['hoursOnly']=$hoursOnly;

        $minutesOnly= $totalMinutes%60;
        $hoursMinutesArray['minutesOnly']=$minutesOnly;

        if(isset($this->hoursMinutesArray))
        {
           $this->hoursMinutesArray['hoursOnly']= $hoursMinutesArray['hoursOnly'];
           $this->hoursMinutesArray['minutesOnly']= $hoursMinutesArray['minutesOnly'];
        }
        return $hoursMinutesArray;
    }

    public function __toString()
    {
        if(strlen((string)$this->hoursMinutesArray['hoursOnly'])==1)
        {
            $hoursString= '0'.(string)$this->hoursMinutesArray['hoursOnly'];
        }
        else
        {
            $hoursString=(string)$this->hoursMinutesArray['hoursOnly'];
        }

        if(strlen((string)$this->hoursMinutesArray['minutesOnly'])==1)
        {
            $minutesString= '0'.(string)$this->hoursMinutesArray['minutesOnly'];
        }
        else
        {
            $minutesString=(string)$this->hoursMinutesArray['minutesOnly'];
        }

        return $hoursString.':'.$minutesString;    
    }

    public function add($minutes)
    {
        if($minutes<0)
        {
            return $this->sub(-$minutes);
        }

        $hoursToAdd=floor($minutes/60);
        $minutesToAdd=$minutes%60;

        while($this->hoursMinutesArray['minutesOnly']+$minutesToAdd>=60)
        {
            $hoursToAdd=$hoursToAdd+1;
            $minutesToAdd=$minutesToAdd-60;
        }

        $this->hoursMinutesArray['hoursOnly']= $this->hoursMinutesArray['hoursOnly']+$hoursToAdd;
        $this->hoursMinutesArray['minutesOnly']= $this->hoursMinutesArray['minutesOnly']+$minutesToAdd;
        $this->conversion($this->hoursMinutesArray['hoursOnly'], $this->hoursMinutesArray['minutesOnly']);
        return $this;
    }

    public function sub($minutes)
    {
        $totalMinutes=$this->hoursMinutesArray['hoursOnly']*60+$this->hoursMinutesArray['minutesOnly'];

        if($totalMinutes-$minutes<0)
        {
            $hoursOnly= floor(-($this->hoursMinutesArray['hoursOnly']-($minutes/60)));
            if($hoursOnly>=24)
            {  
                while($hoursOnly>=24)
                {
                    $hoursOnly=$hoursOnly-24;
                }
            }

            else
            {
                $hoursOnly=24-$hoursOnly;
            }

            $minutesOnly= $this->hoursMinutesArray['minutesOnly']-$minutes%60;
            $totalMinutes= $totalMinutes-(60*$hoursOnly)-$minutesOnly;

            if($totalMinutes<0)
            {
                $totalMinutes= 1380+abs($totalMinutes);
            }
        }

        else
        {
            $totalMinutes=$totalMinutes-$minutes;
            $hoursOnly= floor($totalMinutes/60);
            $minutesOnly= $totalMinutes%60;
        }

        $this->conversion($hoursOnly, $minutesOnly);

        return $this;
    }
}