<?php
session_start();
include('../connection.php');
$connection = new createConnection(); 			//created a new object
$connection_ref = $connection->connectToDatabase();
// $connection->selectDatabase();				//selecting db

$num_fields = $_SESSION['num_flds'];
$selected_table_name = $_SESSION["tblname"];
$current_row_id = $_SESSION["current_row_id"];

// Construct the UPDATE query
$str = "UPDATE ".$selected_table_name." SET ";

// Iterate over the POST data (assuming keys correspond to column names)
foreach ($_POST as $column_name => $value) {
   // Escape input to prevent SQL injection
   $value = mysqli_real_escape_string($connection_ref, $value);
   
   // Append each column and its value to the SET clause of the UPDATE query
   $str .= "$column_name = '$value', ";
}

// Remove the trailing comma and space
$str = rtrim($str, ", ");

$str .= " WHERE id = ".$current_row_id;
// Execute the UPDATE query
$re_result = mysqli_query($connection_ref, $str);

if($re_result === FALSE) {
    die(mysqli_error($connection_ref)); // TODO: better error handling
    // TODO: Use some session var to show failure notification
} else {
    // TODO: Use some session var to show success notification
    header('Location: ./');
}
?>
