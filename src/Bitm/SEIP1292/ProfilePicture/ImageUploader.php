<?php
namespace App\Bitm\SEIP1292\ProfilePicture;
use App\Bitm\SEIP1292\Message\Message;
use App\Bitm\SEIP1292\Utility\Utility;


class ImageUploader{
    public $id="";
    public $name="";
    public $image_name="";
    public $conn;
    public $deleted_at;
    public $active;
    public function __construct(){
        $this->conn= mysqli_connect("localhost","root","","atomicprojectb20") or die("Database connection establish failed");
    }

    public function prepare($data=Array())
    {
        if (array_key_exists("name", $data)) {
            $this->name = $data['name'];
        }
        if (array_key_exists("image", $data)) {
            $this->image_name = $data['image'];
        }
        if (array_key_exists("id", $data)) {
            $this->id = $data['id'];
        }
        return $this;
    }


    public function store(){
        if((!empty($this->image_name)) && (!empty($this->name))) {


            $query = "INSERT INTO `atomicprojectb20`.`profilepicture` (`name`, `images`) VALUES ('{$this->name}', '{$this->image_name}')";
            //echo $query;
            $result = mysqli_query($this->conn, $query);
            if ($result) {
                Message::message("Data has been stored successfully");
                Utility::redirect('index.php');
            }
        }
        else {
            Message::message("Data has not been stored successfully");
            Utility::redirect('index.php');
        }
    }

    public  function index(){
        $_allInfo=array();
        $query= "SELECT * FROM `profilepicture`  WHERE `deleted_at` IS NULL";
        $result= mysqli_query($this->conn,$query);
        while($row=mysqli_fetch_object($result)){
            $_allInfo[]=$row;
        }
        return $_allInfo;
    }

    public function view(){
        $query="SELECT * FROM `profilepicture` WHERE `id`=".$this->id;
        $result= mysqli_query($this->conn,$query);
        $row= mysqli_fetch_object($result);
        return $row;
    }

    public function update(){
        if(!empty($this->image_name)) {
            $query = "UPDATE `atomicprojectb20`.`profilepicture` SET `name` = '{$this->name}', `images` = '{$this->image_name}' WHERE `profilepicture`.`id` =" . $this->id;
        }else{
            $query = "UPDATE `atomicprojectb20`.`profilepicture` SET `name` = '{$this->name}' WHERE `profilepicture`.`id` =" . $this->id;
        }
        $result= mysqli_query($this->conn,$query);
        if($result){
            Message::message("Data has been updated successfully");
            Utility::redirect('index.php');
        }
        else {
            Message::message("Data has not been updated successfully");
            Utility::redirect('index.php');
        }
    }

    public function delete(){
        $query= "DELETE FROM `atomicprojectb20`.`profilepicture` WHERE `profilepicture`.`id` = ".$this->id;
        $result= mysqli_query($this->conn,$query);
        if($result){
            Message::message("Data has been deleted successfully");
            Utility::redirect('index.php');
        }
        else {
            Message::message("Data has not been deleted successfully");
            Utility::redirect('index.php');
        }

    }
    public function  trash(){
    $this->deleted_at=time();
        $query="UPDATE `atomicprojectb20`.`profilepicture` SET `deleted_at` = '{$this->deleted_at}}' WHERE `profilepicture`.`id` = $this->id";
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


public  function  trashed(){
$_allPic=array();
    $query= "SELECT * FROM `profilepicture` WHERE `deleted_at` IS NOT NULL ";
    $result= mysqli_query($this->conn,$query);
    while($row=mysqli_fetch_object($result)){
                $_allPic[]=$row;
            }
            return $_allPic;


    }



    public function recover(){
        $query="UPDATE `atomicprojectb20`.`profilepicture` SET `deleted_at` =NULL WHERE `profilepicture`.`id` = ".$this->id;
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
            $query = "UPDATE `atomicprojectb20`.`profilepicture` SET `deleted_at` =NULL WHERE `profilepicture`.`id` IN(" . $IDs . ")";
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
            $query =  "DELETE FROM `atomicprojectb20`.`profilepicture` WHERE `profilepicture`.`id` IN(".$IDs.")";
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
        $query="SELECT COUNT(*) AS totalItem FROM `profilepicture` WHERE `deleted_at` IS NULL ";
        $result= mysqli_query($this->conn,$query);
        $row= mysqli_fetch_assoc($result);
        return $row['totalItem'];
    }

    public function paginator($pageStartFrom=0,$Limit=5)
    {
        $query = "SELECT * FROM `profilepicture` WHERE `deleted_at` IS NULL LIMIT " . $pageStartFrom . "," . $Limit;
        $result = mysqli_query($this->conn, $query);
        $_allPic = array();
        if ($result) {
            while ($row = mysqli_fetch_object($result)) {
                $_allPic[] = $row;
            }
            return $_allPic;

        }
    }



    public function  makeActive()
    {

            $this->active = time();
            $query = "UPDATE `atomicprojectb20`.`profilepicture` SET `active` = '{$this->active}' WHERE `profilepicture`.`id` = $this->id";
            $result = mysqli_query($this->conn, $query);
            if ($result) {

                Utility::redirect('../../../index.php');

            }
        else {

                Utility::redirect('../../../index.php');


            }

        }


    public  function  showActive(){
        $_allPic=array();
        $query= "SELECT * FROM `profilepicture` WHERE `active` IS NOT NULL ";

        $result= mysqli_query($this->conn,$query);

        while($row=mysqli_fetch_object($result)){
            $_allPic[]=$row;
        }
        return $_allPic;


    }

    public function deActive(){
        $query="UPDATE `atomicprojectb20`.`profilepicture` SET `active` =NULL WHERE `profilepicture`.`id` = ".$this->id;
        $result=mysqli_query($this->conn,$query);
        if ($result) {

            Utility::redirect('index.php');

        } else {

            Utility::redirect('index.php');


        }


    }

}
