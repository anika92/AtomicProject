<?php
session_start();
include_once ('../../../vendor/autoload.php');
//var_dump($_POST);


use App\Bitm\SEIP1292\Book\Book;
use App\Bitm\SEIP1292\Utility\Utility;
use App\Bitm\SEIP1292\Message\Message;
$book = new Book();

$totalItem=$book->count();
//Utility::dd($totalItem);
if(array_key_exists('itemPerPage',$_SESSION)) {
    if(array_key_exists('itemPerPage',$_GET)){
        $_SESSION['itemPerPage']=$_GET['itemPerPage'];
    }

}
else{
    $_SESSION['itemPerPage']=5;
}
$itemPerPage= $_SESSION['itemPerPage'];


$noOfPage=ceil($totalItem/$itemPerPage);
//Utility::d($noOfPage);
$pagination="";
if(array_key_exists('pageNo',$_GET)){
    $pageNo= $_GET['pageNo'];
}else {
    $pageNo = 1;
}
for($i=1;$i<=$noOfPage;$i++){
    $active=($i==$pageNo)?"active":"";
    $pagination.="<li class='$active'><a href='index.php?pageNo=$i'>$i</a></li>";
}

$pageStartFrom=$itemPerPage*($pageNo-1);
$allBook=$book->paginator($pageStartFrom,$itemPerPage);




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
    <h2>All Book list</h2>

    <a href="create.php" class="btn btn-info" role="button">Add Book Title</a> <a href="trashed.php" class="btn btn-primary" role="button">View Trashed Item</a><br><br>

    <div id="message">
        <?php
        if((array_key_exists('message',$_SESSION))&& !empty($_SESSION['message'])) {
            echo Message::message();
        }
        ?>
    </div>
    <form role="form" action="index.php">
        <div class="form-group">
            <label for="sel1">Select item per page (select one):</label>
            <select class="form-control" id="sel1" name="itemPerPage">
                <option>5</option>
                <option>10</option>
                <option selected>15</option>
                <option>20</option>
                <option>25</option>
            </select>
            <button type="submit">GO!</button>

        </div>
    </form>

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
            <tbody>
            <?php
            $sl=0;
            foreach ($allBook as $book){
                $sl++?>
            <tr>
                <td><?php echo $sl+$pageStartFrom?></td>
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
        <ul class="pagination">
            <li><a href="#">Prev</a></li>
            <?php echo $pagination ?>
            <li><a href="#">Next</a></li>
        </ul>
    </div>
</div>
<script>
    $('#message').show().delay(3000).fadeOut();
</script>

</body>
</html>

