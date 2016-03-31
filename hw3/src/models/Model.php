<?php
/**
 *COPYRIGHT (C) 2016 Tyler Jones. All Rights Reserved.
 * Model.php is the base class for all models used in hw3
 * Solves CS174 Hw3
 * @author Tyler Jones
*/
namespace soloRider\hw3\models;
//required for the constants
require_once "Config.php";

//NEED TO EDIT THIS WHOLE CLASS JUST PASTED IN EXAMPLE FOR STRUCTURE

abstract class Model {
    private $conn;
    /**
     * Connect to the database
    */
    public function connectToDB() {
        //Establish connection to database
        $conn = new mysqli(Config::HOST, Config::USER, Config::PWD, Config::DB);
        //Check connection was successful
        if($conn->connect_error) {
            echo "Connection failed: " . $conn->connect_error . "\n";
        }
        return $conn;
// this will need to be closed somewhere. Maybe in the child models themselves after manipulation of DB
//mysqli_close($con);
    }

    /**
     * This method should be overriden
     */
    public abstract function doStuff();

    /**
     * Used to do something that is common to each model
    */
    public function doCommonStuff($someParameters) {
        /**
         * Add actual code here
        */
        return $out;
    }
}
