<?php
/* 	
	Zach Clevenger
	INFO-C451
	Spring 22
	Project
	Household Inventory Tracker
	Database using MySQL. Use "Root" with no password to log in.
	
*/

define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'ProjectUser');
define('DB_PASSWORD', 'Pass123Word');
define('DB_NAME', 'home_inventory');
 
/* Establish connection with MySQL */
$con = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
 
// Check connection
if($con === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
?>