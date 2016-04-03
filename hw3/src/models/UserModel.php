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

    public function __construct() {
        $this->conn = $this->connectToDB();
    }

    public function createUser($email, $pwd) {
        $pwd = md5($pwd);
        $email_query = "SELECT * FROM USER WHERE email='$email'";
        //checking if the email already exists
        $check =  $this->conn->query($email_query) ;
        $rowCount = $check->num_rows;
        //if the email is not in the table, create new user
        if ($rowCount == 0){
            $sql = "INSERT INTO USER SET email='$email', password='$pwd'";
            $success = ($this->conn->query($sql) or die(mysqli_connect_errno() . "Data cannot inserted"));
            return $success;
        } else {
            return false;
        }
        //mysqli_close($this->conn);
    }

    public function checkLogin($email, $pwd) {
        $pwd = md5($pwd);
        $id_query = "SELECT id FROM USER WHERE email = ? and password = ?";
        $stmt =  $this->conn->prepare($id_query);
        $stmt->bind_param("ss", $email, $pwd); //s == string
        $stmt->execute();
        $stmt->store_result();
        $rowCount = $stmt->num_rows;
        $stmt->bind_result($id);
        if($stmt->fetch()) {
            $id = $id;
        }
        if ($rowCount == 1) {
            return $id;
        }
        mysqli_stmt_close($stmt);
        //mysqli_close($this->conn);
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
        //this->email = $email;
    }

    private function setPassword($pwd) {
        //this->pwd = $pwd;
    }


//mysqli_close($con);
}
