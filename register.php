<!DOCTYPE html>
<html lang="en">
<head>
<title>Register</title>
<meta charset="utf-8" />
<link href='styles.css' rel='stylesheet'>
<link rel="stylesheet" href="https://use.typekit.net/yhm1hoj.css">
</head>
<body>
<div class='bform'>
<?php

	// Attach empty variable to error message
	$errorMessages	= "";

	// Starts the session
	session_start();

	// Checks if there are any errors
	if( isset($_SESSION['error']) ){

	// Stores error data into session so it is accessible at any page.
	$errorMessages = $_SESSION['error'];
	}


	echo $errorMessages;
	//clear the error message after we display it,
	unset($_SESSION['error']);
?>

<div class='aform'>
<form method="POST" action="adduser.php">
<fieldset>
	<legend>Register A User:</legend>
		<label for="studentnum">Student Number:</label>
		<br />
		<input type="text" name="studentnum" id="studentnum" />
		<br />
		<label for="firstname">Firstname:</label>
		<br />
		<input type="text" name="firstname" id="firstname" />
		<br />
		<label for="lastname">Lastname:</label>
		<br />
		<input type="text" name="lastname" id="lastname" />
		<br />
		<br />
		<input type="submit" /><br />
</fieldset>
	</form>
</div> <!--End aform-->
</div> <!--End bform-->
</body>
</html>