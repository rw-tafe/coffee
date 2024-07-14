<?php
	//check subscriber email
	function check_sub_email($subEmail)
	{
		global $conn;
        $sql = "SELECT subID, subDate, subStatus FROM subscription WHERE email = :subEmail";
        $statement = $conn->prepare($sql);
        $statement->bindValue(':subEmail', $subEmail);
		$statement->execute();
		$result = $statement->fetchAll();
		$statement->closeCursor();
		return $result;
	}

	//create a function to list subscriber's categories
	function get_sub_categoryIDs($subEmail)
	{
		global $conn;
		//query the database to select all data from the cart table
		$sql = 'SELECT subCategoryIDs FROM subscription WHERE email = :subEmail';		
		//use a prepared statement to enhance security
		$statement = $conn->prepare($sql);
        $statement->bindValue(':subEmail', $subEmail);
		$statement->execute();
		$result = $statement->fetchAll();
		$statement->closeCursor();
		return $result;
	}

	//get website subscription categories
	function get_sub_category_list()
	{
		global $conn;
		//query the database to select all data from the cart table
		$sql = 'SELECT * FROM subcategory';
		$statement = $conn->prepare($sql);
		$statement->execute();
		$result = $statement->fetchAll();
		$statement->closeCursor();
		return $result;
	}

    //create a function to add new subscriber
    function add_new_sub($subEmail, $subCategory)
    {
        global $conn;
        $sql = "INSERT INTO subscription (subID, email, subCategoryIDs, subDate, subStatus) VALUES (:subID, :email, :subCategoryIDs, :subDate, :subStatus)";
        $statement = $conn->prepare($sql);
        $statement->bindValue(':subID', $subID);
        $statement->bindValue(':email', $subEmail);
        $statement->bindValue(':subCategoryIDs', $subCategory);
        $statement->bindValue(':subDate', date("Y-m-d h:i:sa"));
		$statement->bindValue(':subStatus', 'active');
        $result = $statement->execute();
        $statement->closeCursor();
        return $result;		
    }

	//update subscriber's categories
	function update_sub($subEmail, $subCategoryIDs)
	{
		global $conn;
		$sql = "UPDATE subscription SET subCategoryIDs = :subCategoryIDs WHERE email = :subEmail";
		$statement = $conn->prepare($sql);
		$statement->bindValue(':subCategoryIDs', $subCategoryIDs);
        $statement->bindValue(':subEmail', $subEmail);
		$result = $statement->execute();
        $statement->closeCursor();
        return $result;		
	}


?>