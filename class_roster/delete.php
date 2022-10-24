<?php

include ("../init.php");
use Models\ClassRoster;


$id=$_GET['id'] ?? null;
$student= new ClassRoster('', '', '', '', '', '');
$student->setConnection($connection);
$student->getById($id);
$student->delete();
echo "<script>window.location.href='index.php';</script>";
exit;

?>