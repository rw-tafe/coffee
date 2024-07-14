<?php
	//start session
	session_start();
	//connect to the database
	require('../model/database.php');
	//retrieve the functions
	require('../model/functions_users.php');
	
	//retrieve the username and password entered into the form
	$username = $_POST['username'];
	$password = $_POST['password']; 
	
	//call the retrieve_salt() function
	$result = retrieve_salt($username);
	
	//retrieve the random salt from the database
	$salt = $result['salt'];
	//generate the hashed password with the salt value
    $password = hash('sha256', $password.$salt); 
	
	//call the login() function
	$count = login($username, $password);
	
	//if there is a matching record
	if($count == 1)
	{ 
		//start the user session to allow authorised access to secured web pages
		date_default_timezone_set('Australia/Brisbane');
		$currentTime = date('a');
		$_SESSION['user'] = $username;
		$userFullName = get_user()['firstName'] . " " . get_user()['lastName'];
		
		//if login is successful, create a success message to display on the home page
		// check time for welcome messages
		if($currentTime == 'am')
		{
			$_SESSION['success'] = 'Good morning ' . $userFullName . '!'; 
		}
		elseif(strval($currentTime) == 'pm' && date('h') <= '6')
		{
			$_SESSION['success'] = 'Good afternoon ' . $userFullName . '!';
		}
		elseif($currentTime == 'pm' && date('h') > '6')
		{
			$_SESSION['success'] = 'Good evening ' . $userFullName . '!';
		}
		else
		{
			$_SESSION['success'] = 'Good day ' . $userFullName . '!';
		}
		
		//redirect to home.php
		header('location:../view/coffees.php');
	}
	else
	{
		//if login not successful, create an error message to display on the login page
		$_SESSION['error'] = 'Incorrect username or password. Please try again.';
		//redirect to login.php
		header('location:../view/login_form.php');
	}	
?>