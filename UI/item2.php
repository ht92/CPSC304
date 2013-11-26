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
	<form method="post" action="item.php">
	<table border="1">
	<tr>
		<th>Item ID</th>
		<th>Item Name</th>
		<th>Type </th>
		<th>Price </th>
	</tr>
	<tr>
		<td><input type="text" name="id" value="variable" disabled></td>
		<td><input type="text" name="name" value="variable"></td>
		<td><input type="text" name="type" value="variable"></td>
		<td><input type="text" name="price" value="variable"></td>
	</tr>
	<tr>
		<td><input type="text" name="id" value="variable" disabled></td>
		<td><input type="text" name="name" value="variable"></td>
		<td><input type="text" name="type" value="variable"></td>
		<td><input type="text" name="price" value="variable"></td>
	</tr>
	</table>
	
	<input type="submit" value="save">
	
	</form>
	
	<?php include("Footer.php"); ?>
	</div>
</body>