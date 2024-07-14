<?php
	//start session
	session_start();
	//connect to the database
	require('../model/database.php');
	require('../model/functions_cart.php'); 
	
	//retrieve the data
	$cartID = $_GET['cartID'];

    //call the add_item_to_cart() function
    $result = delete_cart_item($cartID);
            
    //create user messages
    if($result)
    {
        //if item is successfully deleted, create a success message to display on the cart page
        $_SESSION['success'] = 'Coffee successfully deleted from your tray.';
        //redirect to cart.php
        header('location:../view/cart.php');
    }
    else
    {
        //if item is not successfully added, create an error message to display on the cart page
        $_SESSION['error'] = 'An error has occurred. Please try again.';
        header('location:../view/cart.php');
    }

?>