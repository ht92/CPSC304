<!DOCTYPE html>
<html>
<body>

<?php
  
if(isset($_POST['isChecked']))
{
   $removeSelected = false;
   if(isset($_POST['remove']))
   {
      $removeSelected = true;
   }
   $date = date("j-m-y");
   $completedTasks = $_POST['isChecked'];
   foreach($completedTasks as $task)
   { 
      $update;
      if($removeSelected)
      {
         $update = "delete from BakerTasks where taskID = '" . $task . "'";
      }
      else
      {
         $update = "update BakerTasks set dateCompleted = '" . $date . "'
                   where taskID = '" . $task . "'";
      }
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
if($dashboard)
{
printTable($result, $columns);
} 
else
{
printTable($result, $columns, true);
}
?>

<br>
<?php
if(!$dashboard)
{
echo " <input type='submit' name='update' value='Mark as Completed'> 
       <input type='submit' name='remove' value='Remove Task'>
</form>";
}

?>

</body>
</html>

