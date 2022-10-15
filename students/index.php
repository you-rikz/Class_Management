<?php

include ("../init.php");
use Models\Student;

$student= new Student('', '', '', '', '', '');
$student->setConnection($connection);
$all_students = $student->showAllStudents();
var_dump($all_students);