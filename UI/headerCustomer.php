<!--
	filename: headerCustomer.php
	created on: October 29, 2013

	Navigation header for Staff page
-->
<?php 
$appendData = "isMember=" . $isMemberURL . "&userID=" . $userID . "&isStudent=" . $isStudentURL;
echo "<ul id='menu'>
<li><a href='customer.php?" . $appendData . "'>Make Order</a></li> 
<li><a href='classes.php?" . $appendData . "'>Bakerzin Classes</a></li>
<li><a href='account.php?" . $appendData . "'>Account Information</a></li>
<li><a href='index.php'>Logout</a></li>
</ul>";

?> 
