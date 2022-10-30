<?php
	//start session management
	session_start();
	//include authorisation management
	require('../controller/authorisation.php');
	//connect to the database
	require('../model/database.php');
    //retrieve the functions
	require('../model/functions_messages.php');
	require('../model/functions_order.php');

	//provide the value of the $title variable for this page
	$title = "My Account";
	
	require('header.php');
	require('nav.php');
?>

<section id="main">
	<h2>My Account</h2>
	
	<?php
		//call user_message() function
		$message = user_message();
        //get user
		$user = get_user();
		$result = get_orders($user['userID'])
	?>
		
	<!-- display account info-->	
	<div id="userInfo">
        <div class="userDetails">
            <div class="infoTitle"><b>Name:</b></div><?php echo $user['firstName']; ?> <?php echo $user['lastName']; ?></br>
            <div class="infoTitle"><b>Email:</b></div><?php echo $user['email']; ?></br>
            <div class="infoTitle"><b>Username:</b></div><?php echo $user['username']; ?>
        </div>	
	</div>

	<!-- display order info-->
	<h2>My Orders</h2>
	<div class="orders">
		<div class="orderHeader">
			<div>Order Number</div>
			<div>Items</div>
			<div>Total Price</div>
			<div>Order Time</div>
		</div>
		<?php foreach($result as $row):?>		
			<div class="orderInfo">		
				<div>
					<?php echo str_pad($row['orderID'], 10, '0', STR_PAD_LEFT); ?>
				</div>
				<div>
					<?php echo $row['orderItems']; ?>
				</div>				
				<div>
					<?php echo date("d/m/Y",strtotime($row['orderTime']))."<br/>".date("h:i:sa",strtotime($row['orderTime'])); ?>
				</div>
				<div>
					$<?php echo $row['orderPrice']; ?>
				</div>
			</div> 		
		<?php endforeach; ?>
	</div>

</section>

<?php
	require('footer.php');
?>

