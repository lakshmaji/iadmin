<?php
	session_start(); // Starting Session

							include('../connection.php');
						$connection = new createConnection(); 			//created a new object
						$connection_ref = $connection->connectToDatabase();


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
			
			// To protect MySQL injection for Security purpose
			$username = stripslashes($username);
			$password = stripslashes($password);
			$username = mysqli_real_escape_string($connection_ref,$username);
			$password = md5(mysqli_real_escape_string($connection_ref,$password));
			// Selecting Database
			
			// SQL query to fetch information of registerd users and finds user match.
			$query = mysqli_query($connection_ref, "select * from admin_log where password='$password' AND username='$username' ")or die(mysqli_error($connection_ref));
			$rows = mysqli_num_rows($query);
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
			mysqli_close($connection); // Closing Connection
		}
	}
?>
