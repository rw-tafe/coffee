<?php
	//start session management
	session_start();
	//include authorisation management
	require('../controller/authorisation.php');
	//connect to the database
	require('../model/database.php');
	//retrieve the functions
	require('../model/functions_coffees.php');
	require('../model/functions_messages.php');
	
	//provide the value of the $title variable for this page
	$title = "Add Coffee";
	
	//retrieve the header
	require('header.php');
	//retrieve the navigation
	require('nav.php');
?>

<section id="main">
	<h2>Add Coffee</h2>
	
	<?php
		//call user_message() function
		$message = user_message();
	?>

	<!-- create a table to enter the new item data -->
	<!-- Note the use of HTML5 client-side form validation in the form fields -->
	<form action="../controller/coffee_add_process.php" method="post" enctype="multipart/form-data">
		<div>
			<label>Name*</label>
			<input id="coffeeName" type="text" name="coffeeName" required />
		</div>
		<div>
			<label>Description*</label>
			<textarea id="coffeeDescription" name="coffeeDescription" required /></textarea>
		</div>
		<div>
			<label>Price*</label>
			<input id="coffeePrice" type="text" name="coffeePrice" required />
		</div>
		<div>
			<label>Picture</label> <input type="file" name="coffeePhoto" /><br />	
		</div>
		<div>
			<input type="submit" value="Add Coffee" />
		</div>
	</form>
</section> <!-- end main -->

<?php
	//retrieve the footer
	require('footer.php');
?>