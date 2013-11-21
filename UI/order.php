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
              $query = "select distinct(orderID), orderDate, customerID
                        from Orders o
                        where o.trackingID is null
                        order by orderID asc";
              $result =  executeCommand($query);
              if($status)
              {
                 $columns = array("Order ID", "Order Date", "Customer ID");
 
                 printTable($result, $columns, True);
              }
              echo "<br><form name='submit'>
                        <input type='submit' value='Order Shipped'></form>";
              $result = executeCommand("select distinct(orderID), orderDate,
                                       customerID,  shippingType, 
                                       shippingDate, expectedDeliveryDate
                                       from Orders o, ShippingDetails sd
                                       where o.trackingID is not null and 
                                       o.trackingID =  sd.trackingID
                                       order by orderID asc");
              if($status)
              {
                 echo "<h2>Completed Orders</h2>";
                 $columns = array("Order ID", "Order Date", "Customer ID",
                                  "Shipping Type", "Shipping Date",
                                  "Delivery Date");
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
       ?>


	<?php include("Footer.php"); ?>
</div>

</body>
</html> 
