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

	<!--<h2> Find Order </h2>
	<table border="0">
  		<tr>
    		<td>Order ID</td>
    		<td><form action=""><input type="text" name="orderID"></form></td>
    		<td><input type="submit" value="submit"></td>
  		</tr>
  		<tr>
  			<td>Made for Date </td>
  			<td><form action=""><input type="date" name="madeForDate"></form></td>
  			<td><input type="submit" value="submit"></td>
  		</tr>
	</table>-->


	<h2>Pending Order</h2>
	<?php include("staff_incompleteOrderTable.php"); ?>

	<h2>Completed Order</h2>
	<?php include("staff_completeOrderTable.php"); ?>


	<?php include("Footer.php"); ?>
</div>

</body>
</html> 