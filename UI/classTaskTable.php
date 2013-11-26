<!DOCTYPE html>
<html>
<body>

<?php

$classQuery = "select * from BakingClass where instructorID = '" . $userID
              . "'";
$result = executeCommand($classQuery);
$columns = array("Class ID", "Class Name", "Instructor ID", "Max Enrolled", 
                "Start Date", "End Date");

printTable($result, $columns);
?>

<br>
<form name="submit" method='post' action='addClass.php<?php echo $appendData
; ?>'>
  <input type="submit" value="Add new Class"> 
</form>

</body>
</html>
