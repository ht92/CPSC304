<!--
	filename: bakingSchool.php
	created on: Oct 24, 2013

	Customer homepage after login
-->

<!DOCTYPE html>

<html>
<head>
  <title>Registration</title>
  <link href="Site.css" rel="stylesheet">
</head>

<body>
	<?php include("headerCustomer.php") ?>
	<div id="main">
	<h1>Welcome to Bakerzing Baking School!</h1> 
	<p>Registration form</p>
	<form action="registration.php" method="post">
	Name: <input type="string" name="name"><br>
	Address: <input type="string" name="address"><br>
	Phone Number:<input type="string" name="phoneNumber"><br>
	User Name: <input type="string" name="userName"><br>
	Password: <input type="string" name="password"><br>
	<input type="submit">
	</form>
	<?php include("Footer.php") ?>
</div>
</body>

</html>