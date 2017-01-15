<?php
include_once ('../../../vendor/autoload.php');
use App\Bitm\SEIP127236\Book\Book;

$book= new Book();
$book->prepare($_GET)->recover();