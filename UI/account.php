<!DOCTYPE html>
<?php include "userInfo.php"; ?>
<html>
<head>
<title>Bakerzin-Customer</title>
<link href="Site.css" rel="stylesheet">
<script>
function disableElements()
{
document.getElementById("lname").disabled=false;
document.getElementById("fname").disabled=false;
document.getElementById("address").disabled=false;
document.getElementById("phone").disabled=false;
}
</script>
</head>

<body>
<?php include("headerCustomer.php"); ?>
	<div id="main">
	<h1>Account Information</h1> 
	<p>Please fill the following</p>

	<table border="1">
           <?php
            include "utility.php";
            echo "<form name='info' method='post'>";
           
            
            if(isset($_POST['submitChanges']))
            {
              if(isset($_POST['fname']))
              {
                 if(strlen($_POST['fname']) > 20)
                 {
                    echo "<br>First name cannot exceed 20 characters<br>";
                 }
                 else if(strlen($_POST['lname']) > 20)
                 {
                    echo "<br>Last name cannot exceed 20 characters<br>";
                 }
                 else if(strlen($_POST['address']) > 40)
                 {
                    echo "<br>Address cannot exceed 40 characters<br>";
                 }
                 else if(strlen($_POST['phone']) > 12)
                 {
                    echo "<br>Phone number cannot exceed 20 characters<br>";
                 }
                 else
                 {
                   $userUpdate = "update Users set fname = '" 
                   .$_POST['fname']. "', lname = '" . $_POST['lname'] . 
                   "', address='" . $_POST['address'] . "', phoneNumber ='" 
                   . $_POST['phone'] . "' where userID = '" . $userID . "'";
                    executeCommand($userUpdate);
                    if(!$status)
                    {
                       echo "<br>Unable to update information<br>
                          One of the fields contained invalid input<br>";
                    }
                    else
                    {
                       OCICommit($dbHandle);
                    }
                    header("Location: account.php?" . $appendData);
                 }
                 
              }
            }

             $dataQuery = "select * from Users where userID = '" . $userID .
                           "'";
 
             $result = executeCommand($dataQuery);
             $row = OCI_Fetch_Array($result, OCI_BOTH);
            if($row)
            {
            echo "<tr>First Name:</tr><input type='text' id='fname' 
                  name='fname' size='20' disabled value='" . 
                  $row['FNAME'] . "'><br>
                   
                  <tr>Last Name</tr><input type='text' id='lname'
                  name='lname' size='20' disabled value='" . $row['LNAME'] .
                  "'><br>  
                 
                   <tr>Address:</tr><input type='text'
                   name='address' id='address' size='40' disabled value='" . 
                   $row['ADDRESS'] . "'><br>

                   <tr>Phone Number:</tr>
                   <input type='text' name='phone' size='12' id='phone'
                   disabled value='" . $row['PHONENUMBER'] . "'><br>";
            }
            ?>
			<input type="submit" name="submitChanges" value="Submit">
		</form>
		<button onclick="disableElements()">Edit Information</button>
	<?php include("Footer.php") ?>
	</div>


</body>
</html>
