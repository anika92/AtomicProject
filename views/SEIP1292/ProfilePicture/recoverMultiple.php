<?php
include_once('../../../vendor/autoload.php');
use App\Bitm\SEIP1292\Utility\Utility;
use App\Bitm\SEIP1292\Hobby\Hobby;

//Utility::d($_POST['mark']);
$hobby= new Hobby();
$hobby->recoverMultiple($_POST['mark']);
