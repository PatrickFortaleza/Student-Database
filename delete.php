<!DOCTYPE html>
<html lang="en">
<head>
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Assignment 02 PHP</title>
    <link href='styles.css' rel='stylesheet'>
<link rel="stylesheet" href="https://use.typekit.net/yhm1hoj.css">
</head>
<body>
<div class='application'>
<?php

	//Create empty variable for error messages
	$errorMessages	= "";

	//Starts the session
	session_start();

	//Checks to see if there are any errors
	if( isset($_SESSION['error']) ){

		//Stores errors into a variable
		$errorMessages = $_SESSION['error'];
	}
	echo $errorMessages;

	//clear the error message after we display it,
	unset($_SESSION['error']); 

 ?>

 <?php

	// intializes database
	 require_once('dbinfo.php');
	 
	 //Stores database into a variabl;e
	$mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

	
	
 ?>

<fieldset>
<legend>Delete a record</legend>

<!-- Attaches student ID to query in URL -->
<form method="post" action="deletethis.php?id='<?php echo $_GET['id']; ?>'">
<fieldset>
	<legend>Confirm Deletion:</legend>
		<label for="confirm">Yes</label><input type="radio" name="confirm" id="yes" value="yes">
		<br>
		<br>
		<label for="no">No</label>
		<input type="radio" name="no" id="no" value="no">
		<br>
		
</fieldset>
<br>
<input type="submit" value="Submit">
	</form>
</fieldset>
</div>


</body>
</html>

