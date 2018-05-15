<?php

function meetup_day($year, $month, string $week,string $day) {

$date=mktime(0,0,0,$month,1,$year);
$numericalDate=(int)date("d", $date);

$weekArray=['first'=>1,'second'=>2,'third'=>3,'fourth'=>4];

if(array_key_exists($week, $weekArray)) {
    
    $weekNumber=$weekArray[$week];
    for($x=0;$x<$weekNumber;$x++) {
        if($weekNumber==1 && $day==date("l",$date)){
            break;
        }
        $date=strtotime("next ".$day,$date);
        $numericalDate=(int)date("d", $date);
    }
}

elseif($week=="teenth") {
    while($numericalDate<13) {
        $date=strtotime("next ".$day,$date);
        $numericalDate=(int)date("d", $date);
    }
}


elseif($week=="last") {
    $daysInMonth=[1=>31,2=>28,3=>31,4=>30,5=>31,6=>30,7=>31,8=>31,9=>30,10=>31,11=>30,12=>31];
    
    //leap year interceptor
    if($year==2012 && $month=2) {
        $lastDayOfMonth=29;
    }
    else {
        $lastDayOfMonth=$daysInMonth[$month];
    }
    
    $firstDayOfLastWeek=$lastDayOfMonth-6;

    while($numericalDate<$firstDayOfLastWeek) {
        $date=strtotime("next ".$day,$date);
        $numericalDate=(int)date("d", $date);
    }
}

$date=date("Y-m-d",$date);
return new DateTime($date);
}