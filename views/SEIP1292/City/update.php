<?php
//var_dump($_POST);
include_once('../../../vendor/autoload.php');
use App\Bitm\SEIP1292\Email\Email;

$email= new Email();
$email->prepare($_POST)->update();