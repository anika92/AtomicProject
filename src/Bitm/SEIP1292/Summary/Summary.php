<?php
namespace App\Bitm\SEIP1292\Summary;
use App\Bitm\SEIP1292\Message\Message;
use App\Bitm\SEIP1292\Utility\Utility;


Class Summary
{
    public $id = "";
    public $name = "";
    public $name1 = "";
    public $summary = "";
    public $filterByTitle="";
    public $filterByDescription="";
    public $without_html="";
    public $search="";
    public $conn;
    public $deleted_at;

    public function prepare($data = "")
    {
        if (array_key_exists("name", $data)) {
            $this->name = $data['name'];
        }
        if (array_key_exists("summary", $data)) {
            $this->summary = $data['summary'];
            $this->without_html=strip_tags($data['summary']);
        }
        if (array_key_exists("id", $data)) {
            $this->id = $data['id'];
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

    public function store()
    {
        if ((!empty($this->summary)) && (!empty($this->name)))
            $query = "INSERT INTO `atomicprojectb20`.`summary` (`name`, `summary`,`without_html`) VALUES ('".$this->name."','".$this->summary."','".$this->without_html."')";
        //echo $query;
        $result = mysqli_query($this->conn, $query);
        if ($result) {
            Message::message("<div class=\"alert alert-success\">
  <strong>Success!</strong> Data has been stored successfully.
</div>");
            Utility::redirect('index.php');

        } else {
            Message::message("<div class=\"alert alert-info\">
  <strong>Error!</strong> Data has been stored successfully.
</div>");
            Utility::redirect('index.php');

        }

    }


    public  function index(){
        $_allSummery=array();
        $whereClause= " 1=1 ";
        if(!empty($this->filterByTitle)) {
            $whereClause .= " AND name LIKE '%".$this->filterByTitle."%'";
        }
        if(!empty($this->filterByDescription)){
            $whereClause .= " AND summary LIKE '%".$this->filterByDescription."%'";
        }
        if(!empty($this->search)){
            $whereClause .= " AND summary LIKE '%".$this->search."%' OR  name LIKE '%".$this->search."%'";
        }
        $query= "SELECT * FROM `summary` WHERE `deleted_at` IS NULL AND ".$whereClause;
        //echo $query;
        $result= mysqli_query($this->conn,$query);
        while($row=mysqli_fetch_object($result)){
            $_allSummery[]=$row;
        }
        return $_allSummery;
    }
    public function view()
    {
        $query = "SELECT * FROM `summary` WHERE `id`=" . $this->id;
        $result = mysqli_query($this->conn, $query);
        if ($result) {
            $row = mysqli_fetch_object($result);
            return $row;
        }
    }
    public function update()
    {
        $query = "UPDATE `atomicprojectb20`.`summary` SET `summary` = '{$this->summary}', `without_html` = '{$this->without_html}' WHERE `summary`.`id` = ".$this->id;
        $result = mysqli_query($this->conn, $query);
        if ($result) {
            Message::message("<div class=\"alert alert-info\">
  <strong>Updated!</strong> Data has been updated successfully.
</div>");
            Utility::redirect('index.php');

        } else {
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

    public function trash()
    {
        $this->deleted_at = time();
        $query = "UPDATE `atomicprojectb20`.`summary` SET `deleted_at` = '" . $this->deleted_at . "' WHERE `summary`.`id` = " . $this->id;
        $result = mysqli_query($this->conn, $query);
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

    public function trashed()
    {
        $_allSummary = array();
        $query = "SELECT * FROM `summary` WHERE `deleted_at` IS NOT NULL";
        $result = mysqli_query($this->conn, $query);
        while ($row = mysqli_fetch_object($result)) {
            $_allSummary[] = $row;
        }
        return $_allSummary;

    }

    public function recover()
    {
        $query = "UPDATE `atomicprojectb20`.`summary` SET `deleted_at` =NULL WHERE `summary`.`id` = " . $this->id;
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
            $query = "UPDATE `atomicprojectb20`.`summary` SET `deleted_at` =NULL WHERE `summary`.`id` IN(" . $IDs . ")";
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
            $query = "DELETE FROM `atomicprojectb20`.`summary` WHERE `summary`.`id` IN(" . $IDs . ")";
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
    public function count()
    {
        $query = "SELECT COUNT(*) AS totalItem FROM `summary` WHERE `deleted_at` IS NULL ";
        $result = mysqli_query($this->conn, $query);
        if ($result) {
            $row = mysqli_fetch_assoc($result);

            return $row['totalItem'];
        }
    }
    public function paginator($pageStartFrom=0,$Limit=5){
        $query="SELECT * FROM `summary` WHERE `deleted_at` IS NULL LIMIT ".$pageStartFrom.",".$Limit;
        $result= mysqli_query($this->conn,$query);

        $_allSum=array();
        if($result) {
            while ($row = mysqli_fetch_object($result)) {
                $_allSum[] = $row;
            }

            return $_allSum;
        }

    }
    public function allName(){
        $_allBook= array();
        $query="SELECT name FROM `summary`";
        $result= mysqli_query($this->conn,$query);
        while($row=mysqli_fetch_assoc($result)){
            $_allName[]=$row['name'];
        }
        return $_allName;
    }
    public function allDescription(){
        $_allDescription = array();
        $query="SELECT without_html FROM `summary`";
        $result= mysqli_query($this->conn,$query);
        while($row=mysqli_fetch_assoc($result)){
            $_allDescription[]=$row['without_html'];
        }
        return $_allDescription;
    }
}