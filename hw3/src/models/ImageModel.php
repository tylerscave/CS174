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
    private $fileName;
    private $caption;
    private $rating;
    private $timeUploaded;

    public function __construct() {
        $this->conn = this->connectToDB();
    }

    public function getAllImages() {

    }

    private function getFileName() {
        return $fileName;
    }

    private function getCaption() {
        return $caption;
    }

    private function getRating() {
        return $rating;
    }

    private function getTimeUploaded() {
        return $timeUploaded;
    }

    private function setFileName ($fileName) {
        this->fileName = $fileName;
    }

    private function getPassword($pwd) {
        this->pwd = $pwd;
    }

}
