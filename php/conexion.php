<?php
    
function conectar_con(){
    
    $user="root";
    $pass="";
    $server="localhost";
    $db="restauranet";
    
    $con=mysqli_connect($server,$user,$pass,$db);
    
    if(!$con){
        echo "<h2>Error al conectar a la base de  datos </h2>";
    }
    
    return $con;
}

function desconectar_con($con){
   mysqli_close($con); 
}

?>