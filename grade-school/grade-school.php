<?php

class School 
{
    private $studentRoster= array();

    public function __construct() {

    }

    public function numberOfStudents() {
        return count($this->studentRoster);
    }

    public function add(string $studentName, int $grade) {
        $this->studentRoster[$studentName]= $grade;
    }

    public function grade(int $gradeOfStudents) {
        $studentGradeArray=[];
        foreach($this->studentRoster as $student=>$grade) {
            if($gradeOfStudents==$grade) {
                array_push($studentGradeArray,$student);
            }
        }
        return $studentGradeArray;
    }

    public function studentsByGradeAlphabetical() {
        $sortedStudentsArray=array();
        foreach($this->studentRoster as $student=>$grade) {
            if(array_key_exists($grade,$sortedStudentsArray)) {
                array_push($sortedStudentsArray[$grade],$student);
            }
            else {
                $sortedStudentsArray[$grade]=[$student];
            }
        }
        
        ksort($sortedStudentsArray);
        foreach($sortedStudentsArray as $grade=>&$students) {
            sort($students);
        }
        return $sortedStudentsArray;
    }

}