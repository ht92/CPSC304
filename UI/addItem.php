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
	
	<form name"TaskAdded" method="post" action="">
	<table border="0">
      <tr>
        <td>Item ID:</td>
        <td><input type="text" name="itemID"></td>
      </tr>
      <tr>
        <td>Quantity: </td>
        <td><input type="number" name="quantity"></td>
      </tr>
      <tr>
        <td>
            <input type="submit" name='submitted'>
        </td>
      </tr>
	</table>
	</form>
	
	</div>
</body>
</html>