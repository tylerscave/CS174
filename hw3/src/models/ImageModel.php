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
    private $user;

    /**
     * Constructor for ImageModel is used to instanciate 
     * a UserModel object and a connection to mysql
     */
    public function __construct() {
        $this->conn = $this->connectToDB();
        $this->user = new UserModel();
    }

    /**
     * prepareToStore resizes the selected image and looks at exif data to orient it correctly.
     * It then calls storeImageData to store data to database. If the database processing
     * succeeds, the image is stored in the resources folder
     */
    function prepareToStore($caption, $sessionID) {
        $targetDir = realpath(dirname(__FILE__)) . '/../resources/images';
        //create new directory for images if one does not already exist
        if(!is_dir($targetDir)) {
            mkdir($targetDir, 0777, true);
        }
        //calculate new image height to preserve ratio
        list($w, $h) = getimagesize($_FILES['imageFile']['tmp_name']);
        $newWidth = 500;
        $newHeight = ($h/$w) * $newWidth;
        //new filename for uploaded file
        $uniq = uniqid();
        $fileName = $_FILES['imageFile']['name'];
        $newFileName = $targetDir . '/' . $uniq . '_' . $fileName;
        $simpleNewFileName = $uniq . '_' . $fileName;
        //read binary data from image file
        $imgString = file_get_contents($_FILES['imageFile']['tmp_name']);
        //create image from string
        $image = imagecreatefromstring($imgString);
        //correct orientation based on exif data using GD function
        $exif = exif_read_data($_FILES['imageFile']['tmp_name']);
        if(!empty($exif['Orientation'])) {
            switch($exif['Orientation']) {
                case 8:
                    $image = imagerotate($image,90,0);
                    break;
                case 3:
                    $image = imagerotate($image,180,0);
                    break;
                case 6:
                    $image = imagerotate($image,-90,0);
                    break;
            }
        }
        $tmp = imagecreatetruecolor($newWidth, $newHeight);
        imagecopyresampled($tmp, $image, 0, 0, 0, 0, $newWidth, $newHeight, $w, $h);
        //Save image
        $success = $this->storeImageData($simpleNewFileName, $sessionID, $caption);
        if($success) {
            imagejpeg($tmp, $newFileName, 100);
        }
        return $newFileName;
        //cleanup
        imagedestroy($image);
        imagedestroy($tmp);
    }

    /**
     * storeImageData is responsible for storing the image data into the database
     */
    private function storeImageData($fileName, $id, $caption) {
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
    }

    /**
     * getRecentImages is used to get the 3 most recently stored Images from the
     * database in order of recentness. This function returns an array of needed image data
     */
    public function getRecentImages() {
        $rows = [];
        $recent_query = "SELECT * FROM IMAGE ORDER BY timeUploaded DESC LIMIT 3";
        $result = $this->conn->query($recent_query);
        while($row = $result->fetch_assoc()) {
            $id = $row['id'];
            $fileName = $row['fileName'];
            $row['timeUploaded'] = date('M j Y g:i A', strtotime($row['timeUploaded']));
            $row['userName'] =$this->user->getUserName($id);
            $rating_query = "SELECT totalRating, totalVotes FROM RATING WHERE fileName='$fileName'";
            $rating_result = $this->conn->query($rating_query);
            if($obj = $rating_result->fetch_object()) {
                $row['rating'] = round(($obj->totalRating) / ($obj->totalVotes), 1);
            } else {
                $row['rating'] = "Not rated yet, be the first!";
            }
            $rows[] = $row;
        }
        return $rows;
    }

    /**
     * getPopularImages is used to get the 10 most popular Images based on ratings
     * from the database. This function returns an array of needed image data sorted
     * in decending order by most popular with ties broken by recentness.
     */
    public function getPopularImages() {
        $rows = [];
        //get at most 10 most popular images sorted by popularity
        $popular_query = "SELECT * FROM RATING ORDER BY totalRating/totalVotes DESC LIMIT 10";
        $rating_result1 = $this->conn->query($popular_query);
        while($rating_row = $rating_result1->fetch_assoc()) {
            $fileName_query = $rating_row['fileName'];
            $image_query = "SELECT * FROM IMAGE WHERE fileName = '$fileName_query'";
            $image_result = $this->conn->query($image_query);
            if($row = $image_result->fetch_assoc()) {
                $id = $row['id'];
                $fileName = $row['fileName'];
                $row['unixTime'] = strtotime($row['timeUploaded']);
                $row['timeUploaded'] = date('M j Y g:i A', strtotime($row['timeUploaded']));
                $row['userName'] =$this->user->getUserName($id);
                $rating_query = "SELECT totalRating, totalVotes FROM RATING WHERE fileName='$fileName'";
                $rating_result = $this->conn->query($rating_query);
                if($obj = $rating_result->fetch_object()) {
                    $row['rating'] = round(($obj->totalRating) / ($obj->totalVotes), 1);
                } else {
                    $row['rating'] = "Not rated yet, be the first!";
                }
                $rows[] = $row;
            }
        }
        //now sort images based on timeUploaded
        foreach($rows as $key => $val) {
            if(isset($rows[$key+1])) {
                if(($rows[$key]['rating'] === $rows[$key+1]['rating']) &&
                        ($rows[$key]['unixTime'] < $rows[$key+1]['unixTime'])) {
                    $tmp = $rows[$key];
                    $rows[$key] = $rows[$key+1];
                    $rows[$key+1] = $tmp;
                }
            }
        }
        return $rows;
    }

    /**
     * setRating sets ratings for specific images and records which user
     * has voted on what. It returns true in the case of a successfully
     * stored rating and vote
     */
    public function setRating($id, $fileName, $rating) {
        $rating_query = "SELECT * FROM RATING WHERE fileName = '$fileName'";
        //checking if the fileName already exists
        $check = $this->conn->query($rating_query);
        $rowCount = $check->num_rows;
        //if the fileName is not in the table, create new rating
        if($rowCount == 0) {
            $rating_insert = "INSERT INTO RATING SET fileName='$fileName', totalRating='$rating', totalVotes=1"; 
            $rating_success = ($this->conn->query($rating_insert) or 
                                die(mysqli_connect_errno() . "Data cannot inserted"));
        //if fileName exists update the rating for that image
        } else {
            $rating_update = "UPDATE RATING SET totalRating=totalRating+'$rating', totalVotes=totalVotes+1 
                        WHERE fileName='$fileName'";
            $rating_success = ($this->conn->query($rating_update) or 
                                die(mysqli_connect_errno() . "Data cannot inserted"));
        }
        //record that this user has voted on this image if the rating was successful
        if($rating_success) {
            $vote_insert = "INSERT INTO VOTES SET id='$id', fileName='$fileName'";
            $vote_success = ($this->conn->query($vote_insert) or 
                                die(mysqli_connect_errno() . "Data cannot inserted"));
        }
        if($vote_success) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * checkVotes is used to see if the user has already voted on the 
     * specific image or not. It returns true if they have
     */
    public function checkVotes($id, $fileName) {
        $votes_query = "SELECT * FROM VOTES WHERE id='$id' and fileName='$fileName'";
        $check =  $this->conn->query($votes_query) ;
        $rowCount = $check->num_rows;
        if ($rowCount > 0) {
            return true;
        } else {
            return false;
        }
        mysqli_stmt_close($stmt);
    }
}
