<?php

include ("../init.php");
use Models\Teacher;

$template = $mustache->loadTemplate('teachers/add.mustache');
echo $template->render();

try {
	if (isset($_POST['first_name'])) {
		$addClassRecord = new Classes($_POST['first_name'], $_POST['last_name'], $_POST['employee_number'], $_POST['email'], $_POST['contact']);
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