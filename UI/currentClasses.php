<!DOCTYPE html>
<html>
<body>

<?php

$classQuery = "select ei.classID, className, u.fname, u.lname, startDate,
               endDate from EnrollsIn ei, BakingClass bc, Users u
               where ei.classID = bc.classID and ei.studentID = '". $userID
               . "' and bc.instructorID = u.userID";
$result = executeCommand($classQuery);

?>

<table border="1">
<th>Class ID</th><th>Class Name</th><th>Instructor</th><th>Start Date</th>
<th>End Date</th>
<?php
while($row = OCI_Fetch_Array($result, OCI_BOTH))
{
   if(date("j-m-y", strtotime($row['ENDDATE'])) > date("y-m-j"))
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
