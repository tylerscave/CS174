<?php
/**
 *COPYRIGHT (C) 2016 Tyler Jones. All Rights Reserved.
 * ImageModel.php is the model for the image
 * Solves CS174 Hw3
 * @author Tyler Jones
*/
namespace soloRider\hw3\models;
require_once "UserModel.php";
require_once "Model.php";

class ImageModel extends Model {
    private $conn;
    //private $user;

    public function __construct() {
        $this->conn = $this->connectToDB();
        $this->user = new UserModel();
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
        $rows = [];
        $recent_query = "SELECT * FROM IMAGE ORDER BY timeUploaded DESC LIMIT 3";
        $result = $this->conn->query($recent_query);
        while($row = $result->fetch_assoc()) {
            $id = $row['id'];
            $fileName = $row['fileName'];
            $row['timeUploaded'] = date('M j Y g:i A', strtotime($row['timeUploaded']));
            $row['userName'] =$this->user->getUserName($id);
            $rating_query = "SELECT AVG(rating) average FROM RATING WHERE fileName='$fileName'";
            $rating_result = $this->conn->query($rating_query);
            $obj = $rating_result->fetch_object();
            if(isset($obj) && $obj->average > 0) {
                $row['rating'] = round($obj->average);
            } else {
                $row['rating'] = "Not rated yet, be the first!";
            }
            $rows[] = $row;
        }
        return $rows;
    }

    public function getPopularImages() {
        $popular_query = "SELECT * FROM IMAGE ORDER BY rating DESC, timeUploaded DESC LIMIT 10";
        $result = $this->conn->query($popular_query);
        while($row = $result->fetch_assoc()) {
            $rows[] = $row;
        }
        return $rows;
    }

    public function setRating($id, $fileName, $rating) {

    }

}
