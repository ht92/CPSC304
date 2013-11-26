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
	<?php include "utility.php"; 
        if(isset($_POST['submitted']))
        {
           $endDate = date("j-m-y", strtotime($_POST['endDate']));
           $startDate = date("j-m-y", strtotime($_POST['startDate']));
           $itemID = str_pad($_POST['classID'], 5, "0", STR_PAD_LEFT);
           $instructorID = str_pad($_POST['instructorID'], 8, "0", 
                                  STR_PAD_LEFT);
           $query = "insert into bakingClass values('" . $itemID . "', '"
                    . $_POST['className'] . "', '" . $instructorID .
                    "', " . $_POST['maxenrolled'] . ", '" . 
                    $startDate . "', '" . $endDate . 
                    "')";
           echo $query;
           oci_free_statement(executeCommand($query));
           if(!$status)
           {
              echo "<br>Error adding Class to DataBase<br>";
           }
           else
           {
              OCICommit($dbHandle);
           }
        }
        OCILogoff($dbHandle);  
             ?>
	
	<form name"TaskAdded" method="post" action="">
	<table border="0">
      <tr>
        <td>Class ID:</td>
        <td><input type="text" name="classID"></td>
      </tr>
      <tr>
        <td>Class Name:</td>
        <td><input type="text" name="className"></td>
      </tr>
      <tr>
         <td>Instructor ID:</td>
         <td><input type='text' name='instructorID'></td>
      </tr>
      <tr>
         <td>Max Enrolled</td>
         <td><input type='number' name='maxenrolled'></td>
      </tr>  
      <tr>
      <td>Start Date</td>
      <td><input type='date' name='startDate'></td>
      </tr>
      <tr>
         <td>End Date</td>
         <td><input type='date' name='endDate'></td>
       </tr>
      <tr>
        <td>
            <input type="submit" name='submitted'>
        </td>
      </tr>
	</table>
	</form>
	
	</div>
</body>
</html>
