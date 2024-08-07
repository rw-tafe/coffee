<?php
  	//connect to the database
	require('../model/functions_subscription.php');	
	$categoryLibrary = get_sub_category_list();
?>
<?php 
	// get all website subscription list
	$fullSubCategoryList = ""; 
?>
<?php foreach($categoryLibrary as $categoryOption):?>
	<?php $fullSubCategoryList = $fullSubCategoryList.$categoryOption['subCatID'].","; ?>
<?php endforeach; ?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
	<!-- add a variable called $title to the title tags so you can insert a new value on each web page -->
	<title><?php echo $title ?></title>
	<link rel="icon" href="../images/favicon.png" />
    <link rel="stylesheet" href="../css/main.css">
</head>

<body>
	<section id="container">
		<header>
			<div class="logo">
				<a href = "coffees.php">
					<img src="../images/rc-logo.png">
				</a>				
				<h1><span class="icon">Rossco's Coffee</span></h1>
				<p class="slogan">Always ready!</p>
			</div>
		</header>