<?php

include ("../init.php");
use Models\ClassRoster;
use Models\Student;
use Models\Teacher;	

$code = $_GET['code'];

$student= new Student('', '', '', '', '', '');
$student->setConnection($connection);
$all_students = $student->showAllStudents();


$template = $mustache->loadTemplate('class_roster/add.mustache');
echo $template->render();

try {
	if (isset($_POST['student_number'])) {
		$rosters = new Classes($_POST['class_code'], $_POST['student_number']);
		$rosters->setConnection($connection);
		$rosters->addStudentRoster();
		echo "<script>window.location.href='edit.php?" . $_POST['code'] . "';</script>";
		exit();
	}
}

catch (Exception $e) {
	error_log($e->getMessage());
}

?>