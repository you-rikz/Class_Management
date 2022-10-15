<?php

include ("../init.php");
use Models\ClassRoster;

$template = $mustache->loadTemplate('class_roster/add.mustache');
echo $template->render();

try {
	if (isset($_POST['class_code'])) {
		$addClassRecord = new Classes($_POST['class_code'], $_POST['student_number'], $_POST['enrolled_at']);
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