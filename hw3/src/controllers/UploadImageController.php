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
        if(isset($_FILES['imageFile'])) {
            $data['UPLOADED_FILE'] = $this->sanitize("imageFile", "file");
            $data['UPLOADED_FILE_VALID'] = $this->validate($data['UPLOADED_FILE'], "file");
            if($data['UPLOADED_FILE_VALID']) {
                $file = $this->resize();
            }
            $data['UPLOADED_CAPTION'] = $this->sanitize("imageCaption", "string");
        }


/*
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
*/
        $this->view("uploadImage")->render($data);
    }



    function resize(){
        $targetDir = realpath(dirname(__FILE__)) . '/../resources/images';
        //create new directory for images if one does not already exist
        if(!is_dir($targetDir)) {
            mkdir($targetDir, 0777, true);
        }

        //Get original image width and height
        list($w, $h) = getimagesize($_FILES['imageFile']['tmp_name']);

        //calculate new image height to preserve ratio
        $newWidth = 500;
        $newHeight = ($h/$w) * $newWidth;


        //new filename for uploaded file
        $path = $targetDir . '/' . $newWidth.'x'.$newHeight.'_'.$_FILES['imageFile']['name'];
echo "the path is = " . $path . "<br>";

        //read binary data from image file
        $imgString = file_get_contents($_FILES['imageFile']['tmp_name']);
        //create image from string
        $image = imagecreatefromstring($imgString);
        $tmp = imagecreatetruecolor($newWidth, $newHeight);
        imagecopyresampled($tmp, $image, 0, 0, 0, 0, $newWidth, $newHeight, $w, $h);
        //Save image if correct type
        if($_FILES['imageFile']['type'] == 'image/jpeg') {
            $data['UPLOAD_SUCCESS'] = imagejpeg($tmp, $path, 100);
        }
        return $path;
        /* cleanup memory */
        imagedestroy($image);
        imagedestroy($tmp);
    }


}
