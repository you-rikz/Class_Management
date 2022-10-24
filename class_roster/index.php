<?php

include ("../init.php");
use Models\ClassRoster;
use Models\ClassRecord;

$rosters= new ClassRoster('', '', '', '', '', '');
$rosters->setConnection($connection);
$all_rosters = $rosters->showClassRosters();


 $template = $mustache->loadTemplate('classroster/index.mustache');
    echo $template->render((compact('all_rosters')));
    ?>