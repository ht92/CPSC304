<!DOCTYPE html>
<?php include "userInfo.php"; ?>
<html>
<head>
<title>Bakerzin-staff</title>
<link href="Site.css" rel="stylesheet">
</head>

<body>
<?php include("headerCustomer.php"); ?>
	<div id="main">
	<h1>Account Information</h1> 
	<p>Please fill the following</p>

	<table border="1">
           <?php
            include "utility.php";
            echo "<form name='info' method='post' action='account.php?"
                  . $appendData . "'>";
           
            $dataQuery = "select * from Users where userID = '" . $userID . 
                          "'";
            
            $result = executeCommand($dataQuery);
            $row = OCI_Fetch_Array($result, OCI_BOTH);
            if($row)
            {
            echo "<tr>Name:</tr><input type='text' name='FullName' size='35'
                   disabled value='" . $row['FNAME'] . " " . $row['LNAME'] 
                   . "'><br>
                 
                   <tr>Address:</tr><input type='text'
                   name='address' size='35' disabled value='" . 
                   $row['ADDRESS'] . "'><br>

                   <tr>Phone Number:</tr>
                   <input type='text' name='phone' size='35' 
                   disabled value='" . $row['PHONENUMBER'] . "'><br>
		   
                   <tr>Customer ID:</tr><input type='text' name='id' 
                   size='35' disabled value='" . $userID . "'><br>";
            }
            ?>
			<input type="submit" value="Edit">
		</form>
	<?php include("Footer.php") ?>
	</div>
	</table>

</body>
</html>
