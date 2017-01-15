<?php
//var_dump($_POST);
include_once('../../../vendor/autoload.php');
use App\Bitm\SEIP1292\Email\Email;

$email= new Email();
$trashItem=$email->trashed();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Bootstrap Example</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="../../../Resource/bootstrap/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="../../../Resource/bootstrap/js/bootstrap.js">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
</head>
<body>
<div class="container">
    <h2>All Trashed Item</h2>
    <a href="index.php" class="btn btn-info" role="button">View Index Items</a><br><br>


    <form  action="recoverMultiple.php" method="post" id="multiple">

        <button type="submit" class="btn btn-primary">Recover Selected Item</button>
        <button type="button" id="delete" class="btn btn-danger">Delete Selected Item</button>
    <table class="table">
        <thead>
        <tr>
            <th>Select Item</th>
            <th>SL#</th>
            <th>ID</th>
            <th>Book Title</th>
            <th>Action</th>
        </tr>
        </thead>
        <tbody>

            <?php
            $sl=0;
            foreach($trashItem as $trashed){

                $sl++;
                ?>
                <tr class="success">
                    <td><input type="checkbox" name="mark[]" value="<?php echo $trashed->id ?>"></td>
                    <td><?php echo $sl?></td>
                    <td><?php echo $trashed->id ?></td>
                    <td><?php echo $trashed->email ?></td>
                    <td><a href="recover.php?id=<?php echo $trashed->id ?>" class="btn btn-info" role="button">Recover</a>
                        <a href="delete.php?id=<?php echo $trashed->id ?>" class="btn btn-danger" role="button">Delete</a>
                    </td>
                </tr>
            <?php } ?>
</tbody>
</form>
</table>
</div>
</body>