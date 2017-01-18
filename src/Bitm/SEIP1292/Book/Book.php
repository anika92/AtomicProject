<?php
namespace App\Bitm\SEIP1292\Book;
use App\Bitm\SEIP1292\Message\Message;

use App\Bitm\SEIP1292\Utility\Utility;
Class Book{
    public $id="";
    public $title="";

    public $description="";
    public $filterByTitle="";
    public $filterByDescription="";
    public $without_html="";
    public $search="";
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
    if (array_key_exists("description", $data)) {
        $this->description = $data['description'];
        $this->without_html=strip_tags($data['description']);
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

public function __construct(){
    $this->conn= mysqli_connect("localhost","root","","atomicprojectb20") or die("Database connection establish failed");
}
    public function store(){
        $query="INSERT INTO `atomicprojectb20`.`book` (`title`, `description`,`without_html`) VALUES ('".$this->title."','".$this->description."','".$this->without_html."')";
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
        $whereClause= " 1=1 ";
        if(!empty($this->filterByTitle)) {
            $whereClause .= " AND title LIKE '%".$this->filterByTitle."%'";
        }
        if(!empty($this->filterByDescription)){
            $whereClause .= " AND description LIKE '%".$this->filterByDescription."%'";
        }
        if(!empty($this->search)){
            $whereClause .= " AND description LIKE '%".$this->search."%' OR  title LIKE '%".$this->search."%'";
        }
        $query= "SELECT * FROM `book` WHERE `deleted_at` IS NULL AND ".$whereClause;
        //echo $query;
        $result= mysqli_query($this->conn,$query);
        while($row=mysqli_fetch_object($result)){
            $_allBook[]=$row;
        }
        return $_allBook;
    }

    public function view()
    {
        $query = "SELECT * FROM `book` WHERE `id`=" . $this->id;
        $result = mysqli_query($this->conn, $query);
        if ($result) {
            $row = mysqli_fetch_object($result);
            return $row;
        }
    }

    public function update(){
        $query="UPDATE `atomicprojectb20`.`book` SET `description` = '{$this->description}', `without_html` = '{$this->without_html}' WHERE `book`.`id` =". $this->id;
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
        $query="SELECT COUNT(*) AS totalItem FROM `book` WHERE `deleted_at` IS NULL ";
        $result= mysqli_query($this->conn,$query);
        $row= mysqli_fetch_assoc($result);
        return $row['totalItem'];
    }

    public function paginator($pageStartFrom=0,$Limit=5){
        $query="SELECT * FROM `book` WHERE `deleted_at` IS NULL LIMIT ".$pageStartFrom.",".$Limit;
        $result= mysqli_query($this->conn,$query);
        while($row=mysqli_fetch_object($result)){
            $_allBook[]=$row;
        }
        return $_allBook;

    }



    public function allTitle(){
        $_allBook= array();
        $query="SELECT title FROM `book`";
        $result= mysqli_query($this->conn,$query);
        while($row=mysqli_fetch_assoc($result)){
            $_allBook[]=$row['title'];
        }
        return $_allBook;
    }
    public function allDescription(){
        $_allBook= array();
        $query="SELECT without_html FROM `book`";
        $result= mysqli_query($this->conn,$query);
        while($row=mysqli_fetch_assoc($result)){
            $_allBook[]=$row['without_html'];
        }
        return $_allBook;
    }


}