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
              printTable($result, $columns);
           }
           OCILogoff($dbHandle);
        }
        ?>
	
	
	<?php include("Footer.php"); ?>
</div>

</body>
</html> 
