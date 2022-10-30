<?php
	//start session management
	session_start();
	//connect to the database
	require('../model/database.php');
	require('../model/functions_cart.php'); 
	
	//retrieve the data that was entered into the form fields using the $_POST array
	$cartID = $_GET['cartID'];

    //call the add_item_to_cart() function
    $result = delete_cart_item($cartID);
            
    //create user messages
    if($result)
    {
        //if item is successfully added, create a success message to display on the home page
        $_SESSION['success'] = 'Coffee successfully deleted from your tray.';
        //redirect to coffees.php
        header('location:../view/cart.php');
    }
    else
    {
        //if item is not successfully added, create an error message to display on the cart page
        $_SESSION['error'] = 'An error has occurred. Please try again.';
        header('location:../view/cart.php');
    }

?>