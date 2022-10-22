<?php

include ("../init.php");
use Models\ClassRecord;



$id=$_GET['id'] ?? null;
$student= new ClassRecord('', '', '', '', '', '');
$student->setConnection($connection);
$student->getById($id);
$student->delete();
echo "<script>window.location.href='index.php';</script>";

?>