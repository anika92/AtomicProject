<?php
namespace App\Bitm\SEIP1292\Book;


Class Book{
    public $id="";
    public $title="";
    public $conn;

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
            echo "Data has been inserted sucessfully";
        }
        else {
            echo "Some error";
        }

    }










}