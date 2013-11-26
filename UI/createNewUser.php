<!DOCTYPE html>
<html>
<head>
<title>Create New User</title>
<link href="Site.css" rel="stylesheet">
</head>

<body>
	<div id="main">
  <?php include("headerLogo.php"); ?>
  <h2>Enter your information here:</h2>

<?php 

  $username = "";
  $password = "";
  $firstName = "";
  $lastName = "";
  $address = "";
  $phoneNumber = ""; 

  if (isset($_POST['username'])){
    $username = $_POST['username'];
  }
  if (isset($_POST['password'])) {
    $password = $_POST['password'];
  }
  if (isset($_POST['firstName'])) {
    $firstName = $_POST['firstName'];
  } 
  if (isset($_POST['lastName'])) {
    $lastName = $_POST['lastName'];
  } 
  if (isset($_POST['address'])){
    $address = $_POST['address'];
  }
  if (isset($_POST['phoneNumber'])){
    $phoneNumber = $_POST['phoneNumber'];
  }
?>

  <form method ="post" action="">
    <table>
      <tr>
        <td>Username: </td>
        <td><input type="text" name="username" id="username" value="<?=$username?>" ></td>
      </tr>
      <tr>
        <td>Password: </td>
        <td><input type="password" name="password" id="username" value="<?=$password?>" ></td>
      </tr>
      <tr>
        <td>First name: </td>
        <td><input type="text" name="firstName" id="firstName" value="<?=$firstName?>" ></td>
      </tr>
      <tr>
        <td>Last name: </td>
        <td><input type="text" name="lastName" id="lastName" value="<?=$lastName?>" ></td>
      </tr>
      <tr>
        <td>Address: </td>
        <td><input type="text" name="address" id="address" value="<?=$address?>" ></td>
      </tr>
      <tr>
        <td>Phone number: </td>
        <td><input type="text" name="phoneNumber" id="phoneNumber" value="<?=$phoneNumber?>" ></td>
      </tr>
    </table>

        <input type="submit" value="Create User">
        <?php echo $password ?>
  </form>


	<?php include("Footer.php"); ?>
</div>

</body>
</html> 