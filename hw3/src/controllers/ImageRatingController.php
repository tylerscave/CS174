<?php
/**
 *COPYRIGHT (C) 2016 Tyler Jones. All Rights Reserved.
 * ImageRatingController.php is the controller for the main Image Rating System screen
 * Solves CS174 Hw3
 * @author Tyler Jones
*/
namespace soloRider\hw3\controllers;
use soloRider\hw3\models as B;
require_once(realpath(dirname(__FILE__) . '/../models/ImageModel.php'));
require_once "Controller.php";

class ImageRatingController extends Controller {
    private $imageModel;

    public function __construct() {
        $this->imageModel = new B\ImageModel();
    }

    /**
     * Used to handle form data coming from EmailView.
     * Should sanitize that data and check if the email within it was
     * valid.
     */
    function processRequest() {
        $data = [];
        if(isset($_REQUEST['logout'])) {
            session_destroy();
            unset($_REQUEST['login']);
            unset($_SESSION['ID']);
            $_SESSION['LOGIN'] = false;
        }
        $data = $this->getRecents();
        $this->view("imageRating")->render($data);
    }

    public function getRecents() {
        $allRecents = [];
        $recents = $this->imageModel->getRecentImages();
        $i = 0;
        foreach($recents as $imageData) {
            $recentImages = [];
            $recentImages['FILE'] = $imageData['fileName'];
            $recentImages['CAPTION'] = $imageData['caption'];
            $recentImages['USERNAME'] = $imageData['userName'];
            $recentImages['RATING'] = $imageData['rating'];
            $recentImages['DATE'] = $imageData['timeUploaded'];
            $allRecents[$i] = $recentImages;
            $i++;
        }
        return $allRecents;
    }

/*
    public function getRecents() {
        $recentImages = [];
        $recents = $this->imageModel->getRecentImages();
        $i = 1;
        foreach($recents as $imageData) {
            //echo $imageData['fileName'];
            //echo print_r($imageData);
            $file = "FILE" . $i;
            $caption = "CAPTION" . $i;
            $userName = "USERNAME" . $i;
            $rating = "RATING" . $i;
            $date = "DATE" . $i;
            $recentImages[$file] = $imageData['fileName'];
            $recentImages[$caption] = $imageData['caption'];
            $recentImages[$userName] = $imageData['userName'];
            $recentImages[$rating] = $imageData['rating'];
            $recentImages[$date] = $imageData['timeUploaded'];
            $i++;
        }
        return $recentImages;
    }
*/
}
