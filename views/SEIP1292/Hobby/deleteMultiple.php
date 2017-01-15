<?php
include_once('../../../vendor/autoload.php');
use App\Bitm\SEIP1292\Utility\Utility;
use App\Bitm\SEIP1292\ProfilePicture\ImageUploader;

Utility::d($_POST['mark']);
$deletemultiple= new ImageUploader();
$deletemultiple->deleteMultiple($_POST['mark']);
