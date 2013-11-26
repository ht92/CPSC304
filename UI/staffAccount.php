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
         $aggregateOption = $_POST['stat'];
         $aggQuery = "select " . $aggregateOption . "(temp.numorders)
                       from (select c.customerID, count(distinct orderID)
                             as numorders
                             from customer c, orders o
                             where c.customerID = o.customerID
                             group by c.customerID) temp";
           $result = executeCommand($aggQuery);
           $row =  OCI_Fetch_Array($result, OCI_NUM);
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
              printTable($result, $columns);
           }
           
        }
        ?>
		
	<?php include("Footer.php"); ?>
</div>

</body>
</html> 
