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
	First Name: <input type="string" name="firstName"><br> <br>
	Last Name: <input type="string" name="lastName"><br> <br>
	Address: <input type="string" name="address"><br> <br> 
	Phone Number:<input type="string" name="phoneNumber"><br> <br>
	User Name: <input type="string" name="userName"><br> <br>
	Password: <input type="password" name="password"><br>
	<p> Password must be between 8-16 characters length </p><br>
	<input type="submit">
	</form>
	<?php include("Footer.php") ?>
</div>
</body>

</html>