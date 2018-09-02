<html>
	<head>
		<title>Process Information</title>
	</head>
	<body>
	<?php
		//I'm using mysqli object oriented style
        $user = $_POST['username'];
		$pass = $_POST['password'];
		
		//create a connection
		$connectionA = new mysqli("localhost","Oakintest","thelanb4time");
		// Check connection
		if ($connectionA->connect_error) {
			die("Connection failed: " . $connectionA->connect_error);
		} 
		echo "Connected successfully.\n ";
		
		//check if data base already exists
		//create a database 
		$sql = "CREATE DATABASE IF NOT EXISTS webappDB";
		if ($connectionA->query($sql) == FALSE) {
			echo "Error creating database: " . $connectionA->error;
		} 
		
		//connect to database
		mysqli_select_db($connectionA,'webappDB');
		
		//create table with two columns
		//Note: Adding unique stops duplication, but the ugly errors appear on screen
		$sql = "CREATE TABLE IF NOT EXISTS Accounts(
		userName VARCHAR(40) NOT NULL,
		passWord VARCHAR(40) NOT NULL,
		UNIQUE(userName,passWord)
		
		)";
		if ($connectionA->query($sql) == FALSE) {
			echo "Error creating table: " . $connectionA->error;
		} 

		
		$sql = "CREATE TABLE IF NOT EXISTS Food(
		itemName VARCHAR(40) NOT NULL,
		instock INT,
		price INT,
		UNIQUE(itemName),
		CHECK(1< instock > 999)

		)";
		if ($connectionA->query($sql) == FALSE) {
			echo "Error creating table: " . $connectionA->error;
		} 
		//insert data into table
		//remember that every time this script is ran, these values are recreated within the database
		//which means there will be duplicates of the values
		//possible solution: making the username a primary key gets rid of duplicates
		//makes sense because there cannot be two of the same usernames in real life :D
		
		$sql = "INSERT INTO Accounts(userName,passWord) VALUES('Popeye','nospinachforyou')";
		if ($connectionA->query($sql) == FALSE) {
			echo "Error inserting data: " . $connectionA->error;
		} 
		$sql = "INSERT INTO Accounts(userName,passWord) VALUES('Olu:D','Akin8857')";
		if ($connectionA->query($sql) == FALSE) {
			echo "Error inserting data: " . $connectionA->error;
		} 
		$sql = "INSERT INTO Accounts(userName,passWord) VALUES('LivinonNoodles','averageCollegekid')";
		if ($connectionA->query($sql) == FALSE) {
			echo "Error inserting data: " . $connectionA->error;
		} 
		$sql = "INSERT INTO Accounts(userName,passWord) VALUES('Owner','BakeryOwner')";
		if ($connectionA->query($sql) == FALSE) {
			echo "Error inserting data: " . $connectionA->error;
		} 
		$sql ="INSERT INTO Food(itemName,instock,price)VALUES('Bread',50,3)";
		if ($connectionA->query($sql) == FALSE) {
			echo "Error inserting data: " . $connectionA->error;
		} 
		$sql ="INSERT INTO Food(itemName,instock,price)VALUES('Brownie',50,1)";
		if ($connectionA->query($sql) == FALSE) {
			echo "Error inserting data: " . $connectionA->error;
		} 
		$sql ="INSERT INTO Food(itemName,instock,price)VALUES('Cake',20,11)";
		if ($connectionA->query($sql) == FALSE) {
			echo "Error inserting data: " . $connectionA->error;
		} 
		$sql ="INSERT INTO Food(itemName,instock,price)VALUES('Cookie',100,1)";
		if ($connectionA->query($sql) == FALSE) {
			echo "Error inserting data: " . $connectionA->error;
		} 
		$sql ="INSERT INTO Food(itemName,instock,price)VALUES('Tart',60,2)";
		if ($connectionA->query($sql) == FALSE) {
			echo "Error inserting data: " . $connectionA->error;
		} 
		$sql ="INSERT INTO Food(itemName,instock,price)VALUES('Cream Puff',150,2)";
		if ($connectionA->query($sql) == FALSE) {
			echo "Error inserting data: " . $connectionA->error;
		} 
			
		
		
		
		//print table 
		$query = "SELECT * FROM Accounts";
		$result = mysqli_query($connectionA,$query);
		//echo "<table>";
		
		$match = FALSE;
		$isOwner = FALSE;
		
		//use this to increment through rows, mysqli_fetch_array can only return one row at a time
		while($row = mysqli_fetch_array($result)){ 
		//echo("<tr><td>".$row['userName']."</td><td>".$row['passWord']."</td></tr>");

		//compare elements of array with user input
		if($row['userName'] == $user && $row['passWord'] == $pass){
			$match = TRUE;
		}
		
		//load to the main menu for customer 
		if($match == TRUE){
			if($user == 'Owner')
				$isOwner = TRUE;
			else
				$isOwner = FALSE;
		}
		else{
			$match = FALSE;
		}
		}
		if($isOwner == TRUE)
		{
			echo "Successful Log In - Owner";
			header("Refresh: 5, url=Ownermenu.php");
		}
		if($isOwner == FALSE && $match == TRUE){
			echo "Successful Log In - Customer";
			header("Refresh: 5, url=Storemenu.php");
		}
		if($match == FALSE){
			//print message, wait 5 seconds and then redirect
			echo "Unsuccessful Log In. Now redirecting....";

			//usleep(5000000); //waits 5 seconds
			
			header("Refresh: 5, url=home.html");
			
		}
		
		
	//	echo "</table>";
		//compare elements in table to entered
		
	//	echo $user;
	
	mysqli_close($connectionA);
    ?>
	
</body>
</html>

