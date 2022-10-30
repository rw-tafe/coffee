<?php
  //connect to the database
	require('../model/database.php');
	//retrieve the functions
	require('../model/functions_users.php');
  require('../model/functions_cart.php');  
	
	//retrieve the username and password entered into the form
	$username = $_SESSION['user'];
  //get userID
  $userID = get_user()['userID'];
  $cartCount = count_cart_items($userID);
?>


<?php
  // using nav_admin class if the user is admin
  if(($username) == 'admin')
  {
    echo "<div id='nav_admin'>"; 
  }
  else{
    // other uses use nav (normal) class
    echo "<div id='nav'>";
  }
?>
	<div class="link-container">
	  <a class="link-blue link-move" href="coffees.php">All Coffees</a>
	</div>

  <?php
    //showing 'Add Coffee' menu if user is admin
    if(($username) == 'admin')
    {
      echo "<div class='link-container'>
        <a class='link-yellow link-move' href='coffee_add.php'>Add Coffee</a>
      </div>"; 
    }		
	?>

	<div class="link-container">
		<a class="link-pink link-move" href="account.php">My Account</a>
	</div>
	<div class="link-container">
    <?php
      if ($cartCount>0)
      {
        echo "<a class='link-orange link-move' href='cart.php'>My Tray ($cartCount)</a>";
      }
      else
      {
        echo "<a class='link-orange link-move' href='cart.php'>My Tray</a>";
      }
    ?>
		
	</div>
	<div class="link-container">
		<a class="link-purple link-move" href="../controller/logout_process.php">Logout</a>
	</div>


</div>