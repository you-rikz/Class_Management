<?php

include ("../init.php");
use Models\Student;

try {
	
	$id = $_POST['id'];

    if (isset($_POST['id'])) {
	$student = new Student('','','','','','');
	$student->setConnection($connection);
	$student->getById($id);
    

        $first_name =$_POST['first_name'];
        $last_name= $_POST['last_name'];
        $student_number = $_POST['student_number'];
        $email= $_POST['email'] ;
        $contact = $_POST['contact'];
        $program = $_POST['program'];
        
	$student->update($first_name, $last_name, $student_number, $email, $contact, $program );
    echo "<script>window.location.href='index.php';</script>";
     exit;
    //var_dump($student );
    }
}

catch (Exception $e) {
	error_log($e->getMessage());
}
?>