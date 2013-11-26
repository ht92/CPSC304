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
	<?php include "table_item.php"?>
	
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