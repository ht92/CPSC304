<!DOCTYPE html>
<html>
<body>

<?php

$query = "select distinct(orderID), orderDate, shippingDate, shippingType
          from Orders o, ShippingDetails sd
          where o.completed is not null and 
          '" . $userID . "' = o.customerID and
          o.trackingID = sd.trackingID order by orderID asc";

if($dbHandle)
{
   $result = executeCommand($query);
   $columns = array("Order ID", "Order Date", "Shipping Date",
                    "Shipping Type");
   printTable($result, $columns);
   oci_free_statement($result);
}

?>

</body>
</html>
