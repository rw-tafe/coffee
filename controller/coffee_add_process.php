<?php
	//start session management
	session_start();
	//connect to the database
	require('../model/database.php');
	require('../model/functions_coffees.php');
	
	//retrieve the data that was entered into the form fields using the $_POST array
	$coffeeName = $_POST['coffeeName'];
	$coffeeDescription = $_POST['coffeeDescription'];
	$coffeePrice = $_POST['coffeePrice'];
	$coffeeID = $_POST['coffeeID'];
	
	//START SERVER-SIDE VALIDATION
	//check if all required fields have data
	if (empty($coffeeName) || empty($coffeeDescription) || empty($coffeePrice)) 
	{ 
		//if required fields are empty initialise a session called 'error' with an appropriate user message
		$_SESSION['error'] = 'All * fields are required.'; 
		//redirect to the coffee_add page to display the message
		header("location:../view/coffee_add.php");
		exit();
	}
	//check if a valid price has been entered
	elseif(!is_numeric($coffeePrice)){
		//if invalid data is entered into the price field initialise a session called 'error' with an appropriate user message
		$_SESSION['error'] = 'Please enter a valid price.'; 
		//redirect to the coffee_add page to display the message
		header("location:../view/coffee_add.php"); 
		exit();
	}
	//check if an image has been uploaded
	if(!empty($_FILES['coffeePhoto']['name']))
	{
		$coffeePhoto = $_FILES['coffeePhoto']['name']; //the PHP file upload variable for a file
		$randomDigit = rand(0000,9999); //generate a random numerical digit <= 4 characters
		$newPhotoName = strtolower($randomDigit . "_" . $coffeePhoto); //attach the random digit to the front of uploaded images to prevent overriding files with the same name in the images folder and enhance security
		$target = "../images/" . $newPhotoName; //the target for uploaded images

		$allowedExts = array('jpg', 'jpeg', 'gif', 'png'); //create an array with the allowed file extensions
		$tmp = explode('.', $_FILES['coffeePhoto']['name']); //split the file name from the file extension
		$extension = end($tmp); //retrieve the extension of the photo e.g., png
		
		//check if the file is less than the maximum size of 500kb
		if($_FILES['coffeePhoto']['size'] > 512000)
		{
			//if file exceeds maximum size initialise a session called 'error' with an appropriate user message
			$_SESSION['error'] = 'Your file size exceeds maximum of 500kb.'; 
			header("location:../view/coffee_add.php");
			exit();
		}
		//check that only accepted image formats are being uploaded
		elseif(($_FILES['coffeePhoto']['type'] == 'image/jpg') || ($_FILES['coffeePhoto']['type'] == 'image/jpeg') || ($_FILES['coffeePhoto']['type'] == 'image/gif') || ($_FILES['coffeePhoto']['type'] == 'image/png') && in_array($extension, $allowedExts))
		{			
			move_uploaded_file($_FILES['coffeePhoto']['tmp_name'], $target); //move the image to images folder
		}
		else
		{
			//if a disallowed image format is uploaded initialise a session called 'error' with an appropriate user message
			$_SESSION['error'] = 'Only JPG, GIF and PNG files allowed.'; 
			header("location:../view/coffee_add.php");
			exit();
		}

		//END SERVER-SIDE VALIDATION
	
		//call the add_coffee_with_photo() function
		$result = add_coffee_with_photo($coffeeName, $coffeeDescription, $coffeePrice, $newPhotoName);
		
		//create user messages
		if($result)
		{
			//if item is successfully added, create a success message to display on the coffees page
			$_SESSION['success'] = 'Coffee successfully added.';
			//redirect to coffees.php
			header('location:../view/coffees.php');
		}
		else
		{
			//if item is not successfully added, create an error message to display on the add coffees page
			$_SESSION['error'] = 'An error has occurred. Please try again.';
			//redirect to coffees.php
			header('location:../view/coffees.php');
		}
	}
	else
	{
		//call the add_coffee() function
		$result = add_coffee($coffeeName, $coffeeDescription, $coffeePrice);
		
		//create user messages
		if($result)
		{
			//if item is successfully added, create a success message to display on the coffees page
			$_SESSION['success'] = 'Coffee successfully added.';
			//redirect to coffees.php
			header('location:../view/coffees.php');
		}
		else
		{
			//if item is not successfully added, create an error message to display on the add coffees page
			$_SESSION['error'] = 'An error has occurred. Please try again.';
			header('location:../view/coffees.php');
		}
	}
?>