<?php
	//start session management
	session_start();
	//include authorisation management
	require('../controller/authorisation.php');
	//connect to the database
	require('../model/database.php');
	//retrieve the functions
	require('../model/functions_messages.php');
    //retrieve the functions
    //require('../model/functions_cart.php');

	//provide the value of the $title variable for this page
	$title = "Shopping Cart";
	
	//retrieve the header
	require('header.php');
	//retrieve the navigation
	require('nav.php');
?>

<section id="main">
	<h2>My Coffee Tray</h2>	
	
	<?php
		//call user_message() function
		$message = user_message();
		
        //get userID
		$userID = get_user()['userID'];
		$result = get_cart_items($userID);
	?>

    <div id="cartItems">
		<div class="tableHeader">
			<div>Coffee</div>
			<div>Unit Price</div>
			<div>Quantity</div>
			<div></div>
		</div>

		<?php
			$totalPrice = 0;
			$cartItems = "";			
		?>

		<?php foreach($result as $row):?>			
			<div class="tableRow">			
				<div>
					<?php echo $row['coffeeName']; ?>
				</div>
				<div>
					<?php echo $row['quantity']; ?>
				</div>
				<div>
					$<?php echo $row['coffeePrice']; ?>
				</div>
				<div>
					<a class="btnmanage" href ='../controller/cart_delete_process.php?cartID=<?php echo $row['cartID']; ?>' onclick="return confirm('Are you sure you want to delete one of this coffee?')">
						Delete
					</a>
				</div>							
			</div>
			<?php
				$totalPrice = floatval($row['coffeePrice']) * intval( $row['quantity'] ) + $totalPrice;
				$cartItems = $row['coffeeName'] . " x " . $row['quantity'] . "<br/>" . $cartItems;
			?>
		<?php endforeach; ?>

		<div class="totalPrice tableRow">
			<div></div>
			<div></div>
			<div>
				Total: $<?php echo $totalPrice; ?>
			</div>
			<div>
				<a href = '../controller/checkout_process.php?userID=<?php echo $userID; ?>&cartItems=<?php echo $cartItems; ?>&totalPrice=<?php echo $totalPrice; ?>'>
					Check Out
				</a>
			</div>
		</div>
	</div>	
	
</section> <!-- end main -->

<?php
	//retrieve the footer
	require('footer.php');
?>