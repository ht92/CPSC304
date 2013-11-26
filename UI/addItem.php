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
	<?php include "utility.php"; 
        if(isset($_POST['submitted']))
        {
           $itemID = str_pad($_POST['itemID'], 5, "0", STR_PAD_LEFT);
           $query = "insert into item values('" . $itemID . "', '"
                    . $_POST['itemName'] . "', '" . $_POST['itemType'] .
                    "', " . $_POST['price'] . ")";
           oci_free_statement(executeCommand($query));
           if(!$status)
           {
              echo "<br>Error adding Item to DataBase<br>";
           }
           else
           {
              OCICommit($dbHandle);
           }
        }
        OCILogoff($dbHandle);  
             ?>
	
	<form name"TaskAdded" method="post" action="">
	<table border="0">
      <tr>
        <td>Item ID:</td>
        <td><input type="text" name="itemID"></td>
      </tr>
      <tr>
        <td>Name:</td>
        <td><input type="text" name="itemName"></td>
      </tr>
      <tr>
         <td>Type:</td>
         <td><input type='text' name='itemType'></td>
      </tr>
      <tr>
         <td>Price</td>
         <td><input type='float' name='price'></td>
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
