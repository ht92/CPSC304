<!DOCTYPE html>
<?php include "userInfo.php";
      include "utility.php" ?>
<html>
<head>
  <title>Bakerzin Courses</title>
  <link href="Site.css" rel="stylesheet">
</head>
<body>

	<?php include("headerCustomer.php"); ?>
	<div id="main">
	 <?php include("headerLogo.php") ?>

	 <h2> Currently Registerd</h2>
	<?php include("currentClasses.php"); ?>

	<h2> Past Classes </h2>
	<?php include("pastClasses.php"); ?>
	 
	<h2> Upcoming Classes </h2>
	<?php include "upcomingClasses.php"; ?>
<?php include("Footer.php"); ?>
</div>

</body>
</html>
