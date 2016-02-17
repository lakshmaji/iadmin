<?php
session_start();// Starting Session

if(!isset($_SESSION['login_user']))
{
	header("location:login/index.php");
}
?>