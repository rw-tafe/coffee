<?php
	//start session management
	session_start();
	//connect to the database
	require('../model/database.php');
	//retrieve the functions
	require('../model/functions_checkout.php');
	
	//retrieve the data that was entered into the form fields using the $_POST array
	$userID = $_GET['userID']; //the value in the hidden form field
	$orderItems = $_GET['cartItems'];
	$totalPrice = $_GET['totalPrice'];
	
	//START SERVER-SIDE VALIDATION
	//check if all required fields have data
	if(empty($orderItems))
	{
		$_SESSION['error'] = 'Cannot checkout. Cart is empty.'; 
		//redirect to the coffee_update page to display the message
		header("location:../view/cart.php");
		exit();
	}
	elseif (empty($userID) || empty($totalPrice)) 
	{ 
		//if required fields are empty initialise a session called 'error' with an appropriate user message
		$_SESSION['error'] = 'Cannot checkout. Plaese try it again.'; 
		//redirect to the coffee_update page to display the message
		header("location:../view/cart.php");
		exit();
	}	
	//check if a valid price has been entered
	elseif(!is_numeric($totalPrice))
	{
		//if invalid data is entered into the price field initialise a session called 'error' with an appropriate user message
		$_SESSION['error'] = 'Invalid price.'; 
		header("location:../view/cart.php");
		exit();
	}

	//END SERVER-SIDE VALIDATION
		
	//call the checkout() function
	$result = checkout($userID, $orderItems, $totalPrice);
	
	//create user messages
	if($result)
	{
		//if coffee is successfully added, create a success message to display on the coffees page
		$_SESSION['success'] = 'Thanks for your purchase.';
		//redirect to ocffees.php
		header('location:../view/account.php');
	}
	else
	{
		//if coffee is not successfully added, create an error message to display on the add coffees page
		$_SESSION['error'] = 'An error has occurred. Please try again.';
		//redirect to coffees.php
		header('location:../view/cart.php');
	}
	
	
?>