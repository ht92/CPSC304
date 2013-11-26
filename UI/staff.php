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
  <?php 
       $nameQuery = "select fname, lname from users u where u.userID = '" . 
                    $userID . "'";
       $result = executeCommand($nameQuery);
       $row = OCI_Fetch_Array($result, OCI_NUM);
      echo "Welcome ". $row[0] . " " . $row[1]; 
      oci_free_statement($result);?>
  
  <h2>In-progress Tasks</h2>
  <?php 
	$dashboard = true;
	include("staff_task_table.php");
	echo "<h2> Pending Order </h2>";
	include("orderTables.php");
   ?>
   
  <?php include("Footer.php"); 
   OCILogoff($dbHandle); ?>
</div>
</body>

</html>
