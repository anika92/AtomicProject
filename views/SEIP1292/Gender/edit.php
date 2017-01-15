<?php
include_once('../../../vendor/autoload.php');
use App\Bitm\SEIP1292\Hobby\Hobby;
use App\Bitm\SEIP1292\Utility\Utility;

$hobby= new Hobby();
$singleItem=$hobby->prepare($_GET)->view();
//Utility::dd($singleItem);


?>




<!DOCTYPE html>
<html lang="en">
<head>
    <title>Book Title</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="../../../Resource/bootstrap/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="../../../Resource/bootstrap/js/bootstrap.js">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>

</head>
<body>

<div class="container">
    <h2>Atomoic Project- Book</h2>
    <form role="form" action="update.php" method="post">
        <div class="form-group">
            <label>Edit  Hobbies:</label>
            <input type="hidden" name="id"  value="<?php echo $singleItem->id?>">
            <input type="text" name="name" class="form-control" id="email" value="<?php echo $singleItem->name?>">
            <?php

              $array= $singleItem->hobbies;
            $hobby=explode(",",$array );


            ?>


            <div class="checkbox">
                <label><input type="checkbox" name="Hobby[]" value="" <?php $key=in_array('Playing Cricket',$hobby);if($key){echo "checked='checked'";}?> >Playing Cricket
                </label>
            </div>
            <div class="checkbox">
                <label><input type="checkbox" name="Hobby[]"  <?php $key=in_array("Coding",$hobby);if($key) {
                        ?> checked="checked" <?php }  ?>  >Coding</label>
            </div>
            <div class="checkbox">
                <label><input type="checkbox" name="Hobby[]"   <?php $key=in_array("Browsing",$hobby);if($key) {
                        ?> checked="checked" <?php }  ?> >Browsing</label>
            </div>
            <div class="checkbox">
                <label><input type="checkbox" name="Hobby[]"  <?php $key=in_array("Book reading",$hobby);if($key) {
                        ?> checked="checked" <?php }  ?> >Book reading</label>
            </div>
            <div class="checkbox">
                <label><input type="checkbox" name="Hobby[]"  <?php $key=in_array("Gardening",$hobby);if($key) {
                        ?> checked="checked" <?php }  ?> >Gardening</label>
            </div>
            <div class="checkbox">
                <label><input type="checkbox" name="Hobby[]" <?php $key=in_array("Teaching",$hobby);if($key) {
                        ?> checked="checked" <?php }  ?>  >Teaching</label>
            </div>


<br>


        </div>
        <button type="submit" class="btn btn-default">Update</button>


</body>
</html>