<?php
    //create a function to add item to cart
    function add_item_to_cart($coffeeID, $cartStatus, $userID, $coffeeQuantity)
    {
        global $conn;
        $sql = "INSERT INTO cart (coffeeID, cartStatus, userID, coffeeQuantity) VALUES (:coffeeID, :cartStatus, :userID, :coffeeQuantity)";
        $statement = $conn->prepare($sql);
        $statement->bindValue(':coffeeID', $coffeeID);
        $statement->bindValue(':cartStatus', $cartStatus);
        $statement->bindValue(':userID', $userID);
        $statement->bindValue(':coffeeQuantity', $coffeeQuantity);
        $result = $statement->execute();
        $statement->closeCursor();
        return $result;		
    }

    //create a function to list items in cart
	function get_cart_items($userID)
	{
		global $conn;
		//query the database to select all data from the cart table       

		$sql = 'SELECT coffeeName, coffeeDescription,coffeePrice,coffeePhoto, coffeeID, cartID, cartStatus, userID, count(coffeeID) AS quantity FROM cart INNER JOIN coffee USING(coffeeID) WHERE userID = :userID and cartStatus = :cartStatus GROUP BY coffeeID ORDER BY coffeeName';		
		//use a prepared statement to enhance security
		$statement = $conn->prepare($sql);
        $statement->bindValue(':userID', $userID);
		$statement->bindValue(':cartStatus', 'unpaid');
		$statement->execute();
		$result = $statement->fetchAll();
		$statement->closeCursor();
		return $result;
	}

    //create a function to retrieve cart item quantity
	function count_cart_items($userID)
	{
		global $conn;
		$sql = 'SELECT * FROM cart WHERE userID = :userID and cartStatus = :cartStatus';
		$statement = $conn->prepare($sql);
		$statement->bindValue(':userID', $userID);
        $statement->bindValue(':cartStatus', 'unpaid');
		$statement->execute();
		$result = $statement->fetchAll();
		$statement->closeCursor();
		$count = $statement->rowCount();	
		return $count;
	}

	//create a function to delete an existing cart item
	function delete_cart_item($cartID)
	{
		global $conn;

		$sql = "DELETE FROM cart WHERE cartID = :cartID";
		$statement = $conn->prepare($sql);
		$statement->bindValue(':cartID', $cartID);
		$result = $statement->execute();
		$statement->closeCursor();

		return $result;		
	}




?>