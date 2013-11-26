<!DOCTYPE html>
<html>
<head>
<title>Add New Task</title>
<link href="Site.css" rel="stylesheet">
</head>

<body>
	<div id="main">
  <?php include("headerLogo.php"); ?>
  <h2>Enter the details of your new task:</h2>

<table border="0">
      <tr>
        <td>Item ID:</td>
        <td><form action=""><input type="text" name="itemID"></form></td>
      </tr>
      <tr>
        <td>Quantity: </td>
        <td><form action=""><input type="number" name="quantity"></form></td>
      </tr>
      <tr>
        <td>
          <form method="">
            <input type="submit">
          </form>
        </td>
      </tr>
  </table>

	<?php include("Footer.php"); ?>
</div>

</body>
</html> 
