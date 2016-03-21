<?php
/**
 *COPYRIGHT (C) 2016 Tyler Jones. All Rights Reserved.
 * UploadImageController.php is the controller for the upload an image screen
 * Solves CS174 Hw3
 * @author Tyler Jones
*/
namespace soloRider\hw3\controllers;

class UploadImageController extends Controller {


//PASTED IN AS EXAMPLE NEED TO EDIT

    /**
     * Used to handle form data coming from EmailView.
     * Should sanitize that data and check if the email within it was
     * valid.
     */
    function processRequest() {
        $data = [];
        // Your code here
        $data['PREVIOUS_EMAIL'] = $this->sanitize("email", "email");
        $data['PREVIOUS_EMAIL_VALID'] = $this->validate($data['PREVIOUS_EMAIL'], "email");
        $this->view("email")->render($data);
    }
}