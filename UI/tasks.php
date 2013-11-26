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

     <?php include "utility.php"; ?>
	<h2> In-Progress Tasks </h2>
	<?php include("staff_task_table.php"); ?>
	<?php
	echo "<form name='newTask' method='post' action='addTasks.php" . $appendData . "'>
            <input type='submit' value='Add New Task'>
  	</form>";
        ?>

	<h2> Completed Tasks </h2>
	<?php include("staff_completed_task_table.php"); ?>


	<h2> Classes </h2>
	<?php include("classTaskTable.php"); ?>
	<?php include("Footer.php"); ?>
</div>

</body>
</html> 
