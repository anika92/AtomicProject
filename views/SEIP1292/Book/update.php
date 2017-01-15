<?php
//var_dump($_POST);
include_once('../../../vendor/autoload.php');
use App\Bitm\SEIP1292\Book\Book;

$book= new Book();
$book->prepare($_POST)->update();