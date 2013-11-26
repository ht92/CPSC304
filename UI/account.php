<!DOCTYPE html>
<?php include "userInfo.php"; ?>
<html>
<head>
<title>Bakerzin-Customer</title>
<link href="Site.css" rel="stylesheet">
<script>
function disableElements()
{
document.getElementById("name").disabled=false;
document.getElementById("address").disabled=false;
document.getElementById("phone").disabled=false;
document.getElementById("id").disabled=false;
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
            echo "<form name='info' method='post' action='account.php?"
                  . $appendData . "'>";
           
            $dataQuery = "select * from Users where userID = '" . $userID . 
                          "'";
            
            $result = executeCommand($dataQuery);
            $row = OCI_Fetch_Array($result, OCI_BOTH);
            if($row)
            {
            echo "<tr>Name:</tr><input type='text' id='name' name='FullName' size='35'
                   disabled value='" . $row['FNAME'] . " " . $row['LNAME'] 
                   . "'><br>
                 
                   <tr>Address:</tr><input type='text'
                   name='address' id='address' size='35' disabled value='" . 
                   $row['ADDRESS'] . "'><br>

                   <tr>Phone Number:</tr>
                   <input type='text' name='phone' size='35' id='phone'
                   disabled value='" . $row['PHONENUMBER'] . "'><br>
		   
                   <tr>Customer ID:</tr><input type='text' name='id' id='id'
                   size='35' disabled value='" . $userID . "'><br>";
            }
            ?>
			<input type="submit" value="Submit">
		</form>
		<button onclick="disableElements()">Edit Information</button>
	<?php include("Footer.php") ?>
	</div>


</body>
</html>
