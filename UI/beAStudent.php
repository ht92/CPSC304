<html>
<head>
	<title>Become a student</title>
	<link href="Site.css" rel="stylesheet">
</head>
<body>

<?php
if(isset($_POST['submit']))
{

   $addStudent = "insert into Student values('" . $userID . "')";
   oci_free_statement(executeCommand($addStudent));
   if($status)
   {
      OCICommit($dbHandle);
      $isStudent = true;
      $isStudentURL = "true";
      header("Location: classes.php?isMember=" . $isMemberURL . "&userID=" .
             $userID . "&isStudent=" . $isStudentURL);
   }
   else
   {
      echo "<br>Error enrolling user as a student<br>";
   }
}
?>
	<form name="enroll" method="post" action="">
		<input type="submit" name="submit" value="Register as A Student" />
	</form>


</body>
</html>
