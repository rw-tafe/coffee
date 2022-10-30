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
	$title = "Update Coffee";
	
	//retrieve the header
	require('header.php');
	//retrieve the navigation
	require('nav.php');
?>

<section id="main">
	<h2>Update Coffee</h2>
	
	<?php
		//retrieve the coffeeID from the URL
		$coffeeID = $_GET['coffeeID'];
		//call user_message() function
		$message = user_message();
		//call the get_coffee() function
		$result = get_coffee();
	?>

	<form action="../controller/coffee_update_process.php" method="post" enctype="multipart/form-data">
		<div>
			<label>Name* </label>
			<input id="coffeeName" type="text" name="coffeeName" value="<?php echo $result['coffeeName'] ?>" required />
		</div>
		<div>
			<label>Description* </label>
			<textarea id="coffeeDescription" name="coffeeDescription" required /><?php echo $result['coffeeDescription'] ?></textarea>
		</div>
		<div>
			<label>Price* </label>
			<input id="coffeePrice" type="text" name="coffeePrice" value="<?php echo $result['coffeePrice'] ?>" required />
		</div>
		<div>
			<?php
				//if the photo field in the database is NULL or empty
				if((is_null($result['coffeePhoto'])) || (empty($result['coffeePhoto'])))
				{
					//display the default photo
					echo "<p><img src='../images/default.gif' width=200 height=200 alt='default photo' /></p>";
				}
				else
				{ 
					//else display the appropriate item photo
					echo "<p><img src='../images/" . ($result['coffeePhoto']) . "'" . ' width=200 height=200 alt="coffee photo"'  . "/></p>"; 
				}
			?>
			<label>Picture</label> <input type="file" name="coffeePhoto" /><br />	
		</div>
		<div>
			<!-- the table has a hidden form field to pass the coffeeID to the next page -->
			<input id="coffeeID" name="coffeeID" type="hidden" value="<?php echo $coffeeID ?>" />
		</div>		
		<div>
			<input type="submit" value="Update Coffee" />
		</div>
	</form>
</section> <!-- end main -->

<?php
	//retrieve the footer
	require('footer.php');
?>