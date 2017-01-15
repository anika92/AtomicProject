<?php
include_once('../../../vendor/autoload.php');
use App\Bitm\SEIP1292\Utility\Utility;
use App\Bitm\SEIP1292\Book\Book;

//Utility::d($_POST['mark']);
$book= new Book();
$book->recoverMultiple($_POST['mark']);
