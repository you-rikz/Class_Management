<?php

include ("../init.php");
use Models\Student;

$template = $mustache->loadTemplate('students/add.mustache');
echo $template->render();

try {
	if (isset($_POST['first_name'])) {
		$addClassRecord = new Classes($_POST['first_name'], $_POST['last_name'], $_POST['student_number'], $_POST['email'], $_POST['contact'], $_POST['program']);
		$addClassRecord->setConnection($connection);
		$addClassRecord->addClassRecord();
		echo "<script>window.location.href='index.php';</script>";
		exit;
	}
}

catch (Exception $e) {
	error_log($e->getMessage());
}

?>