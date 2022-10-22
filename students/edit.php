<?php

include ("../init.php");
use Models\Student;

	$id = $_GET['id'];

	$student = new Student('','','','','','');
	$student->setConnection($connection);
	$student->getById($id);
	$first_name = $student->getFirstName();
	$last_name = $student->getLastName();
	$student_number = $student->getStudentNumber();
	$email = $student->getEmail();
	$contact = $student->getContact();
	$program = $student->getProgram();

    // $all_students = $student->showAllStudents();
	
	// echo $mustache->render('student/edit', compact('student'));

    $template = $mustache->loadTemplate('student/edit.mustache');
    echo $template->render(compact('id', 'student', 'first_name', 'last_name', 'student_number', 'email', 'contact', 'program'));

?>