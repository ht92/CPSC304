<!DOCTYPE html>
<html>
<head>
<title>Add New Task</title>
<link href="Site.css" rel="stylesheet">
</head>

<body>
	<div id="main">
  <?php include("headerLogo.php"); ?>
  <h2>Enter the details of your new task:</h2>

<?php
include "userInfo.php";
include "utility.php";
$itemID;
$itemQuantity;
if(strlen($_POST['itemID']) > 0 && strlen($_POST['quantity']) > 0)
{ 
   $taskID = 0;
   $taskQuery = "select max(taskID) as taskID from bakertasks";
   $result = executeCommand($taskQuery);
   $row = OCI_Fetch_Array($result, OCI_NUM);
   oci_free_statement($result);
   
   $taskID = intval($row[0]) + 1;
   $taskID = strval($taskID);
   $taskID = str_pad($taskID, 5, "0", STR_PAD_LEFT);
   
   $itemID = $_POST['itemID'];
   $itemID = str_pad($itemID, 5, "0", STR_PAD_LEFT);
      
   $itemQuantity = $_POST['quantity'];
   $itemExists = "select * from item where itemID = '" . $itemID .  "'";
   $result = executeCommand($itemExists);
   if(!OCI_Fetch_Array($result, OCI_NUM))
   {
      echo "<br>Invalid itemID<br>";
   }
   else
   { 
      
      $taskInsert = "insert into BakerTasks values('" . $taskID . "', 
                    '" . $userID . "', '" . $itemID . "', " . $itemQuantity
                    . ", '" . date("j-m-y") . "', null)";
      oci_free_statement(executeCommand($taskInsert));
      OCICommit($dbHandle);
   }
   oci_free_statement($result);
}
else if(isset($_POST['submitted']))
{
   echo "<br>Invalid Values for itemID and/or quantity<br>";
}

?>
<form name"TaskAdded" method="post" action="">
<table border="0">
      <tr>
        <td>Item ID:</td>
        <td><input type="text" name="itemID"></td>
      </tr>
      <tr>
        <td>Quantity: </td>
        <td><input type="number" name="quantity"></td>
      </tr>
      <tr>
        <td>
            <input type="submit" name='submitted'>
        </td>
      </tr>
  </table>
</form>

<?php
echo "<form name='goBack' method='post' action='tasks.php?isBaker=" . 
      $isBakerURL  . "&isInstructor=" . $isInstructorURL . "&userID=" 
      . $userID . "'>
<input type='submit' value='Go Back'>
</form>";
?>
	<?php include("Footer.php"); ?>
</div>

</body>
</html> 
