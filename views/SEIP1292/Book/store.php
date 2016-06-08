<?php
include_once ('../../../vendor/autoload.php');
//var_dump($_POST);
use App\Bitm\SEIP1292\Book\Book;

if((isset($_POST['title']))&&(!empty($_POST['title']))) {
    $book = new Book();
    $book->prepare($_POST)->store();
    //$book->store();
}
else {
    echo "Please insert some data";
}
