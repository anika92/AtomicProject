<?php
include_once('../../../vendor/autoload.php');
use App\Bitm\SEIP1292\Email\Email;
use App\Bitm\SEIP1292\Email\Utility;

$email= new Email();
$singleItem=$email->prepare($_GET)->view();
//Utility::dd($singleItem);


?>




<!DOCTYPE html>
<html lang="en">
<head>
    <title>Email</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="../../../Resource/bootstrap/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="../../../Resource/bootstrap/js/bootstrap.js">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>

</head>
<body>

<div class="container">
    <h2>Atomoic Project- Email</h2>
    <form role="form" action="update.php" method="post">
        <div class="form-group">
            <label>Edit Email:</label>
            <input type="hidden" name="id"  value="<?php echo $singleItem->id?>">
            <input type="text" name="email" class="form-control" id="email" value="<?php echo $singleItem->email?>">
        </div>
        <button type="submit" class="btn btn-default">Update</button>
    </form>
</div>

</body>
</html>