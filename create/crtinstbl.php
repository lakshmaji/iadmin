<?php

session_start();
include('../connection.php');
$connection = new createConnection(); 			//created a new object
$connection_ref = $connection->connectToDatabase();

$num_fields=$_SESSION['num_flds'];
$selected_table_name=$_SESSION["tblname"];



$str="INSERT INTO ".$selected_table_name." VALUES(null";


for($y=1;$y<$num_fields;$y++)
{
	$str=$str.",'$_POST[$y]'";

}
$str=$str.");";

$re_result = mysqli_query ($connection_ref, $str); //run the query
echo "<script>
		var r = confirm('ADDED NEW ENTRY SUCCESSFULLY!Do You Want To Add One More?');
    		if (r == true) 
		{
			window.location.assign('index.php');    
		} 
		else 
		{
        		window.location.assign('../edit');
	    	}
	</script>";
?>
