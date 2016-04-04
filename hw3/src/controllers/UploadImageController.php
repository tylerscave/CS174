<?php
/**
 *COPYRIGHT (C) 2016 Tyler Jones. All Rights Reserved.
 * UploadImageController.php is the controller for the upload an image screen
 * Solves CS174 Hw3
 * @author Tyler Jones
*/
namespace soloRider\hw3\controllers;
use soloRider\hw3\models as B;
//require_once(realpath(dirname(__FILE__) . '/../models/ImageModel.php'));
require_once "Controller.php";

class UploadImageController extends Controller {
    private $user;

    public function __construct() {
        //$this->user = new B\ImageModel();
    }

    /**
     * Used to handle form data coming from EmailView.
     * Should sanitize that data and check if the email within it was
     * valid.
     */
    function processRequest() {
        $data = [];
        $data['UPLOADED_FILE'] = $this->sanitize("imageFile", "file");
        $data['UPLOADED_FILE_VALID'] = $this->validate("imageFile", "file");
        $data['UPLOADED_CAPTION'] = $this->sanitize("imageCaption", "string");

        //$fileName=$_FILES[" myimage "][ "name" ];
        //$folder="../resources";
        //move_uploaded_file($_FILES[" myimage "][" tmp_name "], "$folder".$_FILES[" myimage "][" name "]);

        //$result = $this->user->storeImage($fileName, $caption, $timeUploaded);


//$insert_path="INSERT INTO IMAGE VALUES('$folder','$upload_image')";
//$var=mysql_query($inser_path);

/*
$select_path="select * from image_table";
$var=mysql_query($select_path);
while($row=mysql_fetch_array($var))
{
    $image_name=$row["imagename"];
    $image_path=$row["imagepath"];
    echo "img src=".$image_path."/".$image_name." width=100 height=100";
}
*/


/*
$target_dir = "resources/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if($check !== false) {
        echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
    }
}
// Check if file already exists
if (file_exists($target_file)) {
    echo "Sorry, file already exists.";
    $uploadOk = 0;
}
// Check file size
if ($_FILES["fileToUpload"]["size"] > 500000) {
    echo "Sorry, your file is too large.";
    $uploadOk = 0;
}
// Allow certain file formats
if($imageFileType != "jpeg") {
    echo "Sorry, only JPEG files are allowed.";
    echo "the image type is " . $imageFileType;
    $uploadOk = 0;
}
// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
}
*/

        $this->view("uploadImage")->render($data);
    }
}
