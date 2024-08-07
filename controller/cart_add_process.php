<?php
	//start session
	session_start();
	//connect to the database
	require('../model/database.php');
    //retrieve the functions
	require('../model/functions_cart.php'); 
	
	//retrieve the data
	$coffeeID = $_GET['coffeeID'];
	$cartStatus = 'unpaid';
	$userID = $_GET['userID'];
	$coffeeQuantity = 1;

    //call the add_item_to_cart() function
    $result = add_item_to_cart($coffeeID, $cartStatus, $userID, $coffeeQuantity);
            
    //create user messages
    if($result)
    {
        //if item is successfully added, create a success message to display on the coffees page
        $_SESSION['success'] = 'Coffee successfully added to your tray.';
        //redirect to coffees.php
        header('location:../view/coffees.php');
    }
    else
    {
        //if item is not successfully added, create an error message to display on the add error page
        $_SESSION['error'] = 'An error has occurred. Please try again.';
        header('location:../view/database_error.php');
    }

?>