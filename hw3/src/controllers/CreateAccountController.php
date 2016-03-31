<?php
/**
 *COPYRIGHT (C) 2016 Tyler Jones. All Rights Reserved.
 * CreateAccountController.php is the controller for the create account screen
 * Solves CS174 Hw3
 * @author Tyler Jones
*/
namespace soloRider\hw3\controllers;
require_once "Controller.php";

class CreateAccountController extends Controller {


//PASTED IN AS EXAMPLE NEED TO EDIT

    /**
     * Used to handle form data coming from EmailView.
     * Should sanitize that data and check if the email within it was
     * valid.
     */
    function processRequest() {
        $data = [];
        // Your code here
        $data['PREVIOUS_STIRNG'] = $this->sanitize("createAccount", "string");
        $data['PREVIOUS_STRING_VALID'] = $this->validate($data['PREVIOUS_STRING'], "string");
        $this->view("createAccount")->render($data);
    }
}
