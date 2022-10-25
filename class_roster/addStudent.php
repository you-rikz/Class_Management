<?php
include ("../init.php");
use Models\ClassRoster;
use Models\ClassRecord;
use Models\Student;

// var_dump($_POST['class_code'], $_POST['student_number']);
try {
	if (isset($_POST['class_code'])) {
		$rosters = new ClassRoster($_POST['class_code'], $_POST['student_number']);
		$rosters->setConnection($connection);
		$rosters->addStudentToRoster();
		echo "<script>window.location.href='index.php?';</script>";
		exit();
	}
}


catch (Exception $e) {
	error_log($e->getMessage());
}
?>