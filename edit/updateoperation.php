<?php
session_start();
include('../connection.php');
$connection = new createConnection(); 			//created a new object
$connection->connectToDatabase();
$connection->selectDatabase();				//selecting db


$selected_table_name=$_SESSION["tblname"];


   $age = $_GET['wrecord'];
   $sex = $_GET['wcolumn'];
   $wpm = $_GET['wvalue'];
   
   // Escape User Input to help prevent SQL Injection
   $age = mysql_real_escape_string($age);
   $sex = mysql_real_escape_string($sex);
   $wpm = mysql_real_escape_string($wpm);

$allsel="select * from ".$selected_table_name;
$res = mysql_query($allsel);
$fld_name=mysql_field_name($res, $sex);

$sql = "UPDATE ".$selected_table_name." SET ".$fld_name."='".$wpm."' WHERE id=".$age;


$a=mysql_query($sql);
?>