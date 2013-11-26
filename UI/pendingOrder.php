<!DOCTYPE html>
<html>
<body>

<?php

$query = "select distinct (orderID), orderDate, shippingType
          from Orders o, ShippingDetails sd
          where '" . $userID . "' = o.customerID and
          o.trackingID = sd.trackingID and 
          o.completed is null order by orderID asc";

if(isset($_POST['remove']))
{
   $rowsToRemove = $_POST['isChecked'];
   foreach($rowsToRemove as $row)
   {
      $shippingQuery = "select trackingID from orders where orderID = '"
                        . $row . "'";
      $result = executeCommand($shippingQuery);
      
      $trackingID = OCI_Fetch_Array($result, OCI_NUM);
      oci_free_statement($result);
     
      
      $removeCommand = "delete from orders where orderID = '" . $row . "'";
      oci_free_statement(executeCommand($removeCommand));
      $removeCommand = "delete from ShippingDetails where trackingID = '"
                       . $trackingID[0] . "'";
      oci_free_statement(executeCommand($removeCommand));
   }
   OCICommit($dbHandle);
}

if($dbHandle)
{
  $result = executeCommand($query);
  $columns = array("Order Id", "Order Date", "Shipping Method");

 echo "<form name='removeOrder' method='post' action='customer.php?" . 
       $appendData . "'>";
  if(!$dashboard)
  {
     printTable($result, $columns, true);
  }
  else
  {
     printTable($result, $columns);
  }
  oci_free_statement($result);
  echo "<input type='submit' name='remove' value='Remove Selected'>
        </form>";
} 
?>   
</body>
</html>
