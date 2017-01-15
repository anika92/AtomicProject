<?php
include_once('../../../vendor/autoload.php');
use App\Bitm\SEIP1292\Utility\Utility;
use App\Bitm\SEIP1292\Hobby\Hobby;

//Utility::d($_POST['mark']);
$deletemultiple= new Hobby();
$deletemultiple->deleteMultiple($_POST['mark']);
