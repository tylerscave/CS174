<?php
/**
 *COPYRIGHT (C) 2016 Tyler Jones. All Rights Reserved.
 * Model.php is the base class for all models used in hw3
 * It's primary duty is to make a connection to the database
 * Solves CS174 Hw3
 * @author Tyler Jones
*/
namespace soloRider\hw3\models;
use Mysqli;
//required for the constants
require_once(realpath(dirname(__FILE__) . '/../configs/Config.php'));


abstract class Model {
    private $conn;
    /**
     * Connect to the database
    */
    public function connectToDB() {
        //Establish connection to database
        $this->conn = new mysqli(HOST, USER, PWD, DB);
        //Check connection was successful
        if($this->conn->connect_error) {
            echo "Connection failed: " . $this->conn->connect_error . "\n";
        }
        return $this->conn;
    }
}
