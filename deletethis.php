<?php

//Sets empty variables for student id, firstname and lastname
$studid ='';
$firstname ='';
$lastname = '';

//Starts the session
session_start();

//Checks to see wether user said 'yes' or 'no' via radio buttons
if(!isset($_POST['confirm'])){
    $_SESSION['error'] = "<p>You have chosen NOT to delete a data entry.</p>";
    header('location: indexx.php');
    die();
}


// Initializes database
require_once('dbinfo.php');

// Stores database data into a variable
$mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

// Stores ID data from session into a variable
$studId = $_GET['id'];


//Validated the sting by extracting any special characters
$studid = $mysqli->real_escape_string($studid);
$firstname = $mysqli->real_escape_string($firstname);
$lastname = $mysqli->real_escape_string($lastname);


// Deletes the student based on key variable student ID
$query = "DELETE FROM students WHERE id=$studId";
$result = $mysqli->query($query);

if($mysqli->affected_rows != 1){
    $_SESSION['error'] = "<p>There was a problem deleting you from our database</p>";
    header('location: index.php');
    die();
   

}else{
    $_SESSION['error'] = "<p>You have successfully deleted ".$studId." from the database.</p>";
    header('location: index.php');
    die();

}



$mysqli->close();

?>