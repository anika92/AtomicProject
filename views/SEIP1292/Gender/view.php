<?php

include_once('../../../vendor/autoload.php');

use App\Bitm\SEIP1292\Email\Email;
use App\Bitm\SEIP1292\Utility\Utility;
$email= new Email();
$single=$email->prepare($_GET)->view();
//Utility::d($single);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Bootstrap Example</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>

<div class="container">
    <h2><?php echo $single->email ?></h2>
<ul class="list-group">
    <li class="list-group-item">ID: <?php echo $single->id?></li>
    <li class="list-group-item">Title: <?php echo $single->email ?></li>

</ul>
</div>

</body>