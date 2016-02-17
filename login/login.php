<?php
	session_start(); // Starting Session

							include('../connection.php');
						$connection = new createConnection(); 			//created a new object
						$connection->connectToDatabase();
						$connection->selectDatabase();


	if (isset($_POST['submit'])) 
	{
		if (empty($_POST['username']) || empty($_POST['password'])) 
		{
			//Username or Password is invalid";
			header("Location: index.php"); // Redirecting To Other Page		
		}
		else
		{
			$username=$_POST['username'];
			$password=$_POST['password'];
			// Establishing Connection with Server by passing server_name, user_id and password as a parameter
			
//$connection = mysql_connect("localhost", "root", "");
			// To protect MySQL injection for Security purpose
			$username = stripslashes($username);
			$password = stripslashes($password);
			$username = mysql_real_escape_string($username);
			$password = mysql_real_escape_string($password);
			// Selecting Database
			
//$db = mysql_select_db("db_s_vv", $connection);
			// SQL query to fetch information of registerd users and finds user match.
			$query = mysql_query("select * from admin_log where password='$password' AND username='$username' ")or die(mysql_error());
			$rows = mysql_num_rows($query);
			if ($rows == 1) 
			{
				$_SESSION['login_user']=$username; // Initializing Session
				header("Location: ../"); // Redirecting To Other Page
			} 
			else 
			{
				//Username or Password is invalid";
				header("Location: index.php"); // Redirecting To Other Page		
			}
			mysql_close($connection); // Closing Connection
		}
	}
?>