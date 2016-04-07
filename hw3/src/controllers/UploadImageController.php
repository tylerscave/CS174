<?php
/**
 *COPYRIGHT (C) 2016 Tyler Jones. All Rights Reserved.
 * UploadImageController.php is the controller for the upload an image screen
 * Solves CS174 Hw3
 * @author Tyler Jones
*/
namespace soloRider\hw3\controllers;
use soloRider\hw3\models as B;
require_once(realpath(dirname(__FILE__) . '/../models/ImageModel.php'));
require_once "Controller.php";

class UploadImageController extends Controller {
    private $imageModel;

    public function __construct() {
        $this->imageModel = new B\ImageModel();
    }

    /**
     * processRequest is used to handle form data coming from UploadImageView.
     * It will sanitize and validate the file and the caption. The file must be a
     * valid jpeg file under 1mb to validate
     */
    function processRequest() {
        $data = [];
        if(isset($_FILES['imageFile'])) {
            $data['UPLOADED_FILE'] = $this->sanitize("imageFile", "file");
            $data['UPLOADED_FILE_VALID'] = $this->validate($data['UPLOADED_FILE'], "file");
            $data['UPLOADED_CAPTION'] = $this->sanitize("imageCaption", "string");
            if($data['UPLOADED_FILE_VALID']) {
                $file = $this->prepareToStore($data['UPLOADED_CAPTION'], $_SESSION['ID']);
                if(isset($file)) {
                    $data['UPLOAD_SUCCESS'] = true;
                } else {
                    $data['UPLOAD_SUCCESS'] = false;
                }
            }
        }
        $this->view("uploadImage")->render($data);
    }

    /**
     * prepareToStore resizes the selected image and looks at exif data to orient it correctly.
     * It then calls storeImageData in the ImageModel class to store data to database. If the
     * database processing succeeds, the image is stored in the resources folder
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
        $success = $this->imageModel->storeImageData($simpleNewFileName, $sessionID, $caption);
        if($success) {
            imagejpeg($tmp, $newFileName, 100);
        }
        return $newFileName;
        //cleanup
        imagedestroy($image);
        imagedestroy($tmp);
    }
}
