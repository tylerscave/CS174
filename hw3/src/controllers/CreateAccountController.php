<?php
/**
 *COPYRIGHT (C) 2016 Tyler Jones. All Rights Reserved.
 * CreateAccountController.php is the controller for the create account screen
 * Solves CS174 Hw3
 * @author Tyler Jones
*/
namespace soloRider\hw3\controllers;
use soloRider\hw3\models as B;
require_once(realpath(dirname(__FILE__) . '/../models/UserModel.php'));
require_once "Controller.php";


class CreateAccountController extends Controller {
    private $user;

    public function __construct() {
        $this->user = new B\UserModel();
    }

    /**
     * Used to handle form data coming from EmailView.
     * Should sanitize that data and check if the email within it was
     * valid.
     */
    function processRequest() {
        $data = [];
        //sanitize and validate login inputs
        $data['CREATE_USERNAME'] = $this->sanitize("createUserName", "string");
        $data['CREATE_EMAIL'] = $this->sanitize("createEmail", "email");
        $data['CREATE_EMAIL_VALID'] = $this->validate($data['CREATE_EMAIL'], "email");
        $data['CREATE_PASSWORD'] = $this->sanitize("createPassword", "string");
        $data['CONFIRM_PASSWORD'] = $this->sanitize("confirmPassword", "string");
        if(isset($_REQUEST['submitCreateAccount']) && isset($data['CREATE_EMAIL_VALID']) && isset($data['CREATE_USERNAME']) &&
                ($data['CREATE_PASSWORD'] == $data['CONFIRM_PASSWORD'])) {
            $result = $this->user->createUser($data['CREATE_USERNAME'], $data['CREATE_EMAIL_VALID'], $data['CREATE_PASSWORD']);
            if($result) {
                $data['ACCOUNT_CREATED'] = "You're account was successfully created";
                //goto signin page
            } else {
                $data['ACCOUNT_EXISTS'] = "You already have an account with Image Rating!";
                //goto signin page
            }
        } elseif(isset($_REQUEST['submitCreateAccount'])) {
            $data['ACCOUNT_NOT_CREATED'] = "Something went wrong, please try again.";
                //stay on this page
        }
        $this->view("createAccount")->render($data);
    }
}
