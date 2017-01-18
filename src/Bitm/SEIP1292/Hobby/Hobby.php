<?php
namespace App\Bitm\SEIP1292\Hobby;
use App\Bitm\SEIP1292\Utility\Utility;
use App\Bitm\SEIP1292\Message\Message;

class Hobby
{
    public $id = "";
    public $name = "";

    public $hobby = "";
    public $conn = "";

    public function prepare($data = "")
    {
        if (array_key_exists("name", $data)) {
            $this->name = $data['name'];
        }
        if (array_key_exists("Hobby", $data)) {
            $this->hobby = $data['Hobby'];
        }
        if (array_key_exists("id", $data)) {
            $this->id = $data['id'];
        }
        //Utility::dd( $this);
        return $this;

    }

    public function __construct()
    {
        $this->conn = mysqli_connect("localhost", "root", "", "atomicprojectb20") or die("Database connection establish failed");
    }

    public function store()
    {
if((!empty($this->hobby)) && (!empty($this->name))) {
    $query = "INSERT INTO `atomicprojectb20`.`hobby` (`name`, `hobbies`) VALUES ('" . $this->name . "','" . $this->hobby . "')";

    $result = mysqli_query($this->conn, $query);
    if ($result) {
        Message::message("<div class=\"alert alert-success\">
  <strong>Success!</strong> Data has been stored successfully.
</div>");
        Utility::redirect('index.php');

    }
}
        else {
            Message::message("<div class=\"alert alert-danger\">
  <strong>Error!</strong> Data has been stored successfully.
</div>");
            Utility::redirect('index.php');

        }


    }

    public function index()
    {
        $allhobby = array();
        $query = "SELECT * FROM `hobby`";

        $result = mysqli_query($this->conn, $query);
        while ($row = mysqli_fetch_object($result)) {
            $allhobby[] = $row;
        }
        return $allhobby;
    }

    public function view()
    {
        $query = "SELECT * FROM `hobby` WHERE `id`=" . $this->id;
        $result = mysqli_query($this->conn, $query);
        $row = mysqli_fetch_object($result);
        return $row;
    }

    public function update()
    {
        $query = "UPDATE `atomicprojectb20`.`hobby` SET `name` = '{$this->name}', `hobbies` = '{$this->hobby}' WHERE `hobby`.`id` = $this->id";
       echo $query;
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
        $query = "DELETE FROM `atomicprojectb20`.`hobby` WHERE `hobby`.`id` =" . $this->id;
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
        $query = "UPDATE `atomicprojectb20`.`hobby` SET `deleted_at` = '" . $this->deleted_at . "' WHERE `hobby`.`id` = " . $this->id;
        $result = mysqli_query($this->conn, $query);
        if ($result) {
            Message::message("<div class=\"alert alert-info\">
<strong>Trashed!</strong>Data has been trashed successfully</div>");
            Utility::redirect('index.php');
        } else {
            Message::message("<div class=\"alert alert-danger\">
<strong>Trashed!</strong>Data has not been  trashed !!</div>");
            Utility::redirect('index.php');

        }
    }

    public function trashed()
    {

        $_allTrash = array();
        $query = "SELECT * FROM `hobby` WHERE `deleted_at` IS NOT NULL";
        $result = mysqli_query($this->conn, $query);
        while ($row = mysqli_fetch_object($result)) {
            $_allTrash[] = $row;
        }
        return $_allTrash;
    }

    public function recover()
    {
        $query = "UPDATE `atomicprojectb20`.`hobby` SET `deleted_at` =NULL WHERE `hobby`.`id` = " . $this->id;
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
            $query = "UPDATE `atomicprojectb20`.`hobby` SET `deleted_at` =NULL WHERE `hobby`.`id` IN(" . $IDs . ")";

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
            $query = "DELETE FROM `atomicprojectb20`.`hobby` WHERE `hobby`.`id` IN(" . $IDs . ")";
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
        $query="SELECT COUNT(*) AS totalItem FROM `hobby` WHERE `deleted_at` IS NULL ";
        $result= mysqli_query($this->conn,$query);
        $row= mysqli_fetch_assoc($result);
        return $row['totalItem'];
    }

    public function paginator($pageStartFrom=0,$Limit=5){
        $query="SELECT * FROM `hobby` WHERE `deleted_at` IS NULL LIMIT ".$pageStartFrom.",".$Limit;
        $result= mysqli_query($this->conn,$query);
        while($row=mysqli_fetch_object($result)){
            $_allHobby[]=$row;
        }
        return $_allHobby;

    }

}