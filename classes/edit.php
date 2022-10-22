<?php

include ("../init.php");
use Models\ClassRecord;
use Models\Teacher;

$id = $_GET['id'];

$classes = new ClassRecord('','','','','','');
	$classes->setConnection($connection);
	$classes->getById($id);


	$teacher= new Teacher('', '', '', '', '', '');
	$teacher->setConnection($connection);
	$all_teachers = $teacher->showAllTeachers();

	
	//var_dump($id);

	
	$class_name = $classes->getClassName();
	$code = $classes->getClassCode();
	$class_description = $classes->getDescription();
	$teacher_id = $classes->getTeacherID();
	

    // $all_students = $student->showAllStudents();
	
	// echo $mustache->render('student/edit', compact('student'));

    $template = $mustache->loadTemplate('classrecord/edit.mustache');
    echo $template->render(compact('id', 'classes', 'class_name', 'code', 'class_description','all_teachers','teacher_id'));

?>