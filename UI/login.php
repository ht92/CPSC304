<!DOCTYPE html>
<html>
<head>
<title>Bakerzin-login</title>
<link href="Site.css" rel="stylesheet">
</head>

<body>
	<div id="main">
	<?php include("headerLogo.php"); ?>

	<?php

		session_start();
		$username= "";
		$_SESSION['username'] = $username;
		$_SESSION['password'] = $password;
		$_SESSION['type'] = $type;

		$type= "staff";
	?>

	<form method="get" action=<?php echo $type.".php"?>>
		Username: <input type="text" name="username" value=""> <br>
		Password: <input type="password" name="password" value=""> <br>
		<input type="submit">
	</form>



	<?php include("Footer.php"); ?>
</div>

</body>
</html> 