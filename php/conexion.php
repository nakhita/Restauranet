<?php
    
function conectar_con(){
    
    $server = "remotemysql.com";
	$user = "9pI70erRPy";
	$pass = "bVw5JpXzO9";
	$db = "9pI70erRPy";
    
    $con=mysqli_connect($server,$user,$pass,$db);
    
    if(!$con){
      $con->error;
    }
    
    return $con;
}

function desconectar_con($con){
   mysqli_close($con); 
}

?>