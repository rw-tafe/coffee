<?php
	//start session
	session_start();
	//connect to the database
	require('../model/database.php');
	//retrieve the functions
	require('../model/functions_users.php');
	require('../model/functions_checkout.php');
	
	//retrieve the data
	$userID = $_GET['userID']; 
	$orderItems = $_GET['cartItems'];
	$totalPrice = $_GET['totalPrice'];
	//for email use
	$user = get_user();

	
	//START SERVER-SIDE VALIDATION
	//check if all required fields have data
	if(empty($orderItems))
	{
		$_SESSION['error'] = 'Cannot checkout. Cart is empty.'; 
		//redirect to the cart page to display the message
		header("location:../view/cart.php");
		exit();
	}
	elseif (empty($userID) || empty($totalPrice)) 
	{ 
		//if required fields are empty initialise a session called 'error' with an appropriate user message
		$_SESSION['error'] = 'Cannot checkout. Plaese try it again.'; 
		//redirect to the cart page to display the message
		header("location:../view/cart.php");
		exit();
	}	
	//check if a valid price has been entered
	elseif(!is_numeric($totalPrice))
	{
		//if invalid price, display 'error' message on cart page
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
		//send order details to shopper	by email
		$to      = "customer_order@rosscoscoffee.com";
		$subject = "Customer Order";
		$message = "<b>Customer:</b> " . $user['firstName'] . " " . $user['lastName'] . "<br/><br/><b>Order:</b><br/> " . $orderItems . "<br/><b>Total Price:</b> $" . $totalPrice;
		$headers = "Content-type: text/html; charset=iso-8859-1\r\n"; //send email in HTML format
		$headers .= "From: Web Order <weborder@rosscoscoffee.com>" . "\r\n" .
			"Reply-To: Web Order <weborder@rosscoscoffee.com>" . "\r\n" .
			"X-Mailer: PHP/" . phpversion();
		mail($to, $subject, $message, $headers);

		//if checkout is successfully done, create a success message to display on the account page
		$_SESSION['success'] = 'Thanks for your purchase.';
		//redirect to account.php
		header('location:../view/account.php');
	}
	else
	{
		//if checkout is not successfully done, create an error message to display on the add cart page
		$_SESSION['error'] = 'An error has occurred. Please try again.';
		header('location:../view/cart.php');
	}
	
	
?>