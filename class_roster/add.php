<?php

include ("../init.php");
use Models\ClassRoster;
use Models\ClassRecord;
use Models\Student;


$id = $_GET['id'];

$classes = new ClassRecord('','','','','','');
	$classes->setConnection($connection);
	$classes->getById($id);
	$class_code= $classes -> getClassCode();
	$all_classes = $classes->showClassesRosters($id);

	$student= new Student('', '', '', '', '', '');
	$student->setConnection($connection);
	$all_students = $student->showAllStudents();
	


// $code = $_GET['code'];

// $student= new Student('', '', '', '', '', '');
// $student->setConnection($connection);
// $all_students = $student->showAllStudents();


 $template = $mustache->loadTemplate('classroster/add.mustache');
 echo $template->render(compact('all_classes', 'all_students', 'class_code'));






?>