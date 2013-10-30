<!--
	filename: index.php
	created on: Oct 24, 2013

	homepage for Bakerzin application
-->
<!DOCTYPE html>

<html>
<head>
  <title>Bakerzin-Home</title>
  <link href="Site.css" rel="stylesheet">
</head>

<body>
  <div id="main">
  <?php include("headerLogo.php"); ?>

  <h2>Welcome to Bakerzin Bakery and Baking School</h2>
  <p>Enter as:</p>

  <ul id="loginOptions">
	<li><a href="customer.php">Customer</a></li> 
	<li><a href="staff.php">Staff</a></li> 
	<li><a href="login.php">Login</a></li>
  </ul> 

  <?php include("Footer.php"); ?>

</div>

</body>
</html>