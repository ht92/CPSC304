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
	<?php include("headerStaff.php"); ?>
  <div id="main">
  <?php include("headerLogo.php"); ?>
  
  <?php include "utility.php"; ?>
  <?php echo "Welcome ".$username."."; ?>
  
  <h2>In-progress Tasks</h2>
  <?php 
	$dashboard = true;
	include("staff_task_table.php");
	echo "<h2> Pending Order </h2>";
	include("orderTables.php");
   ?>
   
  <?php include("Footer.php"); ?>
</div>
</body>

</html>
