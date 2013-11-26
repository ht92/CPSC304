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

	<h2> Find Customer </h2>
	<table border="0">
  		<tr>
    		<td>User name</td>
                <?php
    		echo "<td><form action='staffAccount.php" . $appendData . 
                     "' method='post'><input type='text' name='userID'></td>
                     ";
                ?>
    		<td><input type="submit" value="search"></td></form>
  		</tr>
	</table>
		
        <?php
        include "utility.php";
        
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
		
		
        if($dbHandle && isset($_POST['userID']))
        {
           $searchValue = $_POST['userID'];
           $query = "select userID, userName from Users where userName like
                     '%" . $searchValue . "%'";
           $result = executeCommand($query);
           if($status)
           {
              $columns = array("User ID", "User Name");
              echo "<h2>Search Result</h2>";
              printHyperlinkTable($result, $columns);
           }
           OCILogoff($dbHandle);
        }
        ?>
		
	
	<?php include("Footer.php"); ?>
</div>

</body>
</html> 
