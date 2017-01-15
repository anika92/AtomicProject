<?php
session_start();
include_once ('../../../vendor/autoload.php');
use App\Bitm\SEIP127236\Summary\Summary;
use App\Bitm\SEIP127236\Utility\Utility;
use App\Bitm\SEIP127236\Message\Message;
$summary= new Summary();
$allSummary=$summary->index();



?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/html">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
</head>
<body>

<div class="container">
    <h2>All Summary</h2>

    <a href="create.php" class="btn btn-info" role="button">Add Summary</a> <a href="trashed.php" class="btn btn-primary" role="button">View Trashed Item</a><br><br>

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
                <th>Name</th>
                <th>Summary</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
            <?php
            $sl=0;
            foreach ($allSummary as $summary){
                $sl++?>
                <tr>
                    <td><?php echo $sl?></td>
                    <td><?php echo $summary->id ?></td>
                    <td><?php echo $summary->name ?></td>
                    <td><?php echo $summary->summary ?></td>
                    <td><a href="view.php?id=<?php echo $summary->id ?>" class="btn btn-info" role="button">View</a>
                        <a href="edit.php?id=<?php echo $summary->id ?>" class="btn btn-primary" role="button">Edit</a>
                        <a href="delete.php?id=<?php echo $summary->id ?>" class="btn btn-danger" role="button">Delete</a>
                        <a href="trash.php?id=<?php echo $summary->id ?>" class="btn btn-info" role="button">Trash</a>
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


