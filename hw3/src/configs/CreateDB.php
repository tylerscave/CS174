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
$conn = new mysqli(HOST, USER, PWD, "");
//Check connection was successful
if($conn->connect_error) {
    echo "Connection failed: " . $conn->connect_error . "\n";
}
//Create the database
$sql = "CREATE DATABASE " . DB;
if($conn->query($sql) === TRUE) {
    echo "Database " . DB . " created successfully \n";
} else {
    echo "Error creating database: " . $conn->error . "\n";
}
//select the correct DB
$conn->select_db(DB);
//Create the USER table
$tbl = "CREATE TABLE USER(
    id INT(6) AUTO_INCREMENT PRIMARY KEY NOT NULL,
    userName VARCHAR(20) UNIQUE NOT NULL,
    email VARCHAR(50) UNIQUE NOT NULL,
    password VARCHAR(32) NOT NULL)";
if ($conn->query($tbl) === TRUE) {
    echo "Table USER created successfully \n";
} else {
    echo "Error creating table: " . $conn->error . "\n";
}
$conn->query("ALTER TABLE USER AUTO_INCREMENT = 100000");

//Create the IMAGE table
$tbl = "CREATE TABLE IMAGE(
    fileName VARCHAR(50) PRIMARY KEY NOT NULL,
    id INT(6) NOT NULL,
    caption VARCHAR(100),
    timeUploaded TIMESTAMP)";
if ($conn->query($tbl) === TRUE) {
    echo "Table IMAGE created successfully \n";
} else {
    echo "Error creating table: " . $conn->error . "\n";
}
$conn->query("ALTER TABLE IMAGE AUTO_INCREMENT = 500000");

//Create the RATING table
$tbl = "CREATE TABLE RATING(
    fileName VARCHAR(50) NOT NULL,
    id INT(6) NOT NULL,
    rating INT(1))";
if ($conn->query($tbl) === TRUE) {
    echo "Table IMAGE created successfully \n";
} else {
    echo "Error creating table: " . $conn->error . "\n";
}
$conn->close();

