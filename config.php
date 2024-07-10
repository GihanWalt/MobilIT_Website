<?php

define('DBSERVER', 'localhost');           // Database server
define('DBUSERNAME', 'root'); 	           // Database username
define('DBPASSWORD', ''); 		 		   // Database password
define('DBNAME', 'login_db_users');        // Database name

// connect to MYSQL database //
$db = mysqli_connect(DBSERVER, DBUSERNAME, DBPASSWORD, DBNAME);

// check connection db connection //
if($db === false) {
	die("Error: connection error. " . mysqli_connect_error());
}

?>