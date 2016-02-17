<?php

session_start();
$selected_table_name=$_GET['dummy'];
$_SESSION["tblname"]= base64_decode($selected_table_name);
header('Location:edit/');

?>