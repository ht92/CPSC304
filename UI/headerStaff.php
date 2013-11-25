<!--
	filename: headerStaff.php
	created on: October 24, 2013

	Navigation header for Staff page
-->
<?php
include "userInfo.php";
$appendData = "?isBaker=" . $isBakerURL . "&isInstructor=" . $isInstructor
               . "&userID=" . $userID;
?>
<ul id="menu">
<?php
echo "<li><a href='staff.php" . $appendData . "'>Dashboard</a></li>
      <li><a href='order.php" . $appendData . "'>Order</a></li> 
      <li><a href='mySchedule.php" . $appendData . "'>My Schedule</a></li>
      <li><a href='tasks.php" . $appendData . "'>Tasks</a></li>
      <li><a href='staffAccount.php". $appendData . "'>
      View Customer Accounts</a></li>";
?>
<li><a href="index.php">Log Out</a><li>
</ul> 
