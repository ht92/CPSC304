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
	<?php include("headerCustomer.php"); ?>
	<div id="main">
	 <?php include("headerLogo.php") ?>
	<h2> ORDER YOUR CAKE :) </h2>
	<form name="input" action="makeorder.php" method="get">
	<table border="1">
		<th>Item ID</th>
		<th>Name</th>
		<th>Type</th>
		<th>Price</th>

		<tr>
		<td>9999</td>
		<td>strawberry cheesecake</td>
		<td>CAKE</td>
		<td>$0.99<td>
		<input type="checkbox" name="CAKENAME1"><br>
		</tr>

		<tr>
		<td>9999</td>
		<td>whatever cheesecake</td>
		<td>CAKE</td>
		<td>$0.99<td>
		<input type="checkbox" name="CAKENAME1"><br>
		</tr>
		
	<table>
	<tr>
	<td> Total: </td>
	<td> $$$$$ show the price here </td>
	</tr>
	
	<tr>
	<select>
		<option value="pickup">Pickup</option>
		<option value="DHL">DHL</option>
	</select>
	<tr>
	</table>

	</table>
	<input type="submit" value="Make Order"><br>
	</form> 
	
	<h2> Pending Orders </h2>
	<?php include("pendingOrder.php"); ?>
	
	<h2> Past Orders </h2>
	<?php include("pastOrder.php"); ?>
	
<p>STILL DUMMY TABLE, MAKE QUERIES</p>
<?php include("Footer.php"); ?>
</div>
</body>
</html>