<?php

include ("../init.php");
use Models\ClassRecord;
use Models\Teacher;

try {
	
	$id = intval( $_POST['id']);
    
    // var_dump($id);
    if (isset($_POST['id'])) {
	$classes = new ClassRecord('','','','','','');
	$classes->setConnection($connection);
	$classes->getById($id);
    

        $class_name =$_POST['class_name'];
        $code= $_POST['code'];
        $class_description = $_POST['class_description'];
        $teacher_id= intval($_POST['teacher_id'] );

        // var_dump($id, $class_name, $code, $class_description, $teacher_id);
	$classes->update( $class_name, $code, $class_description, $teacher_id );
    echo "<script>window.location.href='index.php';</script>";
     exit;
    // var_dump($student);
    }
}

catch (Exception $e) {
	error_log($e->getMessage());
}
?>