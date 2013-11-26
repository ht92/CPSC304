<!DOCTYPE html>
<html>
<body>
	
	<?php
		
		
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
                        where
                        o.completed is null
                        order by orderID asc";
              $result =  executeCommand($query);
              if($status)
              {
				
                 $columns = array("Order ID", "Order Date", "Customer ID");
				
	
				echo "<form name='Pending Orders' method='post'
                action='order.php" . $appendData . "'>";
				
				
                 printTable($result, $columns, True);
				 
				 if (!$dashboard) {
					echo "<input type='submit' value='Order Shipped'></form>";
					}
              }
              
              $result = executeCommand("select distinct(orderID), orderDate,
                                       customerID
                                       from Orders o where
                                       o.completed is not null
                                       order by orderID asc");
              if($status)
              {
				 if (!$dashboard) {
					echo "<h2>Completed Orders</h2>";
					$columns = array("Order ID", "Order Date", "Customer ID");
					printTable($result, $columns);
				 }
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
	
</body>
</html>
