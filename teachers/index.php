<?php

include ("../init.php");
use Models\Teacher;

$teacher= new Teacher('', '', '', '', '', '');
$teacher->setConnection($connection);
$all_teachers = $teacher->addTeacher();
var_dump($all_teachers);

?>