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

	<?php 	
		if ($isStudent) {
			echo "<h2> Currently Registered </h2>";
			include("currentClasses.php");
			
			echo "<br>";
			echo "<h2> Past Classes </h2>";
			include("pastClasses.php");
			
			echo "<br>";
			echo "<h2> Upcoming Classes </h2>";
			include ("upcomingClasses.php");
			
		} else {
			echo "<h2> You are not a student </h2>";
			include ("beAStudent.php");
		}
	?>
	
	

<?php include("Footer.php"); ?>
</div>

</body>
</html>
