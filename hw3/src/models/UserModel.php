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

    /**
     * Constructor for UserModel is used to instanciate 
     * a connection to mysql
     */
    public function __construct() {
        $this->conn = $this->connectToDB();
    }

    /**
     * createUser is used to create a new user for the Image
     * Rating System. Return true if user is created.
     */
    public function createUser($userName, $email, $pwd) {
        $pwd = md5($pwd);
        $email_query = "SELECT * FROM USER WHERE email='$email'";
        //checking if the email already exists
        $check =  $this->conn->query($email_query) ;
        $rowCount = $check->num_rows;
        //if the email is not in the table, create new user
        if ($rowCount == 0){
            $sql = "INSERT INTO USER SET userName='$userName', email='$email', password='$pwd'";
            $success = ($this->conn->query($sql) or die(mysqli_connect_errno() . "Data cannot inserted"));
            return $success;
        } else {
            return false;
        }
    }

    /**
     * checkLogin is used to validate the users login credentials
     * returns true if email and password match and are valid
     */
    public function checkLogin($email, $pwd) {
        $pwd = md5($pwd);
        $id_query = "SELECT id FROM USER WHERE email = ? and password = ?";
        //use prepared statement to query the db
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
    }

    /**
     * getUserName returns the userName if the user exists in the Image
     * Rating System, otherwise returns "anonymous user".
     */
    public function getUserName($id) {
        $userName_query = "SELECT userName FROM USER WHERE id='$id'";
        $result = $this->conn->query($userName_query);
        if($obj = $result->fetch_object()) {
            $userName = $obj->userName;
            return $userName;
        } else {
            return "anonymous user";
        }
    }
}
