<?php
/**
 *COPYRIGHT (C) 2016 Tyler Jones. All Rights Reserved.
 * UserModel.php is the model for the user
 * Solves CS174 Hw3
 * @author Tyler Jones
*/
namespace soloRider\hw3\models;
require_once "Model.php";

class UserModel extends Model {
    private $conn;
    private $id;
    private $email;
    private $pwd;

    public function __construct() {
        $this->conn = this->connectToDB();
        $this->id;
        $this->email;
        $this->pwd;
    }

    public function createUser($email, $pwd) {
        $pwd = md5($pwd);
        $emails = "SELECT * FROM USER WHERE email='$email'";
        //checking if the email already exists
        $check =  $conn->query($emails) ;
        $rowCount = $check->num_rows;
        //if the email is not in the table, create new user
        if ($rowCount == 0){
            $sql = "INSERT INTO USER SET email='$email', password='$pwd'";
            $success = ($conn->query($sql) or die(mysqli_connect_errno() . "Data cannot inserted"));
            return $success;
        } else {
            return false;
        }
    }

    public function login($email, $pwd) {
        $pwd = ($pwd);
        $id = "SELECT id FROM USER WHERE email='$email' and password='$pwd'";
        //checking if the username is available in the table
        $ids = $conn->query($id);
        $idArray = mysqli_fetch_array($ids);
        $rowCount = $idArray->num_rows;
        if ($rowCount == 1) {
            // this login var will be used for the session
            $_SESSION['login'] = true;
            $_SESSION['id'] = $idArray['id'];
            return true;
        } else {
            return false;
        }
    }

    private function getUserId() {
        return $id;
    }

    private function getEmail() {
        return $email;
    }

    private function getPassword() {
        return $pwd;
    }

    private function setEmail($email) {
        this->email = $email;
    }

    private function getPassword($pwd) {
        this->pwd = $pwd;
    }


//mysqli_close($con);
}
