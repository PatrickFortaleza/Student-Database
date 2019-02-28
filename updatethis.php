<?php
session_start();
$studentnum ='';
$firstname ='';
$lastname = '';
if(!isset($_POST['studentnum']) || !isset($_POST['firstname']) || !isset($_POST['lastname'])){
    $_SESSION['error'] = '<p>The request could not be accomplished</p>';
    header('location: index.php');
    die();
}
require_once('dbinfo.php');
$mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
$studnum = $_GET['id'];
$firstname = $_GET['firstname'];
$lastname = $_GET['lastname'];
$newstudnum = $_POST['studentnum'];
$newfirstname = $_POST['firstname'];
$newlastname = $_POST['lastname'];

$studentnum = $mysqli->real_escape_string($studentnum);
$firstname = $mysqli->real_escape_string($firstname);
$lastname = $mysqli->real_escape_string($lastname);
$newstudnum = $mysqli->real_escape_string($newstudnum);
$newfirstname = $mysqli->real_escape_string($newfirstname);
$newlastname = $mysqli->real_escape_string($newlastname);

$query = "UPDATE students SET id='$newstudnum', firstname='$newfirstname', lastname='$newlastname' WHERE id=$studnum;";

$result = $mysqli->query($query);

if($mysqli->affected_rows != 1){
    $_SESSION['error'] = "<p>There was a problem updating this student from our database</p>";
    header('location: index.php');
    die();
}else{
    $_SESSION['error'] = "<p>You have successfully updated the fields of student number: $studnum</p>";
    header('location: index.php');
    die();
}

$mysqli->close();




?>