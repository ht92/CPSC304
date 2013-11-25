<?php
$userID = $_GET['userID'];
$isMember = false;
$isBaker = false;
$isStudent = false;
$isInstructor = false;
$isBakerURL = $_GET['isBaker'];
$isInstructorURL = $_GET['isInstructor'];
$isMemberURL = $_GET['isMember'];
$isStudentURL = $_GET['isStudent'];

if(strcmp("true", $_GET['isMember']) == 0)
{
   $isMember = true;
}
if(strcmp("true", $_GET['isBaker']) == 0)
{
   $isBaker = true;
}
if(strcmp("true", $_GET['isInstructor']) == 0)
{
   $isInstructor = true;
}
if(strcmp("true", $_GET['isStudent']) == 0)
{
   $isStudent = true;
}
?>

