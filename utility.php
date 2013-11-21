<?php

$dbHandle = OCILogon("ora_v4c8", "a23681117", "ug");
$status = True;

function executeCommand($cmd)
{
   global $dbHandle, $status;

   $parsedCmd = OCIParse($dbHandle, $cmd);

   if(!$parsedCmd)
   {
      echo "<br>Unable to process command " . $cmd . "<br>";
      $status = False;
      $error = OCI_Error($dbHandle);
      echo htmlentities($error['message']);
   }
   
   $result = OCIExecute($parsedCmd, OCI_DEFAULT);
   if(!$result)
   {
      echo "<br>Cannot execute the command " . $cmd . "<br>";
      $status = False;
      $error = OCI_Error($parsedCmd);
      echo htmlentities($error['message']);
   }
   return $parsedCmd;
}

//$columns contains the name of the columns. It must contain the same amount
//amount of elements as the number of elements in each row of $tableData
function printTable($tableData, $columns, $printCheckBox = False)
{
   echo "<table border='1'>";
   echo "<tr>";
   if($printCheckBox)
   {
      echo "<th> </th>";
   }
   foreach($columns as $column)
   {
      echo "<th>" . $column . "</th>";
   }
   echo "</tr>";
   while($row = OCI_Fetch_Array($tableData, OCI_NUM))
   {
      echo "<tr>";
      if($printCheckBox)
      {
         echo "<td><form><input type='checkbox' name='isCompleted'>
               </form></td>";
      }
      foreach($row as $rowData)
      {
         echo "<td>" . $rowData . "</td>";
      }
      echo "</tr>";
   }
   echo "</table>";
}

function runSqlScript()
{
   global $dbHandle, $status;
   $fileContents = file_get_contents('./project.sql', true);
   
   $cmd = strtok($fileContents, ';');
   //Comments removed from sql script. It only contains valid commands.
   while($cmd !== false)
   { 
      if(strlen($cmd) > 3)
      {
         executeCommand($cmd);
         OCICommit($dbHandle);
      }
      $cmd = strtok(';');
      if(!$status)
      {
         echo "<br>Error running Script<br>";
      }
   }
}

?>

