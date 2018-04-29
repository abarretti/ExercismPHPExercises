<?php

class MasterNameRepository
{
    public $masterNameRepository= array("");

}

class Robot extends MasterNameRepository
{
    private $name;

    public function __construct()
    {
        $this->masterNameRepository;
        $this->name= $this->createName();

    }

    public function createName()
    {
        $robotName="";
        while(in_array($robotName,$this->masterNameRepository))
        {
            $alphabet= array("A","B","C","D","E","F","G","H","I","J","K","L","M","N","O","P","Q","R","S","T","U","V","W","X","Y","Z");
            $randomLetters= array_rand($alphabet,2);
            $robotName.=$alphabet[$randomLetters[0]].$alphabet[$randomLetters[1]];

            $digits= array(0,1,2,3,4,5,6,7,8,9);
            $randomDigits= array_rand($digits,3);
            $robotName.=$digits[(string)$randomDigits[0]].$digits[(string)$randomDigits[1]].$digits[(string)$randomDigits[2]];
        }

        array_push($this->masterNameRepository, $robotName);
        return $robotName;
    }

    public function getName()
    {
        return $this->name;
    }

    public function reset()
    {
        $this->name= $this->createName();
    }
}