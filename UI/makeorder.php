	<!--
	filename: customer.php
	created on: Oct 29, 2013

	to make order: needs search bar and insert button
	then new page pop up
-->
<!DOCTYPE html>

<html>
<head>
  <title>Make Order</title>
  <link href="Site.css" rel="stylesheet">
</head>

<body>
	<?php include("headerCustomer.php"); ?>
	<div id="main">
	 <?php include("headerLogo.php") ?>
	<h2> ORDER YOUR CAKE :) </h2>
	<?php
        include "utility.php";
        include "session.php";
        
        $orderID = 0;
        if(isset($_GET['submit']))
        {   
            $orderQuery = "select orderID from Orders order by orderID desc";
            $result = executeCommand($orderQuery);
            if($row = OCI_Fetch_Array($result, OCI_NUM))
            {
               $orderID = intval($row[0]) + 1;
               $orderID = strval($orderID); 
               oci_free_statement($result);
            }  
         }

        $itemQuery = "select * from item order by itemId asc";
        $result = executeCommand($itemQuery);
        
        echo "<br><form name='Make Order' method='post' action='makeorder.php?submit=yes'>
              <table border = '1'><th>Item Id</th><th>Item Name</th><th>Item Type</th>
              <th>Price</th><th>Amount</th>";
        
        $orderCost = 0;
        while($row = OCI_Fetch_Array($result, OCI_NUM))
        {
           if(isset($_GET['submit']))
           {
              if($_POST[$row[0]] > 0)
              {
                 $orderCost = $orderCost + (intval($_POST[$row[0]]) * $row[3]);
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
        echo "</table>
              <input type='submit' value='Make Order'></form>";
        oci_free_statement($result);
        
        ?>
	
<p>STILL DUMMY TABLE, MAKE QUERIES</p>
<?php include("Footer.php"); ?>
</div>
</body>
</html>
