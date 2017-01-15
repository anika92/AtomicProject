<?php
include_once ('../../../vendor/autoload.php');
use App\Bitm\SEIP1292\Hobby\Hobby;

$hobby= new Hobby();
$hobby->prepare($_GET)->recover();