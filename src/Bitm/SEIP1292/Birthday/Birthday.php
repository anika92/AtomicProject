<?php
namespace App\Bitm\SEIP1292\Birthday;
use App\Bitm\SEIP1292\Message\Message;
use App\Bitm\SEIP1292\Utility\Utility;

Class Birthday
{
    public $id = "";
    public $name = "";
    public $name1 = "";
    public $date;
    public $conn;
    public $deleted_at;

    public function prepare($info = "")
    {
        if (array_key_exists("name", $info)) {
            $this->name = $info['name'];
        }
        if (array_key_exists("id", $info)) {
            $this->id = $info['id'];
        }

        if (array_key_exists("date", $info)) {
            $this->date = $info['date'];
        }
        return $this;
    }

    public function __construct()
    {
        $this->conn = mysqli_connect("localhost", "root", "", "atomicprojectb20") or die("Database connection establish failed");
    }

    public function store()
    {
        if((!empty($this->date)) && (!empty($this->name))){
        $query = "INSERT INTO `atomicprojectb20`.`birthday` ( `name`, `date`) VALUES ( '{$this->name}', '{$this->date}');";
        //echo $query;
        $result = mysqli_query($this->conn, $query);
        if ($result) {
            Message::message("<div class=\"alert alert-success\">
  <strong>Success!</strong> Data has been stored successfully.
</div>");
            Utility::redirect('index.php');

        }}else {
            Message::message("<div class=\"alert alert-info\">
  <strong>Error!</strong> Data has been stored successfully.
</div>");
            Utility::redirect('index.php');

        }

    }
    public  function index(){
        $_allDate=array();
        $query= "SELECT * FROM `atomicprojectb20`.`birthday` WHERE `deleted_at` IS NULL";

        $result= mysqli_query($this->conn,$query);
        while($row=mysqli_fetch_object($result)){
            $_allDate[]=$row;
        }
        return $_allDate;
    }

public  function update(){

    $query="UPDATE `atomicprojectb20`.`birthday` SET `name` = '".$this->name."' , `date` = '{$this->date}' WHERE `birthday`.`id` = ".$this->id;
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
    public function view()
    {
        $query = "SELECT * FROM `birthday` WHERE `id`=" . $this->id;
        $result = mysqli_query($this->conn, $query);
        if ($result) {
            $row = mysqli_fetch_object($result);
            return $row;
        }
    }
    public function delete()
    {
        $query = "DELETE FROM `atomicprojectb20`.`birthday` WHERE `birthday`.`id` =" . $this->id;
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
        $query="UPDATE  `atomicprojectb20`.`birthday` SET `deleted_at` = '".$this->deleted_at."' WHERE `birthday`.`id` = ".$this->id;
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
        $_allDate=array();
        $query= "SELECT * FROM `birthday` WHERE `deleted_at` IS NOT NULL";
        $result= mysqli_query($this->conn,$query);
        while($row=mysqli_fetch_object($result)){
            $_allDate[]=$row;
        }
        return $_allDate;

    }
    public function recover(){
        $query="UPDATE `atomicprojectb20`.`birthday` SET `deleted_at` =NULL WHERE `birthday`.`id` = ".$this->id;
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
    public function recoverMultiple($idS=array())
    {
        if ((is_array($idS)) && count($idS) > 0) {
            $IDs = implode(",", $idS);
            $query = "UPDATE `atomicprojectb20`.`birthday` SET `deleted_at` =NULL WHERE `birthday`.`id` IN(" . $IDs . ")";
            $result = mysqli_query($this->conn, $query);
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
    public function deleteMultiple($idS=array())

    {
        if((is_array($idS))&& count($idS)>0){
            $IDs= implode(",",$idS);
            $query =  "DELETE FROM `atomicprojectb20`.`birthday` WHERE `birthday`.`id` IN(".$IDs.")";
            $result = mysqli_query($this->conn, $query);
            if ($result) {
                Message::message("<div class=\"alert alert-info\">
  <strong>Updated!</strong> Selected Data has been deleted successfully.
</div>");
                Utility::redirect('index.php');

            } else {
                Message::message("<div class=\"alert alert-danger\">
  <strong>Error!</strong>Selected  Data has not been deleted successfully.
</div>");
                Utility::redirect('index.php');


            }
        }


    }
    public function count(){
        $query="SELECT COUNT(*) AS totalItem FROM `birthday` WHERE `deleted_at` IS NULL ";
        $result= mysqli_query($this->conn,$query);
        $row= mysqli_fetch_assoc($result);
        return $row['totalItem'];
    }

    public function paginator($pageStartFrom=0,$Limit=5){
        $query="SELECT * FROM `birthday` WHERE `deleted_at` IS NULL LIMIT ".$pageStartFrom.",".$Limit;
        $result= mysqli_query($this->conn,$query);
        while($row=mysqli_fetch_object($result)){
            $_allDate[]=$row;
        }
        return $_allDate;

    }

// commit

}