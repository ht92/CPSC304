<!DOCTYPE html>
<html>
<body>

<?php

$query = "select distinct (orderID), orderDate, shippingType
          from Orders o, ShippingDetails sd
          where '" . $userID . "' = o.customerID and
          o.trackingID = sd.trackingID and 
          o.completed is null order by orderID asc";

if($dbHandle)
{
  $result = executeCommand($query);
  $columns = array("Order Id", "Order Date", "Shipping Method");
  printTable($result, $columns);
  oci_free_statement($result);
}

?>
     
</body>
</html>
