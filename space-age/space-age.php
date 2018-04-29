<?php

class SpaceAge
{
    private $seconds;
    private $earthYearSeconds=31557600;
    private $conversionArray=['Mercury' => 0.2408467,
    'Venus' => 0.61519726,
    'Mars' => 1.8808158,
    'Jupiter' => 11.862615,
    'Saturn' => 29.447498,
    'Uranus' => 84.016846,
    'Neptune' => 164.79132];

    public function __construct($seconds) {
        $this->seconds=$seconds;
    }

    public function seconds() {
        return $this->seconds;
    }

    public function earth() {
        $years=$this->seconds/$this->earthYearSeconds;
        return round($years,2);
    }

    public function mercury() {
        $years=$this->seconds/($this->conversionArray['Mercury']*$this->earthYearSeconds);
        return round($years,2);
    }

    public function venus() {
        $years=$this->seconds/($this->conversionArray['Venus']*$this->earthYearSeconds);
        return round($years,2);
    }

    public function mars() {
        $years=$this->seconds/($this->conversionArray['Mars']*$this->earthYearSeconds);
        return round($years,2);
    }

    public function jupiter() {
        $years=$this->seconds/($this->conversionArray['Jupiter']*$this->earthYearSeconds);
        return round($years,2);
    }

    public function saturn() {
        $years=$this->seconds/($this->conversionArray['Saturn']*$this->earthYearSeconds);
        return round($years,2);
    }

    public function uranus() {
        $years=$this->seconds/($this->conversionArray['Uranus']*$this->earthYearSeconds);
        return round($years,2);
    }

    public function neptune() {
        $years=$this->seconds/($this->conversionArray['Neptune']*$this->earthYearSeconds);
        return round($years,2);
    }
}