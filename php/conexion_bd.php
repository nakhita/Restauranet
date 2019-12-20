<?php

	$server = "remotemysql.com";
    $user = "9iwYLOJV8a";
	$pass = "upKsma9wUY";
	$db = "9iwYLOJV8a";
	
    $mysqli=mysqli_connect($server,$user,$pass,$db);   
	 
	 if(!$mysqli){		 
		  echo 'Error al conectarse a la BD: ' . mysqli_connect_errno().PHP_EOL;
		  exit;
	 }
	 
	 
  

?>