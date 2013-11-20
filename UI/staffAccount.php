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

	<h2> Find Customer </h2>
	<table border="0">
  		<tr>
    		<td>User name</td>
    		<td><form action=""><input type="text" name="orderID"></form></td>
    		<td><input type="submit" value="search"></td>
  		</tr>
	</table>


	<h2> Search Result </h2>
	<h3> Show search result here, or display no related result found </h3>


	<?php include("Footer.php"); ?>
</div>

</body>
</html> 