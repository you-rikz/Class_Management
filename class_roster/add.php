<?php

include ("../init.php");
use Models\ClassRoster;
use Models\Classes;
use Models\Student;


$id = $_GET['id'];

$classes = new ClassRecord('','','','','','');
	$classes->setConnection($connection);
	$classes->getById($id);
	$all_classes = $classes->showClassesRosters($id);

	$student= new Student('', '', '', '', '', '');
	$student->setConnection($connection);
	$all_students = $student->showAllStudents();
	


// $code = $_GET['code'];

// $student= new Student('', '', '', '', '', '');
// $student->setConnection($connection);
// $all_students = $student->showAllStudents();


 $template = $mustache->loadTemplate('classroster/add.mustache');
 echo $template->render(compact('all_classes', 'all_students'));

try {
	if (isset($_POST['class_code'])) {
		$rosters = new ClassRoster($_POST['class_code'], $_POST['student_number']);
		$rosters->setConnection($connection);
		$rosters->addStudentRoster();
		echo "<script>window.location.href='index.php?';</script>";
		exit();
	}
}

catch (Exception $e) {
	error_log($e->getMessage());
}




?>