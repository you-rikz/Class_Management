<?php

include ("../init.php");
use Models\ClassRecord;
use Models\Teacher;

$teacher= new Teacher('', '', '', '', '', '');
$teacher->setConnection($connection);
$all_teachers = $teacher->showAllTeachers();

$template = $mustache->loadTemplate('classrecord/add.mustache');
echo $template->render(compact('all_teachers'));

try {
	if (isset($_POST['class_name'])) {
		$addClass = new ClassRecord($_POST['class_name'], $_POST['code'], $_POST['class_description'], $_POST['teacher_id']);
		$addClass->setConnection($connection);
		$addClass->addClass();
		echo "<script>window.location.href='index.php';</script>";
		exit;
	}
}

catch (Exception $e) {
	error_log($e->getMessage());
}

?>