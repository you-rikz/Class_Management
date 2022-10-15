<?php

include ("../init.php");
use Models\ClassRecord;

$template = $mustache->loadTemplate('classes/add.mustache');
echo $template->render();

try {
	if (isset($_POST['classes_name'])) {
		$addClassRecord = new Classes($_POST['classes_name'], $_POST['class_description'], $_POST['code'], $_POST['teacher_id']);
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