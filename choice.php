<?php
session_start();
$selected_table_name=$_POST['table_to_operation']; 
$_SESSION["tblname"]=$selected_table_name; 		//store current or selected table name
$act=$_POST['act'];
switch ($act) {							//based on choice redirect to specific page 
    case "view1":
		header('Location:viewtbl.php');
        	break;
    case "create1":
		header('Location:crtetbl.php');
        	break;
    case "delete1":
		header('Location:deltbl.php');
        	break;
    case "update1":
		header('Location:updatetbl.php');
	      break;
    default:
		header('Location:index.php');	
} 

?>