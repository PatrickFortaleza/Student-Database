<?php

session_start();

$studentnum ='';
$firstname ='';
$lastname = '';


// validate form fields
if(!isset($_POST['studentnum']) || !isset($_POST['firstname']) || !isset($_POST['lastname'])){
    $_SESSION['error'] = "<p class='error'>Please register, its real easy to do...</p>";
    header('location: register.php');
    die();
}

// validate the form fields: ensure form fields contain data 

if(trim($_POST['studentnum'])=='' || trim($_POST['firstname'])==''|| trim($_POST['lastname'])==''){
    $_SESSION['error'] = "<p class'error'>Please fill in the registration form...</p>";
    header('location: register.php');
    die();
}

$studentnum = trim($_POST['studentnum']);
$firstname = trim($_POST['firstname']);
$lastname = trim($_POST['lastname']);


// check to see if username already exists
require_once('dbinfo.php');

$db = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

if(mysqli_connect_errno() !=0){
    $_SESSION['error'] = "<p class 'error>Uh oh.. could not connect to database.</p>";
    header('location: register.php');
    die();
}

$studentnum = $db->real_escape_string($studentnum);
$firstname = $db->real_escape_string($firstname);
$lastname = $db->real_escape_string($lastname);

$query = 'SELECT * FROM students WHERE BINARY id="'.$studentnum.'";';

$result = $db->query($query);

if($result->num_rows>0){
    $_SESSION['error']= "<p class='error'>The student number '".$studentnum ."' is already in use, please choose a different one...</p>";
    header('location: register.php');
    die();
}

$query = 'INSERT INTO students (id, firstname, lastname) VALUES("'.$studentnum.'","'.$firstname.'","'.$lastname.'");';
$result = $db->query($query);

if($db->affected_rows != 1){
    $_SESSION['error'] = "<p>There was a problem adding you to our database. Please try again.</p>";
    header('location: register.php');
    die();
}

$db->close();

$_SESSION['error'] = "<p>You have been registered ".$firstname." ".$lastname." with us. <br/> Feel free to login whenever you like.</p>";
header('location: index.php');
die();

?>