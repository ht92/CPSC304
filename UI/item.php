<!DOCTYPE html>
<html>
<head>
<title>Bakerzin-staff</title>
<link href="Site.css" rel="stylesheet">
</head>

<body>
<?php include("headerStaff.php"); ?>
	<div id="main">
	<?php include("headerLogo.php"); 
         include "utility.php";
	 echo "<form method='post' name='item' 
               action='item.php" .  $appendData . "'>";
        $checkedItems;
        if(isset($_POST['isChecked']) && isset($_POST['remove']))
        {
           $checkedItems = $_POST['isChecked'];
           foreach($checkedItems as $item)
           {
              $query = "delete from item where itemID ='" . $item . "'";
              oci_free_statement(executeCommand($query));
              if(!$status)
              {
                 echo "<br>Unable to delete item ". $item . "<br>";
                 break;
              }
           } 
           if($status)
           {
              OCICommit($dbHandle);
           }
           
        }
        else if(isset($_POST['edit']))
        {
            if(isset($_POST['isChecked']))
            {
               $itemID = $_POST['isChecked'];
               header("Location: item2.php" . $appendData . "&itemID=" . 
                       $itemID[0]);
            }
            else
            {
               echo "<br>You must select an item if you wish to edit<br>";
            } 
        }
        $status = true; 
        $itemQuery = "select itemID, itemName, itemType, price from item";
        $columns = array("Item ID", "Item Name", "Item Type", "Item Price");
        
	$result = executeCommand($itemQuery);
        if($status)
        {
           printTable($result, $columns, true);
        }
        else
        {
           echo "<br>Unable to retrieve Item information<br>";
        }
        ?>
	<input type="submit" name="remove" value="Delete">
        <input type='submit' name='edit' value='Edit'>
	</form>
	
         <?php
         echo "<form name='itemAdd' method='post' action='addItem.php" . 
              $appendData . "'><input type='submit' value='Add'></form>";
	

	  include("Footer.php"); 
          OCILogoff($dbHandle); ?>
	</div>
	
</body>
</html>
