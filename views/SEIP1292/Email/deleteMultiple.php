<?php
include_once('../../../vendor/autoload.php');
use App\Bitm\SEIP1292\Utility\Utility;
use App\Bitm\SEIP1292\Gender\Gender;

//Utility::d($_POST['mark']);
$deletemultiple= new Gender();
$deletemultiple->deleteMultiple($_POST['mark']);
