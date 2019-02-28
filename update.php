<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<title>Assignment 02 PHP</title>
<link href='styles.css' rel='stylesheet'>
<link rel="stylesheet" href="https://use.typekit.net/yhm1hoj.css">
</head>
<body>
<div class='application'>
<?php
	//Attach empty variable to error message
	$errorMessages	= "";

	//Starts the session
	session_start();

	//Checks if there are any current errors
	if( isset($_SESSION['error']) ){

	// Stores error data into session so it is accessible at any page.
	$errorMessages = $_SESSION['error'];
	}

	echo $errorMessages;

	//clear the error message after we display it,
	unset($_SESSION['error']); 	
 ?>

 <?php
	//Fetch data from MYSQL database
	 require_once('dbinfo.php');

	//Connects to the database
	$mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

	
 ?>

<fieldset>
	<legend>Update a record</legend>

	<!-- Attaches query string to url for form action-->
	<form method="post" action="updatethis.php?id='
		<?php echo $_GET['id']; ?>
		'&firstname='
		<?php echo $_GET['firstname']; ?>
		'&lastname='
		<?php echo $_GET['lastname']; ?>
		'">


		<input type="hidden" name="target" value="<?php echo $_GET['id']; ?>">
		<input type="hidden" name="update" value="update">

		<fieldset>

		<legend>New data</legend>

			<label for="studentnum">Student Number:</label><br>

			<!-- Pre populates input with student number -->
			<input type="text" name="studentnum" id="studentnum" value="<?php echo $_GET['id']; ?>">
			<br><br>
			<label for="firstname">Firstname:</label><br>

			<!-- Pre populates input with student's first name -->
			<input type="text" name="firstname" id="firstname" value="<?php echo $_GET['firstname']; ?>">
			<br><br>

			<!-- Pre populates input with student's last name -->
			<label for="lastname">Lastname:</label><br>
			<input type="text" name="lastname" id="lastname" value="<?php echo $_GET['lastname']; ?>">

			
		</fieldset>
		<br>
		<input type="submit" value="Submit">
	</form>
	</fieldset>

</div>
</body>
</html>