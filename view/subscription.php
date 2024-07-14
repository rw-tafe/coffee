<?php
	//////////////////////////////////////
	//////////////////////////////////////
	// this page has a big error! 
	// if the user has logged in, MUST check if the user's email and subscription email are matched
	// if NOT matched, need to use exisiting user account email; 
	// ohterwise, it would be a data breach!!!!
	//////////////////////////////////////
	//////////////////////////////////////
	
	//start session
	session_start();
	//connect to the database
	require('../model/database.php');
    //retrieve the functions
	require('../model/functions_messages.php');
	// require('../model/functions_subscription.php');

	//provide the value of the $title variable for this page
	$title = "My Subscription";

	require('header.php');
	

	if(isset($_SESSION['subEmail']))
	{
		//if email session is not empty, use it; otherwise, use encrypted email from POST method
		$subEmail = $_SESSION['subEmail'];
		unset($_SESSION['subEmail']);
	}
	else{
		/////////////////////////////////////////////////
		//security process to decrypt subscriber's email,
		//converte encryption email to readable
		/////////////////////////////////////////////////
		//get encrypted email address from POST method
		$encryptedEmail = $_POST['subEmail'];
		//store the cipher method
		$ciphering = "AES-128-CTR";
		//use OpenSSl Encryption method
		$iv_length = openssl_cipher_iv_length($ciphering);
		$options = 0;
		//Non-NULL Initialization Vector for decryption
		$decryption_iv = '1234567891011121';
		//store the decryption key
		$decryption_key ="subscriberEmail";

		// use decryption to get subscriber's email
		$subEmail = openssl_decrypt ($encryptedEmail, $ciphering, $decryption_key, $options, $decryption_iv);
	}

	//call function to get existing subscriber's categories
	$subCategory = get_sub_categoryIDs($subEmail);
?>

<section id="main">
	<h2>My Subscription</h2>

	<?php
		//call user_message() function
		$message = user_message();
	?>

	<!-- display order info-->
	<div class="subCategory">
		<div class="categoryHeader">			
			<div>
				<?php echo "Subscription Email: <b>".$subEmail."</b>"; ?>
			</div>
			<br/>
			<h3>Category</h3>

			<!-- get subscriber's current categories -->
			<?php $subCatIDs =""; ?>
			<?php foreach($subCategory as $category):?>			
				<?php
					// if subscriber's categories is '%', convert it to current website full subscription category list
					if($category['subCategoryIDs'] == "%")
					{
						$category['subCategoryIDs'] = $fullSubCategoryList;
					}
					$subCatIDs = $category['subCategoryIDs'];
				?>	
			<?php endforeach; ?>

			<form id="subFormUpdate" action="../controller/subscription_update_process.php" method="get" enctype="multipart/form-data">
				<?php echo '<input name="subEmail" type="hidden" value="'.$subEmail.'"/>'; ?>
				<?php foreach($categoryLibrary as $categoryOption):?>
					<?php 
						$categoryOptionID = $categoryOption['subCatID']; 
						$categoryOption = $categoryOption['subCategory'];						

						if(str_contains($subCatIDs, $categoryOptionID)) 
						{
							echo "<input id=\"$categoryOptionID\" class='categoryCheckbox' type=\"checkbox\" name='subCategoryIDs[]' 
							value=\"$categoryOptionID\" checked>$categoryOption";
						}
						else{
							echo "<input id=\"$categoryOptionID\" class='categoryCheckbox' type=\"checkbox\" name='subCategoryIDs[]' 
							value=\"$categoryOptionID\">$categoryOption";
						}					
					?>
				<?php endforeach; ?>
				<br/>
				<input id="subUpdate" type="submit" value="Update Subscribe" />
			</form>
		</div>
	</div>

</section>

<?php
	require('footer.php');
?>

