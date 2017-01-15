<?php
include_once('../../../vendor/autoload.php');
use App\Bitm\SEIP1292\Email\Utility;
use App\Bitm\SEIP1292\Email\Email;



$email= new Email();
$email->recoverMultiple($_POST['mark']);