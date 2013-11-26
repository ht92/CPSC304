	<!--
	filename: customer.php
	created on: Oct 29, 2013

	to make order: needs search bar and insert button
	then new page pop up
-->
<!DOCTYPE html>
<?php include "userInfo.php"; ?>
<html>
<head>
  <title>Make Order</title>
  <link href="Site.css" rel="stylesheet">
</head>

<body>
	<?php include("headerCustomer.php"); ?>
	<div id="main">
	 <?php include("headerLogo.php"); ?>

	<h2> ORDER YOUR CAKE :) </h2>
	<?php
        
        include "utility.php";
        
        $orderID = 0;
        $trackingID = 0;
        $shippingCost = 0.0;
        if(isset($_GET['submit']))
        {

           $orderQuery = "select orderID from Orders
                            order by orderID desc";
           $result = executeCommand($orderQuery);
           if($row = OCI_Fetch_Array($result, OCI_NUM))
           {
              $orderID = intval($row[0]) + 1;
              $orderID = strval($orderID);
              $orderID = str_pad($orderID, 5, "0", STR_PAD_LEFT);
           }  
           oci_free_statement($result);
             
           $shippingQuery =  "select trackingID from ShippingDetails
                                order by trackingID desc";
           $result = executeCommand($shippingQuery);
           
           if($row = OCI_Fetch_Array($result, OCI_NUM))
           {
                $trackingID = intval($row[0]) + 1;
                $trackingID = strval($trackingID);
                $trackingID = str_pad($trackingID, 8, "0", STR_PAD_LEFT);
           }
           oci_free_statement($result);
           
           if(strcmp($_POST['deliveryOption'], "DHL") == 0)
           {
              $shippingCost = 9.99;
           }
        }

        $itemQuery = "select * from item order by itemId asc";
        $result = executeCommand($itemQuery);
        
        echo "<form name='Make Order' method='post' action='customer.php?submit=yes&isMember=". $isMemberURL . "&userID=" . $userID ."'>
              <table border = '1'><th>Item Id</th><th>Item Name</th><th>Item Type</th>
              <th>Price</th><th>Amount</th>";
        
        $orderCost = 0;
        $orderCommand;
        $numOrders = 0;
        while($row = OCI_Fetch_Array($result, OCI_NUM))
        {
           if(isset($_GET['submit']))
           {
         
              if($_POST[$row[0]] > 0)
              {
                 $orderCost = $orderCost + (intval($_POST[$row[0]]) *
                              $row[3]);
                
                $orderCommand[$numOrders++] = "insert into Orders Values('" . $orderID .
                                "', '" . date("j-m-y") . "', '" . $userID
                                . "', '" . $row[0] . "', " . $_POST[$row[0]]
                                . ", '" . $trackingID . "', null)";
              }
           }
           echo "<tr>";
           foreach($row as $rowData)
           {
              echo "<td>" . $rowData . "</td>";
           }
           echo "<td><input type='text' size ='5' name='" . $row[0] . "' value='0'>
                 </td></tr>";
        }
        echo "<tr><select name='deliveryOption'><option value='pickup'>Pickup</option>
              <option value='Ground'>Ground</option></tr>";
        echo "</table>
              <input type='submit' value='Make Order'></form>";

        if(isset($_GET['submit']) && $numOrders > 0)
        {   
            $expectedDelivery = date("j-m-y", strtotime("+2 day"));
           
            $command = "insert into ShippingDetails values('" .
                        $trackingID . "', '" . $_POST['deliveryOption']
                        . "', null, '" . $expectedDelivery . "',
                        " . $shippingCost . ")";
            executeCommand($command);
            
            foreach($orderCommand as $order)
            {
               oci_free_statement(executeCommand($order));
               if(!$status)
               {
                  echo "<br>Error Creating Order<br";
                  break;
               }
            }
            if($status)
            {
               OCICommit($dbHandle);
             }
            /*
            $taskQuery = "select count(*) as numOrders, bakerID
                          from BakerTasks
                          group by bakerID
                          order by numOrders asc";
            $result = executeCommand($taskQuery);
            $row = OCI_Fetch_Array($result, OCI_NUM);
            $createTask = "insert into bakerTasks values('" . $taskID . "',
                           ' " . $row[1] . "', '" . $itemID . "', "
                           . $amount . ", " . date("j-m-y") ")";*/
         }

        oci_free_statement($result);
        
        ?>
	
	<h2> Pending Orders </h2>
	<?php include("pendingOrder.php"); ?>
	
	<h2> Past Orders </h2>
	<?php include("pastOrder.php"); ?>
	
<?php include("Footer.php");
 OCILogoff($dbHandle);
 ?>
</div>
</body>
</html>
