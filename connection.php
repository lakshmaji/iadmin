<?php

class createConnection 				//create a class for make connection
{
    var $host="localhost";
    var $username="root";    			// specify the sever details for mysql
    Var $password="";
    var $database="iadmin";

    var $myconn;

   

    function connectToDatabase() 		// create a function for connect database
    {
        $conn= mysqli_connect($this->host,$this->username,$this->password, $this->database);

        if(!$conn)// testing the connection
        {
            die ("Cannot connect to the database");
        }

        else
        {

            $this->myconn = $conn;

						//            echo "Connection established";

        }

        return $this->myconn;

    }

    function selectDatabase() 			// selecting the database.
    {
        mysqli_select_db($this->myconn, $this->database);  	//use php inbuild functions for select database

        if(mysqli_error($this->myconn)) 			// if error occured display the error message
        {

            echo "Cannot find the database ".$this->database;

        }
						//         echo "Database selected..";       
    }

    function closeConnection() 			// close the connection
    {
        mysqli_close($this->myconn);

						//        echo "Connection closed";
    }

}

?>
