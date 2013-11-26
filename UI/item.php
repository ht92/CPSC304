<!DOCTYPE html>
<html>
<head>
<title>Bakerzin-staff</title>
<link href="Site.css" rel="stylesheet">
</head>

<body>
<?php include("headerStaff.php"); ?>
	<div id="main">
	<?php include("headerLogo.php"); ?>
	<?php include "utility.php"; ?>
	
	<h2> Item </h2>
	<table border="1">
	<tr>
		<th>Item ID</th>
		<th>Item Name</th>
		<th>Type </th>
		<th>Price </th>
	</tr>
	<tr>
		<td>row 1, cell 1</td>
		<td>VARIABLES FROM QUERIES</td>
		<td>asdf</td>
		<td>asdf</td>
	</tr>
	<tr>
		<td>row 1, cell 1</td>
		<td>row 1, cell 2</td>
		<td>asdf</td>
		<td>asdf</td>
	</tr>
	</table>
	
	<?php 
	echo "<form method='get' action='addItem.php" . $appendData ."'>
	<input type='submit' value='Add Item'>
	</form>";
	?>
	
	<form>
	<input type="submit" value="Delete">
	</form>
	
	<form method="link" action="item2.php">
	<input type="submit" value="Edit">
	</form>
	<?php include("Footer.php"); ?>
	</div>
	
</body>
</html>