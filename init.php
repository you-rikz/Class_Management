<?php

include "vendor/autoload.php";
include "config/config.php";

use Models\Connection;
use Models\Classed;
use Models\Teacher;
use Models\Student;
use Models\ClassRoster;

$connObj = new Connection($host, $database, $user, $password);
$connection = $connObj->connect();
