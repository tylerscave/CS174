<?php
/**
 *COPYRIGHT (C) 2016 Tyler Jones. All Rights Reserved.
 * Model.php is the base class for all models used in hw3
 * Solves CS174 Hw3
 * @author Tyler Jones
*/
namespace soloRider\hw3\models;

//NEED TO EDIT THIS WHOLE CLASS JUST PASTED IN EXAMPLE FOR STRUCTURE

abstract class Model {

    /**
     * Connect to the database
    */
    public function connectToDB() {
        // Connect to MySQL
        $con = mysqli_connect();
        // Check connection
        if (mysqli_connect_errno()) {
            echo "Failed to connect to MySQL: " . mysqli_connect_error();
        }
        // Make my_db the current database
        $dbSelected = mysqli_select_db($con, "imageRating");
        if (!$dbSelected) {
            // If we couldn't get the db we wanted, then create the db
            $imageDB = "CREATE DATABASE imageRating";
            if (mysqli_query($imageDB, $con)) {
                echo "Database imageRating created successfully\n";
            } else {
                echo "Error creating database: " . mysqli_error() . "\n";
            }
        }
        return $con;
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
