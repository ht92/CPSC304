<!DOCTYPE html>
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
<?php include("headerCustomer.php") ?>
	<div id="main">
	<h1>Make Order</h1> 
	<p>Please fill the following</p>

		<form action="account.php" name="account">
			Name:<input type="text" id="name" size="35" value="VARIABLE FOR QUERY" disabled><br>
			Address:<input type="text" id="address" size="35" value="VARIABLE FOR QUERY" disabled><br>
			Phone Number:<input type="text" id="phone" size="35" value="VARIABLE FOR QUERY" disabled><br>
			Customer ID:<input type="text" id="id" size="35" value="VARIABLE FOR QUERY" disabled><br>			
			<input type="submit" id="submit" value="Submit">
		</form>
		<button onclick="disableElements()">Edit Information</button>
	<?php include("Footer.php") ?>
	</div>


</body>
</html>
