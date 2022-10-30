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
	$title = "Coffee";
	
	//retrieve the header
	require('header.php');
	//retrieve the navigation
	require('nav.php');
?>

<section id="main">
	<h2>Our Coffees</h2>
	
	<?php
		//call user_message() function
		$message = user_message();
		//call the get_coffees() function
		$result = get_coffees();
		//get userID
		$userID = get_user()['userID'];
	?>
		
	<!-- display all the item data in each row using a foreach loop -->	
	<div id="coffees">
		<?php foreach($result as $row):?>
			<div class="coffee">
				<div class="coffeeInfo">
					<?php
						//if the coffeePhoto field in the database is NULL or empty
						if((is_null($row['coffeePhoto'])) || (empty($row['coffeePhoto'])))
						{
							//display the default photo
							echo "<p><img src='../images/default.gif' width=200 height=200 alt='default photo' /></p>"; 
						}
						else
						{ 
							//display the item photo
							echo "<p><img src='../images/" . ($row['coffeePhoto']) . "'" . ' width=200 height=200 alt="coffee photo"'  . "/></p>";
						}
					?>
					<p class="coffeeName"><?php echo $row['coffeeName']; ?></p>
					<p><?php echo $row['coffeeDescription']; ?></p>
				</div> <!-- coffeeInfo -->
				<div class="coffeePrice">
					<p><?php echo "$" . (number_format($row['coffeePrice'], 2)); ?> each</p>
				</div> <!-- end coffeePrice -->
				<!-- 
				Note that the Update link uses the $_GET array to send the coffeeID to the next page, 
				as well as the use of the JavaScript prompt to ask the user if they really want 
				to delete the coffee - it is considered best practice to confirm a deletion 
				from a database which is permanent
				-->
				<div class="coffeeUpdate">
					<p>
						<?php
							$coffeeID = $row['coffeeID'];
							if(($username) == 'admin')
							{
								echo "<a class='btnmanage' href = 'coffee_update.php?coffeeID=$coffeeID'>Update</a>
									<span class='pink'> | </span>
									<a class='btnmanage' href = '../controller/coffee_delete_process.php?coffeeID=$coffeeID' 
									onclick=\"return confirm('Are you sure you want to delete this coffee from store?')\">Delete</a>";							
							}	
						?>
					</p>
					<p>
						<a href = '../controller/cart_add_process.php?coffeeID=<?php echo $coffeeID; ?>&userID=<?php echo $userID; ?>'>
							Add to Cart
						</a>
					</p>
				</div> <!-- end coffeeUpdate -->
			</div> <!-- end coffee -->
		<?php endforeach; ?>
	</div> <!-- end coffees -->
</section> <!-- end main -->

<?php
	//retrieve the footer
	require('footer.php');
?>