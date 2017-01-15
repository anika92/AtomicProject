<?php
session_start();
include_once ('../../../vendor/autoload.php');
//var_dump($_POST);


use App\Bitm\SEIP1292\Book\Book;
use App\Bitm\SEIP1292\Utility\Utility;
use App\Bitm\SEIP1292\Message\Message;
$book = new Book();
$allBook=$book->index();



?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/html">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="../../../Resource/bootstrap/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="style.css">
    <link rel="stylesheet" type="text/css" href="../../../Resource/bootstrap/js/bootstrap.js">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
</head>
<body>

<div class="container">
    <h2>All Book Lists</h2>
<br><br>
<div class="button">
    <a href="create.php" class="btn btn-info" role="button">Add Book Title</a> <a href="trashed.php" class="btn btn-primary" role="button">View Trashed Item</a>
</div>
    <div id="message">
        <?php
        if((array_key_exists('message',$_SESSION))&& !empty($_SESSION['message'])) {
            echo Message::message();
        }
        ?>
    </div>

    <div class="table-responsive">
        <table class="table">
            <thead>
            <tr>
                <th>SL#</th>
                <th>ID</th>
                <th>Book Title</th>
                <th>Action</th>
            </tr>
            </thead>
            <hr>
            <br>
            <br>
            <tbody>
            <?php
            $sl=0;
            foreach ($allBook as $book){
                $sl++?>
            <tr>
                <td><?php echo $sl?></td>
                <td><?php echo $book->id ?></td>
                <td><?php echo $book->title ?></td>
                <td><a href="view.php?id=<?php echo $book->id ?>" class="btn btn-info" role="button">View</a>
                    <a href="edit.php?id=<?php echo $book->id ?>" class="btn btn-primary" role="button">Edit</a>
                    <a href="delete.php?id=<?php echo $book->id ?>" class="btn btn-danger" role="button">Delete</a>
                    <a href="trash.php?id=<?php echo $book->id ?>" class="btn btn-info" role="button">Trash</a>
                </td>
            </tr>
            <?php }?>

            </tbody>
        </table>
    </div>
</div>
<script>
    $('#message').show().delay(3000).fadeOut();
</script>

</body>
</html>

