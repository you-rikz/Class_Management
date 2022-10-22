<?php

include ("../init.php");
use Models\Teacher;



$id=$_GET['id'] ?? null;
$teachers= new Teacher('', '', '', '', '', '');
$teachers->setConnection($connection);
$teachers->getById($id);
$teachers->delete();
echo "<script>window.location.href='index.php';</script>";

?>