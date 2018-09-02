<html>
<head>
<style>
table,th,td{border: 1px solid black;}
th,td {text-align: center;}
a{	text-align:left;}
</style>
<meta charset="ISO-8859-1">
<title>Owner - Inventory Database</title>
</head>
<body>
<?php
		$connectionA = new mysqli("localhost","Oakintest","thelanb4time");
		if ($connectionA->connect_error) {
			die("Connection failed: " . $connectionA->connect_error);
		}
		mysqli_select_db($connectionA,'webappDB');

?>
<a href="home.html">Back</a>

<h1 style="text-align:center;"> Bakery Inventory </h1>



<?php
		$query = "SELECT * FROM Food";
		$result = mysqli_query($connectionA,$query);
		
		echo "<table style='width:100%'> 
			<tr>
			<th>Item Name</th>
			<th> Stock</th>
			<th>Price (per unit)</th>
			</tr>";
		while($row = mysqli_fetch_array($result)){
			echo "<tr>";
			echo"<td>".$row['itemName']."</td>";
			echo"<td>".$row['instock']."</td>";
			echo"<td>".$row['price']."</td>";
			echo "</tr>";
		}
		echo"</table>";

		mysqli_close($connectionA);

?>
<h3 style="text-align:Left;"> Restock Items </h3>
<form action="restock.php" method="post">
	<b>Item Name:</b><br/>
		<input type="text" name="itemname" required size=20><br/>
	<b>Order Amount:</b><br/>
	<input type="number" name="amount" min="1" max="999"><br/>
	<input type="submit">
</form>

</body>
</html>