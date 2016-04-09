<?php
/**
 *COPYRIGHT (C) 2016 Tyler Jones. All Rights Reserved.
 * ImageRatingController.php is the controller for the main Image Rating System screen
 * Solves CS174 Hw3
 * @author Tyler Jones
*/
namespace soloRider\hw3\controllers;
require_once "Controller.php";

class ImageRatingController extends Controller {

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
        $this->view("imageRating")->render($data);
    }
}
