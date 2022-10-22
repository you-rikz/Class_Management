<?php

include ("../init.php");
use Models\Student;

$template = $mustache->loadTemplate('student/add.mustache');
echo $template->render();

try {
	if (isset($_POST['first_name'])) {
		$addStudent = new Student($_POST['first_name'], $_POST['last_name'], $_POST['student_number'], $_POST['email'], $_POST['contact'], $_POST['program']);
		$addStudent->setConnection($connection);
		$addStudent->addStudent();
		echo "<script>window.location.href='index.php';</script>";
		exit;
	}
}

catch (Exception $e) {
	error_log($e->getMessage());
}

?>