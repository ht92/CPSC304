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

	<br>
	<h2>To restock, click the button below to order from suppliers</h2>
	<button type="button" onclick="alert("Test login")">Make a restock order</button>

	<br>
	<h2> Inventories need to be Restocked </h2>
	<?php include("staff_incompleteOrderTable.php"); ?>

	<h2> All Inventories </h2>
	<?php include("staff_completeOrderTable.php"); ?>

	

	<?php include("Footer.php"); ?>
</div>

</body>
</html> 