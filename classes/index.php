<?php

include ("../init.php");
use Models\ClassRecord;

$classes= new ClassRecord('', '', '', '', '', '');
$classes->setConnection($connection);
$all_classes = $class->showAllClasses();
var_dump($all_classes);