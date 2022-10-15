<?php

include ("../init.php");
use Models\ClassRoster;

$classes_rosters= new ClassRoster('', '', '', '', '', '');
$classes_rosters->setConnection($connection);
$all_classes_rosters = $class->showClassesRosters();
var_dump($all_classes_rosters);