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
/*
        $data['UPLOADED_FILE'] = $this->sanitize("imageFile", "file");
        $data['UPLOADED_FILE_VALID'] = $this->validate($data['UPLOADED_FILE'], "file");
        $data['UPLOADED_CAPTION'] = $this->sanitize("imageCaption", "string");
//do all of the $_FILES stuff in Controller->sanitize

//move_uploaded_file ($_FILES['uploadFile'] ['tmp_name'], "../resources/{$_FILES['uploadFile'] ['name']}");
$valid_format = "jpeg";
$dir = "../resources/";
        if($data['UPLOADED_FILE_VALID']) {
            $uniq = base_convert(uniqid(), 16, 10);
$tmp = tempnam(sys_get_temp_dir(), $data['UPLOADED_FILE']);
            //$tmp = $_FILES['file']['tmp_name'];
            $uniq_file_name = $uniq.".".$valid_format;
            if(move_uploaded_file($tmp, $dir.$uniq_file_name)) {



                //$image_query = "INSERT INTO files (id, file) VALUES (null, '{$uniq_file_name}')";
                //$success = ($this->conn->query($image_query) or die(mysqli_connect_errno() . "Data cannot inserted"))
                $msg = "Uploading successful!";
            } else {
                $msg = "Problem while moving file";
            }
        }


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



// settings
$max_file_size = 1024*1024; //1mb
$valid_ext = 'jpeg';

if ($_SERVER['REQUEST_METHOD'] == 'POST' AND isset($_FILES['imageFile'])) {
  if( $_FILES['imageFile']['size'] < $max_file_size ){
    // get file extension
    $ext = strtolower(pathinfo($_FILES['imageFile']['name'], PATHINFO_EXTENSION));
    if($ext == $valid_ext) {
echo "the ext is = " . $ext . "<br>";
$sizeData = getimagesize($_FILES['imageFile']['tmp_name']);
$width = $sizeData[0];
    $file = $this->resize();
echo "the file is = " . $file . "<br>";
    } else {
      $msg = 'Unsupported file';
    }
  } else{
    $msg = 'Please upload image smaller than 200KB';
  }
if(isset($msg)){echo "the message is = " . $msg;}
}


        $this->view("uploadImage")->render($data);
    }



function resize(){
$targetDir = realpath(dirname(__FILE__)) . '/../resources/images';
  /* Get original image x y*/
  list($w, $h) = getimagesize($_FILES['imageFile']['tmp_name']);

//calculate new image height to preserve ratio
$newWidth = 500;
$newHeight = ($h/$w) * $newWidth;


if(!is_dir($targetDir)) {
mkdir($targetDir, 0777, true);
}
  /* new file name */
  $path = $targetDir . '/' . $newWidth.'x'.$newHeight.'_'.$_FILES['imageFile']['name'];




echo "the path is = " . $path . "<br>";
  /* read binary data from image file */
  $imgString = file_get_contents($_FILES['imageFile']['tmp_name']);
  /* create image from string */
  $image = imagecreatefromstring($imgString);
  $tmp = imagecreatetruecolor($newWidth, $newHeight);
  imagecopyresampled($tmp, $image, 0, 0, 0, 0, $newWidth, $newHeight, $w, $h);
  /* Save image */
  if($_FILES['imageFile']['type'] == 'image/jpeg') {
      imagejpeg($tmp, $path, 100);
  }
  return $path;
  /* cleanup memory */
  imagedestroy($image);
  imagedestroy($tmp);
}


}
