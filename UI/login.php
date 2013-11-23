<!DOCTYPE html>
<?php
include 'session.php';
?>
<html>
<head>
<title>Bakerzin-login</title>
<link href="Site.css" rel="stylesheet">
</head>

<body>
	<div id="main">
        <?php include("headerLogo.php"); ?>
	<form method="get" action="login.php">
		Username: <input type="text" name="username" value=""> <br>
		Password: <input type="password" name="password" value=""> <br>
		<input type="submit">
	</form>

        <?php
        include "utility.php";
        $_SESSION['loggedIn'] = False;
        $_SESSION['isBaker'] = False;
        $_SESSION['isInstructor'] = False;
        $_SESSION['isEmployee'] = False;
        $_SESSION['isMember'] = False;
       
        if($dbHandle && isset($_GET['username']) && 
           isset($_GET['password']))
        {
           $username = $_GET['username'];
           $password = $_GET['password'];
           $query = "select userID, fname, lname from Users where
                     username = '" . $username . "' and password
                     = '" . $password . "'";
           $result = executeCommand($query);
           if($row = OCI_Fetch_Array($result, OCI_NUM))
           {
              echo "<br>Login Successful<br>";
              $_SESSION['username'] = $username;
              $_SESSION['password'] = $password;
              $_SESSION['loggedIn'] = True;
              $userID = $row[0];
              oci_free_statement($result);              

              $query = "select employeeID from Employee e
                        where e.employeeID = " . $userID;
              $result = executeCommand($query);
              echo "<br>" . $userID . "<br>";
               
              if($row = OCI_Fetch_Array($result, OCI_NUM))
              {
                 echo "Employee Logged in";
                 $empID = $row[0]; 
                 $_SESSION['isEmployee'] = True;
                 $_SESSION['type'] = "staff";
                 $_SESSION['isBaker'] = False;
                 $_SESSION['isInstructor'] = False;
                 oci_free_statement($result);                 
 
                 $bakerQuery = "select * from Employee e, Baker b
                                where b.bakerID = " . $empID;
                 $result = executeCommand($bakerQuery);
                 if(OCI_Fetch_Array($result, OCI_NUM))
                 {
                    echo "Is Baker";
                    $_SESSION['isBaker'] = True;
                 }
                 oci_free_statement($result);
                  
                 $instructorQuery = "select * from Instructor i
                                     where i.instructorID = " . $empID;
                 $result = executeCommand($instructorQuery);
                 if(OCI_Fetch_Array($result, OCI_NUM))
                 {
                    $_SESSION['isInstructor'] = True;
                 }
                 oci_free_statement($result);
                 header("Location: staff.php");
              }
              else
              {
                  echo "Customer Logged In";
                  $_SESSION['type'] = "customer";
                  
                  $memberQuery = "select * from Member m where
                                  m.memberID = " . $userID;
                  $result = executeCommand($memberQuery);
                  if(OCI_Fetch_Array($result, OCI_NUM))
                  {
                     echo "is Member";
                     $_SESSION['isMember'] = True;
                  }
                  oci_free_statement($result);
                  header("Location: customer.php");
              }
           }
           else
           {
              echo "<br>Login Failed<br>";
              oci_free_statement($result);
              header("Location: login.php");
           }
        }
        ?>
	<?php include("Footer.php"); ?>
</div>

</body>
</html> 
