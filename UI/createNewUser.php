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
  include "utility.php";

  $username = "";
  $username2 = "";
  $password = "";
  $firstName = "";
  $lastName = "";
  $address = "";
  $phoneNumber = ""; 
  $entity = "";

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

if(isset($_POST['createUser']) && strlen($password) >= 8 && 
  strlen($password) <= 16) 
{
   $validIdFound = true;
   $userID;
   $userQuery = "select max(userID) as userID from Users";
   $result = executeCommand($userQuery);
   $userInfo = OCI_Fetch_Array($result, OCI_NUM);
   if($userInfo)
   {
      $userID = intval($userInfo[0]) + 1;
      if($userID > 99999999)
      {
         $userID = 0;
         $userIDQuery = "select * from users where userID = " . $userID;
         $result = executeCommand($userIDQuery);
         while(OCI_Fetch_Array($result, OCI_NUM) && $userID <= 99999999)
         {
            $userID++;
            $userIDQuery = "select * from users where userID = " . $userID;
            oci_free_statement($result);
            $result = executeCommand($userIDQuery);
         } 
         if($userID <= 99999999)
         {
            $validIDFound = true;
         } 
      }
      
      $userID = strval($userID);
      $userID = str_pad($userID, 8, "0", STR_PAD_LEFT);
   }
   $userNameExists = "select * from users where username = '" . 
                     $username . "'";
   $result = executeCommand($userNameExists);

   if(!OCI_Fetch_Array($result, OCI_NUM) && $validIDFound)
   {
      $newUser = "insert into users values('" . $userID . "', '" . $username
                  . "', '" . $password . "', '" . $firstName . "', '" . 
                  $lastName . "', '" . $address . "', '" . $phoneNumber . 
                  "')";
      oci_free_statement(executeCommand($newUser));
      OCICommit($dbHandle);
      OCILogoff($dbHandle);
      header("Location: login.php?accountCreated=true");
   }
   //if customer insert to Customer table
   /**if(strcmp($_POST['entity'],"customer") == 0)
   {
      $newUser = "insert into Customer values('" . $userID . "')";
      oci_free_statement(executeCommand($newUser));
      OCICommit($dbHandle);
      OCILogoff($dbHandle);
      header("Location: login.php?accountCreated=true");
	}*/
	if(strcmp($_POST['entity'],"baker") == 0)
    {
	
      $newUser = "insert into Baker values('" . $userID . "')";
      oci_free_statement(executeCommand($newUser));
      OCICommit($dbHandle);
      OCILogoff($dbHandle);
      header("Location: login.php?accountCreated=true");
	}
	else if(strcmp($_POST['entity'],"instructor") == 0)
    {
      $newUser = "insert into Instructor values('" . $userID . "')";
      oci_free_statement(executeCommand($newUser));
      OCICommit($dbHandle);
      OCILogoff($dbHandle);
      header("Location: login.php?accountCreated=true");
	}
	else if(strcmp($_POST['entity'],"bakerAndInstructor") == 0)
    {
      $newUser = "insert into Instructor values('" . $userID . "')";
	  $newUser2 = "insert into Baker values('" . $userID . "')";
      oci_free_statement(executeCommand($newUser));
	  oci_free_statement(executeCommand($newUser2));
      OCICommit($dbHandle);
      OCILogoff($dbHandle);
      header("Location: login.php?accountCreated=true");
	}
   
}
else if(isset($_POST['createUser']))
{
   echo "<br>Invalid Password Length<br>";
}

?>

  <form name="newUser" method ="post">
    <table>
      <tr>
        <td>Username: </td>
        <td><input type="text" name="username" id="username" value="" ></td>
      </tr>
      <tr>
        <td>Password: </td>
        <td><input type="password" name="password" id="username" value="" ></td>
      </tr>
      <tr>
        <td>First name: </td>
        <td><input type="text" name="firstName" id="firstName" value="" ></td>
      </tr>
      <tr>
        <td>Last name: </td>
        <td><input type="text" name="lastName" id="lastName" value="" ></td>
      </tr>
      <tr>
        <td>Address: </td>
        <td><input type="text" name="address" id="address" value="" ></td>
      </tr>
      <tr>
        <td>Phone number: </td>
        <td><input type="text" name="phoneNumber" id="phoneNumber" value="" ></td>
      </tr>
	  <tr>
		<td>Entity: </td>
		<td><select name="entity">
			<option value="baker">Baker</option>
			<option value="customer">Customer</option>
			<option value="instructor">Instructor</option>
			<option value="bakerAndInstructor">Baker and Instructor</option>
			</select>
			</td>
	  </tr>
    </table>

        <input type="submit" name="createUser" value="Create User">
  </form>


	<?php include("Footer.php"); ?>
</div>

</body>
</html> 
