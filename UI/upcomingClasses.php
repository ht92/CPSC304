<!DOCTYPE html>
<html>
<body>

<?php
//var_dump($_POST);
	if (isset($_POST['isSelected']))
	{
		$enrolledSelected = false;
		if (isset($_POST['enroll']))
		{
			$enrollSelected = true;
		}
		$enrolledClasses = $_POST['isSelected'];
		foreach($enrolledClasses as $class)
		{
			$update;
			if(!$enrolledSelected)
			{
				echo "select ". $class;
				echo "insert into EnrollsIn values ('" . $userID . "','" . $class . "')";
				$update = "insert into EnrollsIn values ('" . $userID . "','" . $class . "')";
			} else 
			{
				echo "not selected " . $class;
			}
			executeCommand($update);
		}
		OCICommit($dbHandle);
		header("Location: classes.php?" . $appendData);
	}
?>


<?php
$classQuery;
if($isStudent)
{
$classQuery = "select bc.classID, className, fname, lname, startDate,
               endDate from BakingClass bc, Users u
               where u.userID = bc.instructorID and bc.classID not in   
			   (select classID
			   from EnrollsIn ei
			   where ei.studentID = '" . $userID . "')
			   order by bc.classID asc";
}

$result = executeCommand($classQuery);
?>

<table border="1">
<th></th><th>Class ID</th><th>Class Name</th><th>Instructor</th><th>Start Date</th>
<th>End Date</th>

<?php
echo "<form name=\"table\" method=\"post\" action=\"\">";
while($row = OCI_Fetch_Array($result, OCI_BOTH))
{  
   if(date("j-m-y", strtotime($row['STARTDATE'])) > date("y-m-j"))
   {
	  echo "<tr><td><input type=\"checkbox\" name=\"isSelected[]\" value='" . $row['CLASSID'] . "'</td><td>" . $row['CLASSID'] . "</td><td>" . $row['CLASSNAME'] . 
        "</td><td>" . $row['FNAME'] . " " . $row['LNAME'] . "</td><td>" .
        $row['STARTDATE'] . "</td><td>" . $row['ENDDATE'] . "</td></tr>";
   }
}

?>
</table>
	<input type='submit' name='enroll' value='Enroll Selected'>
</form>

</body>
</html>
