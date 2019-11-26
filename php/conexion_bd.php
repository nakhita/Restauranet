<?php

	$server = "remotemysql.com";
	$user = "9pI70erRPy";
	$pass = "bVw5JpXzO9";
	$db = "9pI70erRPy";
	
    $mysqli=mysqli_connect($server,$user,$pass,$db);   
	 
	 if(!$mysqli){		 
		  echo 'Error al conectarse a la BD: ' . mysqli_connect_errno().PHP_EOL;
		  exit;
	 }
	 
	 
  

?>