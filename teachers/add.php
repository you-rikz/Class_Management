<?php

include ("../init.php");
use Models\Teacher;

$template = $mustache->loadTemplate('teacher/add.mustache');
echo $template->render();

try {
	if (isset($_POST['first_name'])) {
		// var_dump($_POST['first_name'],$_POST['last_name'], $_POST['email'], $_POST['contact'], $_POST['employee_number']);
		$addTeacher = new Teacher($_POST['first_name'], $_POST['last_name'], $_POST['email'], $_POST['contact'], $_POST['employee_number']);
		$addTeacher->setConnection($connection);
		$addTeacher->addTeacher();

		// var_dump($addTeacher);
		echo "<script>window.location.href='index.php';</script>";
		exit;
	}
}

catch (Exception $e) {
	error_log($e->getMessage());
}

?>