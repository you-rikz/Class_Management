<?php

include ("../init.php");
use Models\ClassRoster;


$id=$_GET['id'];
$rosters= new ClassRoster('', '', '', '', '', '');
$rosters->setConnection($connection);
$rosters->getById($id);
$rosters->delete();
echo "<script>window.location.href='index.php';</script>";
exit;

?>