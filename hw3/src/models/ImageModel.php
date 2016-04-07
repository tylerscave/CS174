<?php
/**
 *COPYRIGHT (C) 2016 Tyler Jones. All Rights Reserved.
 * ImageModel.php is the model for the image
 * Solves CS174 Hw3
 * @author Tyler Jones
*/
namespace soloRider\hw3\models;
require_once "Model.php";

class ImageModel extends Model {
    private $conn;

    public function __construct() {
        $this->conn = $this->connectToDB();
    }

    public function storeImageData($fileName, $id, $caption) {
        $file_query = "SELECT * FROM IMAGE WHERE fileName='$fileName' AND id='$id'";
        //checking user already uploaded this file
        $check =  $this->conn->query($file_query) ;
        $rowCount = $check->num_rows;
        //if the file is not in the table, add it
        if ($rowCount == 0){
            $sql = "INSERT INTO IMAGE SET fileName='$fileName', id='$id', caption='$caption'";
            $success = ($this->conn->query($sql) or die(mysqli_connect_errno() . "Data cannot inserted"));
            return $success;
        } else {
            return false;
        }
        //mysqli_close($this->conn);
    }

    public function getRecentImages() {
        $recent_query = "SELECT * FROM IMAGE ORDER BY timeUploaded DESC LIMIT 3";
        $result = $this->conn->query($recent_query);
        while($row = $result->fetch_assoc()) {
            $rows[] = $row;
        }
        return $rows;
    }

    public function getPopularImages() {
        $popular_query = "SELECT * FROM IMAGE ORDER BY rating DESC LIMIT 10";
        $result = $this->conn->query($popular_query);
        while($row = $result->fetch_assoc()) {
            $rows[] = $row;
        }
        return $rows;
    }

    public function setRating($rating) {

    }

}
