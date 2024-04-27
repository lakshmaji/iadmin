<?php
include('../session.php');
session_start();
if(isset($_GET['id']))  {
    $selected_row_id = base64_decode($_GET['id']);
    $_SESSION["current_row_id"]= $selected_row_id;
    header('Location: index.php');
} else {
    echo "Entry not found";
}
?>