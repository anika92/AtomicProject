<?php
namespace App\Bitm\SEIP1292\Book;
use App\Bitm\SEIP1292\Book\Message;


Class Book{
    public $id="";
    public $title="";
    public $conn;
    public $deleted_at;

public function prepare($data="")
{
    if (array_key_exists("title", $data)) {
        $this->title = $data['title'];
    }
    if (array_key_exists("id", $data)) {
        $this->id = $data['id'];
    }
    return $this;
}

public function __construct(){
    $this->conn= mysqli_connect("localhost","root","","atomicprojectb20") or die("Database connection establish failed");
}

    public function store(){
        $query="INSERT INTO `atomicprojectb20`.`book` (`title`) VALUES ('".$this->title."')";
        //echo $query;
        $result= mysqli_query($this->conn,$query);
        if($result){
            Message::message("<div class=\"alert alert-success\">
  <strong>Success!</strong> Data has been stored successfully.
</div>");
            Utility::redirect('index.php');

        }
        else {
            Message::message("<div class=\"alert alert-info\">
  <strong>Error!</strong> Data has been stored successfully.
</div>");
            Utility::redirect('index.php');

        }

    }



    public  function index(){
        $_allBook=array();
        $query= "SELECT * FROM `book` WHERE `deleted_at` IS NULL";
        $result= mysqli_query($this->conn,$query);
        while($row=mysqli_fetch_object($result)){
            $_allBook[]=$row;
        }
        return $_allBook;
    }

    public function view(){
        $query="SELECT * FROM `book` WHERE `id`=".$this->id;
        $result= mysqli_query($this->conn,$query);
        $row= mysqli_fetch_object($result);
        return $row;
    }

    public function update(){
        $query="UPDATE `atomicprojectb20`.`book` SET `title` = '".$this->title."' WHERE `book`.`id` = ".$this->id;
        $result= mysqli_query($this->conn,$query);
        if($result){
            Message::message("<div class=\"alert alert-info\">
  <strong>Updated!</strong> Data has been updated successfully.
</div>");
            Utility::redirect('index.php');

        }
        else {
            Message::message("<div class=\"alert alert-danger\">
  <strong>Error!</strong> Data has not been updated successfully.
</div>");
            Utility::redirect('index.php');

        }

    }

    public function delete()
    {
        $query = "DELETE FROM `atomicprojectb20`.`book` WHERE `book`.`id` =" . $this->id;
        $result = mysqli_query($this->conn, $query);
        if ($result) {
            Message::message("<div class=\"alert alert-info\">
  <strong>Updated!</strong> Data has been deleted successfully.
</div>");
            Utility::redirect('index.php');

        } else {
            Message::message("<div class=\"alert alert-danger\">
  <strong>Error!</strong> Data has not been deleted successfully.
</div>");
            Utility::redirect('index.php');


        }
    }
    public function trash(){
        $this->deleted_at=time();
        $query="UPDATE `atomicprojectb20`.`book` SET `deleted_at` = '".$this->deleted_at."' WHERE `book`.`id` = ".$this->id;
        $result=mysqli_query($this->conn,$query);
        if ($result) {
            Message::message("<div class=\"alert alert-info\">
  <strong>Updated!</strong> Data has been trashed successfully.
</div>");
            Utility::redirect('index.php');

        } else {
            Message::message("<div class=\"alert alert-danger\">
  <strong>Error!</strong> Data has not been trashed successfully.
</div>");
            Utility::redirect('index.php');


        }


    }
    public function trashed(){
        $_allBook=array();
        $query= "SELECT * FROM `book` WHERE `deleted_at` IS NOT NULL";
        $result= mysqli_query($this->conn,$query);
        while($row=mysqli_fetch_object($result)){
            $_allBook[]=$row;
        }
        return $_allBook;

    }
    public function recover(){
        $query="UPDATE `atomicprojectb20`.`book` SET `deleted_at` =NULL WHERE `book`.`id` = ".$this->id;
        $result=mysqli_query($this->conn,$query);
        if ($result) {
            Message::message("<div class=\"alert alert-info\">
  <strong>Updated!</strong> Data has been recovered successfully.
</div>");
            Utility::redirect('index.php');

        } else {
            Message::message("<div class=\"alert alert-danger\">
  <strong>Error!</strong> Data has not been recovered successfully.
</div>");
            Utility::redirect('index.php');


        }


    }
    public function recoverMultiple($idS=array()){
        if((is_array($idS))&& count($idS)>0){
            $IDs= implode(",",$idS);
        $query="UPDATE `atomicprojectb20`.`book` SET `deleted_at` =NULL WHERE `book`.`id` IN(".$IDs.")";
        $result=mysqli_query($this->conn,$query);
        if ($result) {
            Message::message("<div class=\"alert alert-info\">
  <strong>Updated!</strong> Selected Data has been recovered successfully.
</div>");
            Utility::redirect('index.php');

        } else {
            Message::message("<div class=\"alert alert-danger\">
  <strong>Error!</strong> Selected Data has not been recovered successfully.
</div>");
            Utility::redirect('index.php');

        }
        }


    }
    public function count(){
        $query="SELECT COUNT(*) AS totalItem FROM `book`";
        $result= mysqli_query($this->conn,$query);
        $row= mysqli_fetch_assoc($result);
        return $row['totalItem'];
    }

    public function paginator($pageStartFrom=0,$Limit=5){
        $query="SELECT * FROM `book` LIMIT ".$pageStartFrom.",".$Limit;
        $result= mysqli_query($this->conn,$query);
        while($row=mysqli_fetch_object($result)){
            $_allBook[]=$row;
        }
        return $_allBook;

    }







}