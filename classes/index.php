<?php

include ("../init.php");
use Models\ClassRecord;


$classes= new ClassRecord('', '', '', '', '', '');
$classes->setConnection($connection);
$all_classes = $classes->showAllClasses();


 $template = $mustache->loadTemplate('classrecord/index.mustache');
    echo $template->render((compact('all_classes')));