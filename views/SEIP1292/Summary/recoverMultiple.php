<?php
include_once('../../../vendor/autoload.php');
use App\Bitm\SEIP127236\Utility\Utility;
use App\Bitm\SEIP127236\Summary\Summary;

//Utility::d($_POST['mark']);
$summary= new Summary();
$summary->recoverMultiple($_POST['mark']);
