<?php
/**
 *COPYRIGHT (C) 2016 Tyler Jones. All Rights Reserved.
 * Model.php is the base class for all models used in hw3
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
// this will need to be closed somewhere. Maybe in the child models themselves after manipulation of DB
//mysqli_close($con);
    }

    /**
     * updateModel updates the model from the database
     * This method should be overriden
     */
    //public abstract function updateModel();

    /**
     * Used to do something that is common to each model
    */
    public function doCommonStuff($someParameters) {
        /**
         * Add actual code here
        */
        return $out;
    }

    /**
     * Used to do something that is common to each model
    */
    public function doOtherCommonStuff($someParameters) {
        /**
         * Add actual code here
        */
        return $out;
    }
}
