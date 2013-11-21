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
		<th>LIST OF CAKES)</th>
		<th></th>

		<tr>
		<td> CAKE NAME</td>
		<td> <input type="checkbox" name="CAKENAME1"><br> </td>
		</tr>

		<tr>
		<td> CAKE NAME</td>
		<td> <input type="checkbox" name="CAKENAME2" value="CAKE"><br> </td>
		</tr>
		
	<table>
	<tr>
	<td> Total: </td>
	<td> $$$$$ show the price here </td>
	</tr>
	</table>

	</table>
	<input type="submit" value="Make Order"><br>
	</form> 
	
<p>STILL DUMMY TABLE, MAKE QUERIES</p>
<?php include("Footer.php"); ?>
</div>
</body>
</html>