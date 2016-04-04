<?php
/**
 *COPYRIGHT (C) 2016 Tyler Jones. All Rights Reserved.
 * SignInController.php is the controller for the Sign in screen
 * Solves CS174 Hw3
 * @author Tyler Jones
*/
namespace soloRider\hw3\controllers;
use soloRider\hw3\models as B;
ini_set('display_errors', true);
error_reporting(E_ALL);
require_once(realpath(dirname(__FILE__) . '/../models/UserModel.php'));
require_once "Controller.php";

class SignInController extends Controller {
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
        $data['LOGIN_EMAIL'] = $this->sanitize("loginEmail", "email");
        $data['LOGIN_EMAIL_VALID'] = $this->validate($data['LOGIN_EMAIL'], "email");
        $data['LOGIN_PASSWORD'] = $this->sanitize("loginPassword", "string");

        if (isset($_REQUEST['login'])) {
            $id = $this->user->checkLogin($data['LOGIN_EMAIL_VALID'], $data['LOGIN_PASSWORD']);
            if (isset($id)) {
                // Correct login provided
                //this login and id variable will be used for the session
                $_SESSION['login'] = true;
                $_SESSION['id'] = $id;
                //goto imageRating page
            } else {
                // bad login
                $_SESSION['login'] = false;
                unset($_SESSION['id']);
                $data['LOGIN_FAIL'] = "Incorrect Email or Password!!! Please try again :)";
                //stay on signin page
            }
        }
        $this->view("signIn")->render($data);

    }
}
