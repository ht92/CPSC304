<!DOCTYPE html>
<html>
<head>
<title>Bakerzin-staff</title>
<link href="Site.css" rel="stylesheet">
</head>

<body>
<?php include("headerCustomer.php") ?>
	<div id="main">
	<h1>Make Order</h1> 
	<p>Please fill the following</p>

	<table border="1">
		<form action="account.php">
			<tr>Name:</tr><input type="text" name="email" size="35" disabled value="VARIABLE FOR QUERY"><br>
			<tr>Address:</tr><input type="text" name="pin" size="35" disabled value="VARIABLE FOR QUERY"><br>
			<tr>Phone Number:</tr><input type="text" name="phone" size="35" disabled value="VARIABLE FOR QUERY"><br>
			<tr>Customer ID:</tr><input type="text" name="id" size="35" disabled value="VARIABLE FOR QUERY"><br>
			<! add more attributes here and make query to retrieve information>
			<input type="submit" value="Edit">
		</form>
	<?php include("Footer.php") ?>
	</div>
	</table>

</body>
</html>
