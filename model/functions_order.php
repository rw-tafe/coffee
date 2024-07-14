<?php

    //create a function to list items in cart
	function get_orders($userID)
	{
		global $conn;
		//query the database to select all data from the order_history table       

		$sql = 'SELECT * FROM order_history WHERE userID = :userID ORDER BY orderTime DESC';		
		//use a prepared statement to enhance security
		$statement = $conn->prepare($sql);
        $statement->bindValue(':userID', $userID);
		$statement->execute();
		$result = $statement->fetchAll();
		$statement->closeCursor();
		return $result;
	}

?>