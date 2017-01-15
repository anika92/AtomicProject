<?php
include_once ('../../../vendor/autoload.php');
use App\Bitm\SEIP1292\Book\Book;


$book= new Book();
$book->prepare($_GET)->trash();

