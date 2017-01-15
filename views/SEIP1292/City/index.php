<?php
session_start();
include_once ('../../../vendor/autoload.php');
//var_dump($_POST);


use App\Bitm\SEIP1292\Email\Email;
use App\Bitm\SEIP1292\Email\Utility;
use App\Bitm\SEIP1292\Email\Message;
$email = new Email();
$allEmail=$email->index();



?>

<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="../../../Resource/bootstrap/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="../../../Resource/bootstrap/js/bootstrap.js">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
</head>
<body>

<div class="container">
    <h2>All Emails</h2>

    <a href="create.php" class="btn btn-info" role="button">Add Email</a> <a href="trashed.php" class="btn btn-primary" role="button">View Trashed Item</a><br><br>

    <div id="message">
        <?php
       if (array_key_exists('message',$_SESSION)&&(!empty($_SESSION['message'])))
        echo Message::message();
        ?>
    </div>

    <div class="table-responsive">
        <table class="table">
            <thead>
            <tr>
                <th>SL#</th>
                <th>ID</th>
                <th>Email</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
            <?php
            $sl=0;
            foreach ($allEmail as $email){
                $sl++?>
                <tr>
                    <td><?php echo $sl?></td>
                    <td><?php echo $email->id ?></td>
                    <td><?php echo $email->email ?></td>
                    <td><a href="view.php?id=<?php echo $email->id ?>" class="btn btn-info" role="button">View</a>
                        <a href="edit.php?id=<?php echo $email->id ?>" class="btn btn-primary" role="button">Edit</a>
                        <a href="delete.php?id=<?php echo $email->id ?>" class="btn btn-danger" role="button">Delete</a>
                        <a href="trash.php?id=<?php echo $email->id ?>" class="btn btn-info" role="button">Trash</a>
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

