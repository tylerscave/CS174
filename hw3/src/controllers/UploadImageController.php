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

    /**
     * Constructor for UploadImageController is used to instanciate 
     * a ImageModel object
     */
    public function __construct() {
        $this->imageModel = new B\ImageModel();
    }

    /**
     * processRequest is used to handle form data coming from UploadImageView.
     * It will sanitize and validate the file and the caption. The file must be a
     * valid jpeg file under 2mb to validate
     */
    function processRequest() {
        $data = [];
        if(isset($_FILES['imageFile'])) {
            $data['UPLOADED_FILE'] = $this->sanitize("imageFile", "file");
            $data['UPLOADED_FILE_VALID'] = $this->validate($data['UPLOADED_FILE'], "file");
            $data['UPLOADED_CAPTION'] = $this->sanitize("imageCaption", "string");
            if($data['UPLOADED_FILE_VALID']) {
                $file = $this->imageModel->prepareToStore($data['UPLOADED_CAPTION'], $_SESSION['ID']);
                if(isset($file)) {
                    $data['UPLOAD_SUCCESS'] = true;
                } else {
                    $data['UPLOAD_SUCCESS'] = false;
                }
            }
        }
        $this->view("uploadImage")->render($data);
    }
}
