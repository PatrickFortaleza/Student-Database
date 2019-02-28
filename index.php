<!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Assignment 02 PHP</title>
    <link href='styles.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://use.typekit.net/yhm1hoj.css">
</head>
<body>
<div class='application'>
    <div class='Error Message'>
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
    </div> <!--End Error message-->

    <?php
    // Fetch data from MYSQL database
    require_once('dbinfo.php');

    // Set default sort order to alphbetical last name.
    $sortOrder ='lastname';

    // Check to see see if URL contains sort choice query
    if(isset($_GET['choice'])){

        // Concatinate the sort order to display sort-order visually.
        echo "<p>A sort choice was made. <br/>  You have chosen `".$_GET['choice']."` as your sort order.</p>";

        // Sets an array of acceptable sort order choices
        $validChoices = array ('id','firstname','lastname');

            // Checks to see if the choice is valid using in_array() function
            if(in_array($_GET['choice'], $validChoices)){

                // Changes default sort order to choice
                $sortOrder = $_GET['choice'];
            }else{

                 // If not valid, send user an error message.
                echo "<p>Hey you, '".$_GET['choice']."' is not a valid sort choice! Don't mess with the URL if you want this sort feature to work.</p>";
    }

}


// Connects to the database
$mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

// Validates sortOrder by extracting any special characters so we can use the sortOrder in an SQL statement.
$sortOrder = $mysqli->real_escape_string($sortOrder);

// If # of errors is greater than 0, stop from executing more code
if(mysqli_connect_errno() != 0){
    die("<p>Could not connect to DB:".$mysqli->connect_error."</p>");
} 

// Lets users know if database is connected.

?>

<!-- Allows users to visually see if database is connected -->
<h3 class='connectionstat'>Database Status:</h3>
<p class='connectionok'>Connected To Database</p>

<!-- Sets link to register page -->
<a class='register' href='register.php'>Register A Student:</a> <br/><br/>

<fieldset>
<legend>Student Database</legend>

<?php

// Creates SQL statement 
$query = 'SELECT id, firstname, lastname FROM students ORDER BY '.$sortOrder.';';

// Sends SQL statement into database
$result = $mysqli->query($query);

?>

<table>

    <?php $arrayOfFieldNames = $result->fetch_fields(); //stores result of SQL statement in variable ?>
    
    <tr>

    <?php foreach($arrayOfFieldNames as $oneFieldAsObject){ //Use a foreach loop to extract array values ?>

        <!-- Sets Table Headings -->
        <th><a href='index.php?choice=<?php echo $oneFieldAsObject->name?>'><?php echo $oneFieldAsObject->name?></a></th>


    <?php } //ends foreach loop ?>

    </tr>

<?php

// Starts a while loop, while there are table rows, output the data. 
while($record = $result->fetch_assoc()){

?>

    <!-- Outputs data in table -->
	<tr>
    
    <td><?php echo $record["id"] ?></td>
    <td><?php echo $record["firstname"] ?></td>
    <td><?php echo $record["lastname"] ?></td>

    <!--Attaches the record ID to query string in URL so it may retrace which student to update/delete -->
    <td><a href='delete.php?id=<?php echo $record['id']?>&firstname=<?php echo $record['firstname']?>&lastname=<?php echo $record['lastname']?>'>Delete</a></td>
    <td><a href='update.php?id=<?php echo $record['id']?>&firstname=<?php echo $record['firstname']?>&lastname=<?php echo $record['lastname']?>'>Update</a></td>
    
    </tr>

<?php } ?>

</table>
</fieldset>

<?php $mysqli->close() //turns off the database ?>

</div><!--End Application-->

</body>
</html>