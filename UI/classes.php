<!DOCTYPE html>
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
	<form name="input" action="classes.php" method="get">
	<table>
		<tr>
		<td> <input type="checkbox" name="CLASSNAME" value="BAKE101" >CLASS NAME QUERIED FROM DATABASE<br> </td>
		</tr>

		<tr>
		<td> <input type="checkbox" name="CLASSNAME" value="BAKE201">CLASS NAME QUERIED FROM DATABASE<br> </td>
		</tr>
	</table>
	<input type="submit" value="Submit"><br>
	</form> 

<p>SHOULD RETRIEVE CLASS NAME BY MAKING QUERY </p>

<?php include("Footer.php"); ?>
</div>

</body>
</html>
