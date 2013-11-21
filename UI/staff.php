<!--
	filename: staff.php
	created on: October 24, 2013

	Staff homepage after login
-->
<!DOCTYPE html>

<html>
<head>
  <title>Bakerzin-Staff</title>
  <link href="Site.css" rel="stylesheet">
</head>

<body>
	<?php include("headerStaff.php") ?>
  <div id="main">
  <?php include("headerLogo.php") ?>
  <?php include("session.php") ?>

  <?php echo "Welcome ".$username."."; ?>

  <?php include("Footer.php") ?>
</div>
</body>

</html>