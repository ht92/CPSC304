<!--
	filename: staff.php
	created on: October 24, 2013

	Staff homepage after login
-->
<!DOCTYPE html>

<html>
<head>
  <title>Customer Info</title>
  <link href="Site.css" rel="stylesheet">
</head>
<body>
	<?php include("headerStaff.php"); ?>
	<div id="main">
	<?php include("headerLogo.php"); 
		include("utility.php");
		
		// user ID is customer UserID and staffID is staffUserID
		$userID = $_GET['customerID'];
		$staffUserID = $_GET['userID'];
		
		$dataQuery = "select * from Users where userID = '" . $userID . "'";
		$result = executeCommand($dataQuery);
		$row = OCI_Fetch_Array($result, OCI_BOTH);
		if ($row)
		{
			echo "<h2> Account info for " . $row['FNAME'] . " " . $row['LNAME'] . "</h2>";
			echo "
			<table>
				<tr> <td>First Name:</td> <td>" . $row['FNAME'] . "</td> </tr>
				<tr> <td>Last Name:</td> <td>" . $row['LNAME'] . "</td></tr>
				<tr> <td>Address: </td> <td>" . $row['ADDRESS'] ."</td></tr>
				<tr> <td>Phone Number: </td> <td>" . $row['PHONENUMBER'] ."</td></tr>
			</table> <br>";
		}
		
		echo "<h2> Pending Order </h2>";
		$query = "select distinct (orderID), orderDate, shippingType
          from Orders o, ShippingDetails sd
          where '" . $userID . "' = o.customerID and
          o.trackingID = sd.trackingID and 
          o.completed is null order by orderID asc";
		  
		if($dbHandle)
		{
			$result = executeCommand($query);
			$columns = array("Order Id", "Order Date", "Shipping Method");

			echo "<form name='removeOrder' method='post' action='customer.php?" . 
				$appendData . "'>";
			printTable($result, $columns, false);
			oci_free_statement($result);
		}
		
		echo "<h2> Enrolled Classes </h2>";
		include ("currentClasses.php");
		
		include("Footer.php");
	?>

</div>
</body>
</html>
