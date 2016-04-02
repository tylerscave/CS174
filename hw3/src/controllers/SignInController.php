<?php
/**
 *COPYRIGHT (C) 2016 Tyler Jones. All Rights Reserved.
 * SignInController.php is the controller for the Sign in screen
 * Solves CS174 Hw3
 * @author Tyler Jones
*/
namespace soloRider\hw3\controllers;
require_once "Controller.php";
//include_once "../models/UserModel.php";

class SignInController extends Controller {
    private $conn;

public function __construct() {

        //Establish connection to database
        $this->conn = new mysqli("", "", "", "imageRating");
        //Check connection was successful
//        if($conn->connect_error) {
//            echo "Connection failed: " . $conn->connect_error . "\n";
//        }
}

    //private $user = new UserModel();

//PASTED IN AS EXAMPLE NEED TO EDIT

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
        $data['LOGIN_PASSWORD_VALID'] = $this->validate($data['LOGIN_PASSWORD'], "string");
//echo 'email = ' . $data['LOGIN_EMAIL'];
//echo 'pwd = ' . $data['LOGIN_PASSWORD'];
//echo 'email valid = ' . $data['LOGIN_EMAIL_VALID'];
//echo 'pwd valid = ' . $data['LOGIN_PASSWORD_VALID'];



        //Establish connection to database
        //$conn = new mysqli("", "", "", "imageRating");
        //Check connection was successful
        //if($conn->connect_error) {
            //echo "Connection failed: " . $conn->connect_error . "\n";
        //}
        //$id = "SELECT id FROM USER WHERE email='$data['LOGIN_EMAIL']' and password='$data['LOGIN_PASSWORD']'";
        //checking if the username is available in the table
        //$ids = $conn->query($id);
        //$idArray = mysqli_fetch_array($ids);
        //$rowCount = $idArray->num_rows;
        //if ($rowCount == 1) {
            // this login var will be used for the session
            //$_SESSION['login'] = true;
            //$_SESSION['id'] = $idArray['id'];
        //}
//echo "\n" . "id = " . $_SESSION['id'];


/*
        if (isset($_REQUEST['login']) && $data['LOGIN_EMAIL_VALID'] && $data['LOGIN_PASSWORD_VALID']) {
        echo 'we are here';
        //extract($_REQUEST);
        $user = new UserModel();
        session_start();

            $login = $user->check_login($data['LOGIN_EMAIL'], $data['LOGIN_PASSWORD']);
        }
        if ($login) {
            // Correct login provided
            echo 'Login correct';
        } else {
            // bad login
            echo 'Wrong username or password';
        }

*/
        // Your code here
        //$data['PREVIOUS_EMAIL'] = $this->sanitize("email", "email");
        //$data['PREVIOUS_EMAIL_VALID'] = $this->validate("email", "string");
        $this->view("signIn")->render($data);
    }
}
