<?php
namespace App\Bitm\SEIP1292\City;
use App\Bitm\SEIP1292\Message\Message;
use App\Bitm\SEIP1292\Utility\Utility;

Class City
{
    public $id = "";
    public $name = "";
    public $city = "";
    public $conn;
    public $filterByTitle="";
    public $filterByDescription="";

    public $search="";
    public $deleted_at;

    public function prepare($data = "")
    {
        if (array_key_exists("name", $data)) {
            $this->name = $data['name'];
        }
        if (array_key_exists("id", $data)) {
            $this->id = $data['id'];
        }
        if (array_key_exists("city", $data)) {
            $this->city = $data['city'];
        }
        if (array_key_exists("filterByTitle", $data)) {
            $this->filterByTitle = $data['filterByTitle'];
        }
        if (array_key_exists("filterByDescription", $data)) {
            $this->filterByDescription = $data['filterByDescription'];
        }
        if (array_key_exists("search", $data)) {
            $this->search = $data['search'];
        }
        return $this;
    }

    public function __construct()
    {
        $this->conn = mysqli_connect("localhost", "root", "", "atomicprojectb20") or die("Database connection establish failed");
    }
    public function store(){
        $query="INSERT INTO `atomicprojectb20`.`city` ( `name`, `city`) VALUES ( '{$this->name}','{$this->city}');";
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
        $_allCity=array();
        $whereClause= " 1=1 ";
        if(!empty($this->filterByTitle)) {
            $whereClause .= " AND name LIKE '%".$this->filterByTitle."%'";
        }
        if(!empty($this->filterByDescription)){
            $whereClause .= " AND city LIKE '%".$this->filterByDescription."%'";
        }
        if(!empty($this->search)){
            $whereClause .= " AND city LIKE '%".$this->search."%' OR  name LIKE '%".$this->search."%'";
        }
        $query= "SELECT * FROM `city` WHERE `deleted_at` IS NULL AND ".$whereClause;
        //echo $query;
        $result= mysqli_query($this->conn,$query);
        while($row=mysqli_fetch_object($result)){
            $_allCity[]=$row;
        }
        return $_allCity;
    }


    public function view(){
        $query="SELECT * FROM `city` WHERE `id`=".$this->id;
        $result= mysqli_query($this->conn,$query);
        $row= mysqli_fetch_object($result);
        return $row;
    }

    public function update(){

        $query="UPDATE `atomicprojectb20`.`city` SET `name` = '{$this->name}',`city` = '{$this->city}' WHERE `city`.`id` = $this->id;";


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
        $query = "DELETE FROM `atomicprojectb20`.`city` WHERE `city`.`id` =" . $this->id;
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
        $query="UPDATE `atomicprojectb20`.`city` SET `deleted_at` = '".$this->deleted_at."' WHERE `city`.`id` = ".$this->id;
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
        $query= "SELECT * FROM `city` WHERE `deleted_at` IS NOT NULL";
        $result= mysqli_query($this->conn,$query);
        while($row=mysqli_fetch_object($result)){
            $_allBook[]=$row;
        }
        return $_allBook;

    }

    public function recover()
    {
        $query = "UPDATE `atomicprojectb20`.`city` SET `deleted_at` =NULL WHERE `city`.`id` = " . $this->id;
        $result = mysqli_query($this->conn, $query);
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

    public function recoverMultiple($idS = array())
    {
        if ((is_array($idS)) && count($idS) > 0) {
            $IDs = implode(",", $idS);
            $query = "UPDATE `atomicprojectb20`.`city` SET `deleted_at` =NULL WHERE `city`.`id` IN(" . $IDs . ")";

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

    public function deleteMultiple($idS = array())

    {
        if ((is_array($idS)) && count($idS) > 0) {
            $IDs = implode(",", $idS);
            $query = "DELETE FROM `atomicprojectb20`.`city` WHERE `city`.`id` IN(" . $IDs . ")";
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
        $query="SELECT COUNT(*) AS totalItem FROM `city` WHERE `deleted_at` IS NULL ";
        $result= mysqli_query($this->conn,$query);
        $row= mysqli_fetch_assoc($result);
        return $row['totalItem'];
    }

    public function paginator($pageStartFrom=0,$Limit=5){
        $query="SELECT * FROM `city` WHERE `deleted_at` IS NULL LIMIT ".$pageStartFrom.",".$Limit;
        $result= mysqli_query($this->conn,$query);
        while($row=mysqli_fetch_object($result)){
            $_allCity[]=$row;
        }
        return $_allCity;

    }

    public function allName(){
        $_allName= array();
        $query="SELECT name FROM `city`";
        $result= mysqli_query($this->conn,$query);
        while($row=mysqli_fetch_assoc($result)){
            $_allName[]=$row['name'];
        }
        return $_allName;
    }

    public function allCity(){
        $_allCity= array();
        $query="SELECT city FROM `city`";
        $result= mysqli_query($this->conn,$query);
        while($row=mysqli_fetch_assoc($result)){
            $_allCity[]=$row['city'];
        }
        return $_allCity;
    }
}