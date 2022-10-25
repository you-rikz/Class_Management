<?php

include ("../init.php");
use Models\ClassRoster;
use Models\ClassRecord;


    $id = $_GET['id'];

    $id = $_GET['id'];
    $classes = new ClassRecord('','','','','','');
    $classes ->setConnection($connection);
    $classes->getById($id);
    $class_code = $classes -> getClassCode();
    $all_classes =$classes ->showClassesRosters($id);

    $rosters= new ClassRoster('', '', '', '', '', '');
    $rosters->setConnection($connection);
    $all_rosters =$rosters ->showClassRosters($id);

    $all_rosters=$rosters -> viewClasses($class_code);
    $template = $mustache->loadTemplate('classroster/view.mustache');
    echo $template->render((compact('all_rosters', 'all_classes', 'id')));






