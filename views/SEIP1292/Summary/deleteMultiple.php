<?php
include_once ('../../../vendor/autoload.php');
use App\Bitm\SEIP127236\Summary\Summary;
use App\Bitm\SEIP127236\Utility\Utility;
$summary =new Summary();
$summary->deleteMultiple($_POST['mark']);

