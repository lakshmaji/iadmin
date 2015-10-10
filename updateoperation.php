<?php
	session_start();
	include('connection.php');
	$connection = new createConnection(); 			//created a new object
	$connection->connectToDatabase();
	$connection->selectDatabase();				//selecting db
	$selected_table_name=$_SESSION["tblname"];
	$ag = $_GET['wrecord'];
	$se = $_GET['wcolumn'];
	$wpm = $_GET['wvalue'];
	// Escape User Input to help prevent SQL Injection
	$ag = mysql_real_escape_string($ag);
	$se = mysql_real_escape_string($se);
	$wpm = mysql_real_escape_string($wpm);
	$allsel="select * from ".$selected_table_name;
	$res = mysql_query($allsel);
	$fld_name=mysql_field_name($res, $se);
	$sql = "UPDATE ".$selected_table_name." SET ".$fld_name."='".$wpm."' WHERE id=".$ag;
	mysql_query($sql);
?>