<?php
    //clear up cart
    function checkout($userID, $cartItems, $totalPrice)
	{
		date_default_timezone_set('Australia/Brisbane');

		global $conn;
        // update cart items' status
		$sql = "UPDATE cart SET cartStatus = :cartStatus WHERE userID = :userID";
		$statement = $conn->prepare($sql);
		$statement->bindValue(':cartStatus', 'paid');
		$statement->bindValue(':userID', $userID);
		$result = $statement->execute();
		$statement->closeCursor();
        
        //create a new order
		$sql2 = "INSERT INTO order_history (orderItems, orderPrice, userID, orderTime) VALUES (:orderItems, :orderPrice, :userID, :orderTime)";
		$statement2 = $conn->prepare($sql2);
		$statement2->bindValue(':orderItems', $cartItems);
		$statement2->bindValue(':orderPrice', $totalPrice);
		$statement2->bindValue(':userID', $userID);
		$statement2->bindValue(':orderTime', date("Y-m-d h:i:sa"));
		$result2 = $statement2->execute();
		$statement2->closeCursor();

		return $result;	       

	}
?>