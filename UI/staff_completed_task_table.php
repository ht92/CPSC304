<!DOCTYPE html>
<html>
<body>

<?php
$taskQuery = "select taskID, bt.itemID, itemName, itemQuantity, dateAssigned
              , dateCompleted from BakerTasks bt, Item i
              where bt.itemID = i.itemID and bt.bakerID = '" . $userID . "'
              and dateCompleted is not null
              order by taskId asc";
$result = executeCommand($taskQuery);
$columns = array("Task ID", "Item ID", "Item Name", "Quantity", 
                 "Date Assigned", "Date Completed");
printTable($result, $columns);
?>

</body>
</html>
