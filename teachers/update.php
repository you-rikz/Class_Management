<?php

include ("../init.php");
use Models\Teacher;

try {
	
	$id = $_POST['id'];

    if (isset($_POST['id'])) {
	$student = new Teacher('','','','','','');
	$student->setConnection($connection);
	$student->getById($id);
    

        $first_name =$_POST['first_name'];
        $last_name= $_POST['last_name'];
        $email= $_POST['email'] ;
        $contact = $_POST['contact'];
        $employee_number = $_POST['employee_number'];
        
	$student->update($first_name, $last_name, $email, $contact, $employee_number );
    echo "<script>window.location.href='index.php';</script>";
     exit;
    // var_dump($student);
    }
}

catch (Exception $e) {
	error_log($e->getMessage());
}
?>