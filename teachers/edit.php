<?php

include ("../init.php");
use Models\Teacher;

	$id = $_GET['id'];

	$teacher = new Teacher('','','','','','');
	$teacher->setConnection($connection);
	$teacher->getById($id);
	$first_name = $teacher->getFirstName();
	$last_name = $teacher->getLastName();
	$email = $teacher->getEmail();
	$contact = $teacher->getContact();
	$employee_number = $teacher->getEmployeeNumber();

    // $all_teachers = $teacher->showAllteachers();
	
	// echo $mustache->render('teacher/edit', compact('teacher'));

    $template = $mustache->loadTemplate('teacher/edit.mustache');
    echo $template->render(compact('id', 'teacher', 'first_name', 'last_name', 'email', 'contact', 'employee_number'));

?>