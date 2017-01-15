<?php
include_once ('../../../vendor/autoload.php');
use App\Bitm\SEIP1292\ProfilePicture\ImageUploader;

$recover= new ImageUploader();
$recover->prepare($_GET)->deActive();