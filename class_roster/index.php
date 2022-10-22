<?php

include ("../init.php");
use Models\ClassRoster;

$rosters= new ClassRoster('', '', '', '', '', '');
$rosters->setConnection($connection);
$all_rosters = $rosters->showClassesRosters();


 $template = $mustache->loadTemplate('classroster/index.mustache');
    echo $template->render((compact('all_rosters')));