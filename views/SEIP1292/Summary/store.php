<?php
include_once ('../../../vendor/autoload.php');
use App\Bitm\SEIP127236\Summary\Summary;

if((isset($_POST['name']))&&(!empty($_POST['summary']))) {
    $summary= new Summary();
    $summary->prepare($_POST)->store();
    //$book->store();
}
else {
    echo "Please insert some data";
}
