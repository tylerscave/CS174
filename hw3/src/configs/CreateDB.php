<?php
/**
 *COPYRIGHT (C) 2016 Tyler Jones. All Rights Reserved.
 * CreateDB.php can be run from the command-line to make a good initial database.
 * Solves CS174 Hw3
 * @author Tyler Jones
*/

//required for the constants
require_once "Config.php";

//Establish connection to database
$conn = new mysqli(Config::HOST, Config::USER, Config::PWD, "");
//Check connection was successful
if($conn->connect_error) {
    echo "Connection failed: " . $conn->connect_error . "\n";
}
//Create the database
$sql = "CREATE DATABASE " . Config::DB;
if($conn->query($sql) === TRUE) {
    echo "Database " . Config::DB . " created successfully \n";
} else {
    echo "Error creating database: " . $conn->error . "\n";
}
//Create the USER table
$conn->select_db(Config::DB);
$tbl = "CREATE TABLE USER(
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    email VARCHAR(50) NOT NULL,
    password VARCHAR(32) NOT NULL,
    fileName VARCHAR(30),
    caption VARCHAR(100),
    rating INT(1),
    timeUploaded TIMESTAMP)";
if ($conn->query($tbl) === TRUE) {
    echo "Table USER created successfully \n";
} else {
    echo "Error creating table: " . $conn->error . "\n";
}
$conn->close();

/*
GRANT ALL PRIVILEGES ON * . * TO 'newuser'@'localhost';
CREATE USER 'lord_tyler'@'localhost' IDENTIFIED BY '';
GRANT ALL PRIVILEGES ON MyDatabase.* TO 'lord_tyler'@'localhost';
FLUSH PRIVILEGES;
*/
