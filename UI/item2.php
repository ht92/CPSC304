<!DOCTYPE html>
<html>
<head>
<title>Bakerzin-staff</title>
<link href="Site.css" rel="stylesheet">
</head>

<body>
<?php include("headerStaff.php"); ?>
	<div id="main">
	<?php include("headerLogo.php"); 
          include "utility.php";
          

          $itemID = $_GET['itemID'];

          if(isset($_POST['save']))
          {
             $itemUpdate = "update Item set itemName = '" . $_POST['name']
                           . "', itemType = '" . $_POST['type'] . 
                           "', price = " . $_POST['price'] . 
                           " where itemID = '" . $itemID . "'";
             oci_free_statement(executeCommand($itemUpdate));
             if(!$status)
             {
                echo "<br>Error updating item information<br>";
             }
             else
             {
                OCICommit($dbHandle);
                header("Location: item.php" . $appendData);
                OCILogoff($dbHandle);
             }
          }
          $itemInfo = "select * from item where itemID = '" . $itemID . "'";
          $result = executeCommand($itemInfo);
          $row = OCI_Fetch_Array($result, OCI_NUM);
          oci_free_statement($result); 
        ?>

	<form name='update' method="post" action="">
	<table border="1">
	<tr>
		<th>Item ID</th>
		<th>Item Name</th>
		<th>Type </th>
		<th>Price </th>
	</tr>
	<tr>
		<td><input type="text" name="id" value="<?php echo $row[0]; ?>" disabled></td>
		<td><input type="text" name="name" value="<?php echo 
                                                            $row[1]; ?>">
                </td>
		<td><input type="text" name="type" value="<?php echo 
                                                          $row[2] ?>"></td>
		<td><input type="text" name="price" value="<?php echo
                                                             $row[3] ?>">
                </td>
	</tr>
	</table>
	
	<input type="submit" name='save' value="save">
	
	</form>
	
	<?php include("Footer.php"); 
         OCILogoff($dbHandle); ?>
	</div>
</body>
