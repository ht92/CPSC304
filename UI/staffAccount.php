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
        
       
        <h2>Order Statistics</h2>
        <?php
         include "utility.php";
         $aggregateOption = "avg";
         if(isset($_POST['stat']))
         { 
            $aggregateOption = $_POST['stat'];
         }
         $aggQuery = "select " . $aggregateOption . "(temp.numorders)
                       from (select c.customerID, count(distinct orderID)
                             as numorders
                             from customer c, orders o
                             where c.customerID = o.customerID
                             group by c.customerID) temp";
           $result = executeCommand($aggQuery);
           $row =  OCI_Fetch_Array($result, OCI_NUM);
           oci_free_statement($result);
           $options = array("avg", "sum", "min", "max");
           $optionValues = array("avg" => "Average",
                                 "sum" => "Total",
                                 "min" => "Minimum",
                                 "max" => "Maximum");  
         echo "<table>
                  <tr><td>
                     <form name='statistics' method='post'
                      action='staffAccount.php" . $appendData . "'>
                        <select name='stat'>";
                        foreach($options as $option)
                        {
                           echo "<option value='" . $option . "'";
                           if(strcmp($option, $aggregateOption) == 0)
                           {
                              echo " selected";
                           }
                           echo ">" . $optionValues[$option] . "</option>";
                        }
         echo   "</td><td>Number of Orders: " . $row[0] . "</td></tr>
                 </table>
                 <input type='submit' name='update' value='Update'>";
                
         echo "<h2>Total number of Customers</h2>";
         $customers = "select count(*) as numCustomer from customer";
         $result = executeCommand($customers);
         $row = OCI_Fetch_Array($result, OCI_NUM);
         echo "The total number of customers is " . $row[0] . "<br>";

         echo "<h2>Customers Who Have Ordered Every Item</h2>";
         $divisionQuery = "select fname, lname from users u, 
                           (select distinct customerID
                            from orders o where not exists(
                            select * from item i where not exists(
                            select * from orders o2 where o2.itemID = i.itemID and
                            o2.customerID = o.customerID))) temp 
                            where temp.customerID = u.userID";
         $result = executeCommand($divisionQuery);
         while($row = OCI_Fetch_Array($result, OCI_NUM))
         {
             echo "<br>" . $row[0] . " " . $row[1] . "<br>";
         }
         oci_free_statement($result);
                                        
        ?>
        <br><br>  
	<h2> Find Customer </h2>
        
	<table border="0">
  		<tr>
    		<td>User name</td>
                <?php
    		echo "<td><input type='text' name='userID'></td>";
                ?>
    		<td><input type="submit" name='search' value="search"></td></form>
  		</tr>
	</table>

        <?php
        
function printHyperlinkTable($tableData, $columns, $printCheckBox = False)
		{
			$userID = $_GET['userID'];
			echo "<table border='1'>";
			echo "<tr>";
			if($printCheckBox)
			{
					echo "<th> </th>";
			}
			foreach($columns as $column)
			{
				echo "<th>" . $column . "</th>";
			}
			echo "</tr>";
			while($row = OCI_Fetch_Array($tableData, OCI_NUM))
			{
				echo "<tr>";
				if($printCheckBox)
				{
					echo "<td><form><input type='checkbox' name='isCompleted'>
					</form></td>";
				}
				$isID = true;
				foreach($row as $rowData)
				{
					if ($isID) {
						echo "<td> <a href=\"customerInfo.php?userID=$userID&customerID=$rowData\">" . $rowData . "</a></td>";
						$isID = false;
					}
					else {
						echo "<td>" . $rowData . "</td>";
						$isID = true;
					}
					
				}
				echo "</tr>";
			}
			echo "</table>";
		}
		
        if($dbHandle && isset($_POST['search']))
        {
           $searchValue = $_POST['userID'];
           $query = "select customerID, userName from Users u, customer c
                     where u.userName like
                     '%" . $searchValue . "%' and c.customerID = u.userID";
           $result = executeCommand($query);
           if($status)
           {
              $columns = array("User ID", "User Name");
              echo "<h2>Search Result</h2>";
              printHyperLinkTable($result, $columns);
           }
        }
        ?>
		
	<?php include("Footer.php"); 
         OCILogoff($dbHandle); ?>
</div>

</body>
</html> 
