<html>
	<head>
		<title>Purchase Infomation</title>
	</head>
	<body>
<?php
	$itemname = $_POST['itemname'];
	$amount = $_POST['amount'];
	//create a connection
	$connectionA = new mysqli("localhost","Oakintest","thelanb4time");
	// Check connection
	if ($connectionA->connect_error) {
		die("Connection failed: " . $connectionA->connect_error);
	} 
	//connect to database
	mysqli_select_db($connectionA,'webappDB');
	//handle results , adds number in stock to newly stocked items based on item name
	$query = "UPDATE Food SET instock = instock - '$amount' WHERE itemName = '$itemname'";
	if(mysqli_query($connectionA,$query)){
		echo "Update Successful";
		header("Refresh: 5, url=Storemenu.php");
	}
	else
		echo"Error while updating: ".mysqli_error($connectionA);
	
	$query = "DELETE FROM Food WHERE instock <= '0'";
	if(mysqli_query($connectionA,$query)){
		echo "Update Successful";
		header("Refresh: 5, url=Storemenu.php");
	}
	else
		echo"Error while updating: ".mysqli_error($connectionA);


	mysqli_close($connectionA);

?>  
</body>
</html>
