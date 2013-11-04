<!--
	filename: customer.php
	created on: Oct 29, 2013

	to make order: needs search bar and insert button
	then new page pop up
-->
<!DOCTYPE html>

<html>
<head>
  <title>Make Order</title>
  <link href="Site.css" rel="stylesheet">
</head>

<body>
	<?php include("headerCustomer.php") ?>
	<div id="main">
	<h1>Make Order</h1> 
	<p>Please fill the following</p>
	<form action="makeorder.php" method="post">
	Made for date: <input type="date" name="madefordate"><br>
	Name: <input type="text" name="name"><br>
	Number of Item <input type="integer" name="quantityordered"><br>
	<input type="submit">
	</form>
	<?php include("Footer.php") ?>
</div>
</body>

</html>