<?php
    
function conectar_con(){
    
    $server = "remotemysql.com";
	$user = "9iwYLOJV8a";
	$pass = "upKsma9wUY";
	$db = "9iwYLOJV8a";
    
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