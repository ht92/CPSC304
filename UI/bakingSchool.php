<!--
	filename: bakingSchool.php
	created on: Oct 24, 2013

	Customer homepage after login
-->

<!DOCTYPE html>

<html>
<head>
  <title>Baking School</title>
  <link href="Site.css" rel="stylesheet">
</head>

<body>
<?php include("headerCustomer.php"); ?>
<div id="main">
  

  <h1>Welcome to Bakerzin Bakery and Baking School</h1>
  <p>Registration and Schedule This Year</p>

  <ul id="loginOptions">
	<li><a href="registration.php">Register here!</a></li>
	<li><a href="schedule.php">Schedule</a></li> 
  </ul> 

  <?php include("Footer.php"); ?>

</div>
</body>

</html>