<?php
//var_dump($_GET);

include_once('../../../vendor/autoload.php');
use App\Bitm\SEIP1292\Book\Book;
use App\Bitm\SEIP1292\Book\Utility;
$book= new Book();
$singleBook=$book->prepare($_GET)->view();
//Utility::d($singleBook);
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
</head>
<body>

<div class="container">
    <h2><?php echo $singleBook->title ?></h2>
    <ul class="list-group">
        <li class="list-group-item">ID: <?php echo $singleBook->id?></li>
        <li class="list-group-item">Title: <?php echo $singleBook->title ?></li>

    </ul>
</div>

</body>
</html>

