<?php
namespace App\Bitm\SEIP1292\Summary;
use App\Bitm\SEIP1292\Message\Message;
use App\Bitm\SEIP1292\Utility\Utility;


Class Summary{
    public $id="";
    public $name="";
    public $summary="";
    public $conn;
    public $deleted_at;

    public function prepare($data="")
    {
        if (array_key_exists("name", $data)) {
            $this->name = $data['name'];
        }
        if (array_key_exists("summary", $data)) {
            $this->summary = $data['summary'];
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
        $query="INSERT INTO `atomicprojectb20`.`summary` (`name`, `summary`) VALUES ('".$this->name."','".$this->summary."')";
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
        $_allsummary=array();
        $query= "SELECT * FROM `summary` WHERE `deleted_at` IS NULL";
        $result= mysqli_query($this->conn,$query);
        while($row=mysqli_fetch_object($result)){
            $_allsummary[]=$row;
        }
        return $_allsummary;
    }

    public function view(){
        $query="SELECT * FROM `summary` WHERE `id`=".$this->id;
        $result= mysqli_query($this->conn,$query);
        $row= mysqli_fetch_assoc($result);
        return $row;
    }

    public function update(){
        $query="UPDATE `atomicprojectb20`.`summary` SET `name` = '".$this->name."' WHERE `summary`.`id` = ".$this->id;
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
        $query = "DELETE FROM `atomicprojectb20`.`summary` WHERE `summary`.`id` =" . $this->id;
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
        $query="UPDATE `atomicprojectb20`.`summary` SET `deleted_at` = '".$this->deleted_at."' WHERE `summary`.`id` = ".$this->id;
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
        $_allSummary=array();
        $query= "SELECT * FROM `summary` WHERE `deleted_at` IS NOT NULL";
        $result= mysqli_query($this->conn,$query);
        while($row=mysqli_fetch_object($result)){
            $_allSummary[]=$row;
        }
        return $_allSummary;

    }
    public function recover(){
        $query="UPDATE `atomicprojectb20`.`summary` SET `deleted_at` =NULL WHERE `summary`.`id` = ".$this->id;
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
            $query="UPDATE `atomicprojectb20`.`summary` SET `deleted_at` =NULL WHERE `summary`.`id` IN(".$IDs.")";
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

    public function deleteMultiple($idS=array())
    {
        if((is_array($idS))&& count($idS)>0){
            $IDs= implode(",",$idS);
            $query = "DELETE FROM `atomicprojectb20`.`summary` WHERE `summary`.`id` IN(".$IDs.")";
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


    }



}