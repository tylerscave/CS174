<?php
/**
 *COPYRIGHT (C) 2016 Tyler Jones. All Rights Reserved.
 * SignInController.php is the controller for the Sign in screen
 * Solves CS174 Hw3
 * @author Tyler Jones
*/
namespace soloRider\hw3\controllers;
use soloRider\hw3\models as B;
require_once(realpath(dirname(__FILE__) . '/../models/UserModel.php'));
require_once "Controller.php";

class SignInController extends Controller {
    private $user;

    /**
     * Constructor for SignInController is used to instanciate 
     * a UserModel object
     */
    public function __construct() {
        $this->user = new B\UserModel();
    }

    /**
     * Used to handle form data coming from the Sign in Screen
     * Sanitizes user data and validates the login credentials
     */
    function processRequest() {
        $data = [];
        //sanitize and validate login inputs
        $data['LOGIN_EMAIL'] = $this->sanitize("loginEmail", "email");
        $data['LOGIN_EMAIL_VALID'] = $this->validate($data['LOGIN_EMAIL'], "email");
        $data['LOGIN_PASSWORD'] = $this->sanitize("loginPassword", "string");

        //validate the login
        if (isset($data['LOGIN_EMAIL_VALID']) && isset($data['LOGIN_PASSWORD'])) {
            $id = $this->user->checkLogin($data['LOGIN_EMAIL_VALID'], $data['LOGIN_PASSWORD']);
            if (isset($id)) {
                //Correct login provided
                //this login and id variable will be used for the session
                $_SESSION['LOGIN'] = true;
                $_SESSION['ID'] = $id;
                header('Location: http://localhost/serverRepos/hw3/index.php', true, 303);
            } else {
                //bad login
                $_SESSION['LOGIN'] = false;
                unset($_SESSION['ID']);
                $data['LOGIN_FAIL'] = true;
            }
        }
        $this->view("signIn")->render($data);
    }
}
