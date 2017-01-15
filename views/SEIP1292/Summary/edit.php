<?php
include_once ('../../../vendor/autoload.php');
use App\Bitm\SEIP127236\Summary\Summary;
use App\Bitm\SEIP127236\Utility\Utility;

$summary= new Summary();
$singleItem=$summary->prepare($_GET)->view();
//Utility::dd($singleItem);


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>summary</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="../../../Resource/bootstrap/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="../../../Resource/bootstrap/js/bootstrap.js">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>

</head>
<body>

<div class="container">
    <h2>Atomic Project- Summary</h2>
    <form role="form" action="update.php" method="post">
        <div class="form-group">
            <label>Edit Summary:</label>
            <input type="hidden" name="id"  value="<?php echo $singleItem["id"]?>">
            <input type="text" name="name" class="form-control" id="email" value="<?php echo $singleItem["name"]?>">
            <input type="text" name="summary" class="form-control" id="email" value="<?php echo $singleItem["summary"]?>">
        </div>
        <button type="submit" class="btn btn-default">Update</button>
    </form>


</div>

</body>
</html>
