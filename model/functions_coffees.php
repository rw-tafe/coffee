<?php	
	//create a function to retrieve all items
	function get_coffees()
	{
		global $conn;
		//query the database to select all data from the coffee table
		$sql = 'SELECT * FROM coffee ORDER BY coffeeName LIMIT 0,9';		
		//use a prepared statement to enhance security
		$statement = $conn->prepare($sql);
		$statement->execute();
		$result = $statement->fetchAll();
		$statement->closeCursor();
		return $result;
		
	}
	
	//create a function to retrieve a single item
	function get_coffee()
	{
		global $conn;
		
		//retrieve the coffeeID from the URL
		$coffeeID = $_GET['coffeeID'];
		
		$sql = 'SELECT * FROM coffee  WHERE coffeeID = :coffeeID ORDER BY coffeeName';		
		//use a prepared statement to enhance security
		$statement = $conn->prepare($sql);
		$statement->bindValue(':coffeeID', $coffeeID);
		$statement->execute();
		//use the fetch() method to retrieve a single row
		$result = $statement->fetch();
		$statement->closeCursor();
		return $result;
	}
	
	//create a function to add a new item
	function add_coffee($coffeeName, $coffeeDescription, $coffeePrice)
	{
		global $conn;
		$sql = "INSERT INTO coffee (coffeeName, coffeeDescription, coffeePrice) VALUES (:coffeeName, :coffeeDescription, :coffeePrice)";
		$statement = $conn->prepare($sql);
		$statement->bindValue(':coffeeName', $coffeeName);
		$statement->bindValue(':coffeeDescription', $coffeeDescription);
		$statement->bindValue(':coffeePrice', $coffeePrice);
		$result = $statement->execute();
		$statement->closeCursor();
		return $result;		
	}
	
	//create a function to add a new item with a photo
	function add_coffee_with_photo($coffeeName, $coffeeDescription, $coffeePrice, $newPhotoName)
	{
		global $conn;
		$sql = "INSERT INTO coffee (coffeeName, coffeeDescription, coffeePrice, coffeePhoto) VALUES (:coffeeName, :coffeeDescription, :coffeePrice, :coffeePhoto)";
		$statement = $conn->prepare($sql);
		$statement->bindValue(':coffeeName', $coffeeName);
		$statement->bindValue(':coffeeDescription', $coffeeDescription);
		$statement->bindValue(':coffeePrice', $coffeePrice);
		$statement->bindValue(':coffeePhoto', $newPhotoName);
		$result = $statement->execute();
		$statement->closeCursor();
		return $result;		
	}
	
	
	//create a function to update an existing item
	function update_coffee($coffeeID, $coffeeName, $coffeeDescription, $coffeePrice)
	{
		global $conn;
		$sql = "UPDATE coffee SET coffeeName = :coffeeName, coffeeDescription = :coffeeDescription, coffeePrice = :coffeePrice WHERE coffeeID = :coffeeID";
		$statement = $conn->prepare($sql);
		$statement->bindValue(':coffeeName', $coffeeName);
		$statement->bindValue(':coffeeDescription', $coffeeDescription);
		$statement->bindValue(':coffeePrice', $coffeePrice);
		$statement->bindValue(':coffeeID', $coffeeID);
		$result = $statement->execute();
		$statement->closeCursor();
		return $result;		
	}

	//create a function to update an existing item with a photo
	function update_coffee_with_photo($coffeeID, $coffeeName, $coffeeDescription, $coffeePrice, $newPhotoName)
	{
		global $conn;
		$sql = "UPDATE coffee SET coffeeName = :coffeeName, coffeeDescription = :coffeeDescription, coffeePrice = :coffeePrice, coffeePhoto = :coffeePhoto WHERE coffeeID = :coffeeID";
		$statement = $conn->prepare($sql);
		$statement->bindValue(':coffeeName', $coffeeName);
		$statement->bindValue(':coffeeDescription', $coffeeDescription);
		$statement->bindValue(':coffeePrice', $coffeePrice);
		$statement->bindValue(':coffeePhoto', $newPhotoName);
		$statement->bindValue(':coffeeID', $coffeeID);
		$result = $statement->execute();
		$statement->closeCursor();
		return $result;		
	}

	
	//create a function to delete an existing item
	function delete_coffee($coffeeID)
	{
		global $conn;

		// remove any related coffee in cart table FIRST!!
		$sql2 = "DELETE FROM cart WHERE coffeeID = :coffeeID";
		$statement2 = $conn->prepare($sql2);
		$statement2->bindValue(':coffeeID', $coffeeID);
		$result2 = $statement2->execute();
		$statement2->closeCursor();


		// then remove the coffee from coffee table
		$sql = "DELETE FROM coffee WHERE coffeeID = :coffeeID";
		$statement = $conn->prepare($sql);
		$statement->bindValue(':coffeeID', $coffeeID);
		$result = $statement->execute();
		$statement->closeCursor();


		return $result;		
	}

?>