<!DOCTYPE html>
<html>
<body>

<?php
if(isset($_POST['isChecked']))
{
   $date = date("j-m-y");
   $completedTasks = $_POST['isChecked'];
   foreach($completedTasks as $task)
   { 
      
      $update = "update BakerTasks set dateCompleted = '" . $date . "'
                where taskID = '" . $task . "'";
      executeCommand($update);
   } 
   OCICommit($dbHandle);
}


$taskQuery = "select taskID, bt.itemID, itemName, itemQuantity, dateAssigned
              from BakerTasks bt, Item i
              where bt.bakerID = '" . $userID . "' and
              i.itemID = bt.itemID and bt.dateCompleted is null
              order by dateAssigned asc";

$result = executeCommand($taskQuery);
$columns = array("Task ID", "Item ID", "Item Name", "Quantity",
                 "Date Assigned");
echo "<form name='submit' method='post' action='tasks.php" . $appendData .
       "'>";
printTable($result, $columns, true); 

?>

<br>
<?php
echo " <input type='submit' value='Mark as Completed'> 
</form>";

?>

</body>
</html>
