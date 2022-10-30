<?php
	//start session management
	session_start();
	//connect to the database
	require('../model/database.php');
	require('../model/functions_coffees.php');
?>

<?php
	//retrieve the coffeeID from the URL	
	$coffeeID = $_GET['coffeeID'];

	//call the delete_coffee() function
	$result = delete_coffee($coffeeID);
	
	//create user messages
	if($result){
		//if coffee is successfully deleted, create a success message to display on the coffes page
		$_SESSION['success'] = 'Coffee successfully deleted.';
		//redirect to coffees.php
		header('location:../view/coffees.php');
	}else{
		//if coffee is not successfully deleted, create an error message to display on the add coffes page
		$_SESSION['error'] = 'An error has occurred. Please try again.';
		//redirect to coffes.php
		header('location:../view/coffes.php');
	}
?>
