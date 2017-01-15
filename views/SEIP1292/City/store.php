<?php
include_once ('../../../vendor/autoload.php');
//var_dump($_POST);
use App\Bitm\SEIP1292\Email\Email;

if((isset($_POST['email']))&&(!empty($_POST['email']))) {
    $email = new Email();
    $email->prepare($_POST)->store();
    //$book->store();
}
else {
    echo "Please insert some data";
}
