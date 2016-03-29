<?php
/**
 *COPYRIGHT (C) 2016 Tyler Jones. All Rights Reserved.
 * SignInController.php is the controller for the Sign in screen
 * Solves CS174 Hw3
 * @author Tyler Jones
*/
namespace soloRider\hw3\controllers;

class SignInController extends Controller {


//PASTED IN AS EXAMPLE NEED TO EDIT

    /**
     * Used to handle form data coming from EmailView.
     * Should sanitize that data and check if the email within it was
     * valid.
     */
    function processRequest() {
        $data = [];
        // Your code here
        //$data['PREVIOUS_EMAIL'] = $this->sanitize("email", "email");
        //$data['PREVIOUS_EMAIL_VALID'] = $this->validate("email", "string");
        $this->view("signIn")->render($data);
    }
}
