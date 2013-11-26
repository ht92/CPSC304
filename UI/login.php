<!DOCTYPE html>
<html>
<head>
<title>Bakerzin-login</title>
<link href="Site.css" rel="stylesheet">
</head>

<body>
	<div id="main">
        <?php include("headerLogo.php");
          if(isset($_GET['loginFailed']))
          {
             echo "<br>Invalid Username or Password<br>";
          } 
          ?>
	<form method="get" action="login.php">
		Username: <input type="text" name="username" value=""> <br>
		Password: <input type="password" name="password" value=""> <br>
		<input type="submit"><br>
	</form>
  <form method="get" action="createNewCustomer.php">
    <br>
    <input type="submit" value="Sign up for Customer">
  </form>
  
  <form method="get" action="createNewBaker.php">
    <br>
    <input type="submit" value="Sign up for Baker">
  </form>
  
  <form method="get" action="createNewInstructor.php">
    <br>
    <input type="submit" value="Sign up for Instructor">
  </form>
  
  <form method="get" action="createNewBakerAndInstructor.php">
    <br>
    <input type="submit" value="Sign up for both Instructor and Baker">
  </form>

        <?php
        include "utility.php";
        if(isset($_GET['accountCreated']))
        {
           echo "<br>Account Created Successfully<br>";
        } 
        
        if($dbHandle && isset($_GET['username']) && 
           isset($_GET['password']))
        {
           $query = "select userID, fname, lname from Users where
                     username = '" . $_GET['username'] . "' and password
                     = '" . $_GET['password'] . "'";
           $result = executeCommand($query);
           if($row = OCI_Fetch_Array($result, OCI_NUM))
           {
              echo "<br>Login Successful<br>";
              $userID = $row[0];
              oci_free_statement($result);              

              $query = "select employeeID from Employee e
                        where e.employeeID = " . $userID;
              $result = executeCommand($query);
              echo "<br>" . $userID . "<br>";
               
              if($row = OCI_Fetch_Array($result, OCI_NUM))
              {
                 oci_free_statement($result);                 
                 
                 $isBaker = "false";
                 $isInstructor = "false";  
                 $bakerQuery = "select * from Employee e, Baker b
                                where b.bakerID = " . $userID;
                 $result = executeCommand($bakerQuery);
                 if(OCI_Fetch_Array($result, OCI_NUM))
                 {
                    $isBaker = "true";
                 }
                 oci_free_statement($result);
                  
                 $instructorQuery = "select * from Instructor i
                                     where i.instructorID = " . $userID;
                 $result = executeCommand($instructorQuery);
                 if(OCI_Fetch_Array($result, OCI_NUM))
                 {
                    $isInstructor = "true";
                 }
                 oci_free_statement($result);
                $locationString = "Location: staff.php?isBaker=" . $isBaker
                                  . "&isInstructor=" . $isInstructor . 
                                  "&userID=" . $userID; 
                header($locationString);
              }
              else
              {   
                  $isMember = "false";
                  $isStudent = "false";
                  $memberQuery = "select * from Member m where
                                  m.memberID = " . $userID;
                  $result = executeCommand($memberQuery);
                  if(OCI_Fetch_Array($result, OCI_NUM))
                  {
                     $isMember = "true";
                  }
                  oci_free_statement($result);
                  
                  $studentQuery = "select * from Student
                                   where studentID = '" . $userID ."'";
                  $result = executeCommand($studentQuery);
                  if(OCI_Fetch_Array($result, OCI_NUM))
                  {
                     $isStudent = "true";
                  }
                  header("Location: customer.php?isMember=" . $isMember . "&userID=" . $userID . "&isStudent=" . $isStudent);
              }
           }
           else
           {
              echo "<br>Login Failed<br>";
              oci_free_statement($result);
              header("Location: login.php?loginFailed=true");
           }
        }
        ?>
	<?php include("Footer.php"); ?>
</div>

</body>
</html> 
