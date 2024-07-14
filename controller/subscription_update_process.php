<?php
	//start session
	session_start();
	//connect to the database
	require('../model/database.php');
    //retrieve the functions
	require('../model/functions_subscription.php'); 

    $userSession = isset($_SESSION['user']);
	
	//retrieve the data
	$subEmail = $_GET['subEmail'];
    $subCategoryIDs = $_GET['subCategoryIDs'];

    //convert subscriber's categories from array to string
    $str_subCategoryIDs = "";
    foreach ($subCategoryIDs as $subCategoryID)
    {
        $str_subCategoryIDs = $str_subCategoryIDs.$subCategoryID.",";
    }

    //call the update_sub() function
    $result = update_sub($subEmail, $str_subCategoryIDs);

    if($result)
    {
        //session with email is sent to subscription management page
        $_SESSION['subEmail'] = $subEmail;
        $_SESSION['success'] = 'Subscription updated successfully!';
        header('location:../view/subscription.php');
    }
    else
    {
        //if subscription category is not successfully updated, create an error message to display on the add error page
        $_SESSION['error'] = "Sorry, cannot update your subscription.";
        header('location:../view/database_error.php');
    }

?>