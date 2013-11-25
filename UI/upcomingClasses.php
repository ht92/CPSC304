<!DOCTYPE html>
<html>
<body>

<?php
$classQuery;
if($isStudent)
{
$classQuery = "select bc.classID, className, fname, lname, startDate,
               endDate from BakingClass bc, enrollsIn ei, Users u
               where ei.studentID = '" . $userID . "' and
               ei.classID <> bc.classID and u.userID = bc.instructorID";
}
else
{
$classQuery = "select classID, className, fname, lname, startDate, endDate
               from BakingClass bc, Users u
               where u.userID = bc.instructorID";
}
$result = executeCommand($classQuery);
?>

<table border="1">
<th>Class ID</th><th>Class Name</th><th>Instructor</th><th>Start Date</th>
<th>End Date</th>
<?php
while($row = OCI_Fetch_Array($result, OCI_BOTH))
{  
   if(date("j-m-y", strtotime($row['STARTDATE'])) > date("y-m-j"))
   {
      echo "<tr><td>" . $row['CLASSID'] . "</td><td>" . $row['CLASSNAME'] . 
        "</td><td>" . $row['FNAME'] . " " . $row['LNAME'] . "</td><td>" .
        $row['STARTDATE'] . "</td><td>" . $row['ENDDATE'] . "</td></tr>";
   }
}
?>
</table>
</body>
</html>
