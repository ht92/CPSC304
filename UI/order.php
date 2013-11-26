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

	<!--<h2> Find Order </h2>
	<table border="0">
  		<tr>
    		<td>Order ID</td>
    		<td><form action=""><input type="text" name="orderID"></form></td>
    		<td><input type="submit" value="submit"></td>
  		</tr>
  		<tr>
  			<td>Made for Date </td>
  			<td><form action=""><input type="date" name="madeForDate"></form></td>
  			<td><input type="submit" value="submit"></td>
  		</tr>
	</table>-->


	<h2>Pending Order</h2>
	<?php
           include "utility.php";
           if($dbHandle)
           {
              if(isset($_POST['isChecked']))
              {
                 $date = date("j-m-y");
                 $checkedRows = $_POST['isChecked'];
                 foreach($checkedRows as $orderID)
                 {
                    $completionUpdate = "update Orders set completed = 'T'
                                        where orderID = '" . $orderID ."'";
                    executeCommand($completionUpdate);
                    
                    $trackingQuery = "select trackingID from Orders o 
                                      where o.orderID = '" . $orderID . "'";
                   
                   $result = executeCommand($trackingQuery);
                   $trackingID = OCI_Fetch_Array($result, OCI_NUM);
                   $shippingUpdate = "update ShippingDetails set 
                                      shippingDate = '" . date("j-m-y") .
                                      "' where trackingID = '"  . 
                                      $trackingID[0] . "'";
                   executeCommand($shippingUpdate);
                   OCICommit($dbHandle);
                 }
              }
              $query = "select distinct(orderID), orderDate, customerID
                        from Orders o
                        where o.trackingID is null and
                        o.completed is null
                        order by orderID asc";
              $result =  executeCommand($query);
              if($status)
              {
                 $columns = array("Order ID", "Order Date", "Customer ID");
                 echo "<form name='Pending Orders' method='post'
                        action='order.php" . $appendData . "'>";
                 printTable($result, $columns, True);
                 echo "<input type='submit' value='Order Shipped'></form>";
              }
              
              $result = executeCommand("select distinct(orderID), orderDate,
                                       customerID
                                       from Orders o where
                                       o.completed is not null
                                       order by orderID asc");
              if($status)
              {
                 echo "<h2>Completed Orders</h2>";
                 $columns = array("Order ID", "Order Date", "Customer ID");
                 printTable($result, $columns);
              }
              else
	      {
                 echo "<br>Unable to generate table<br>";
              }
           }
           else
           {
              echo "<br>Unable to connect to database<br>";
           }
           OCILogoff($dbHandle); 
       ?>


	<?php include("Footer.php"); ?>
</div>

</body>
</html> 
