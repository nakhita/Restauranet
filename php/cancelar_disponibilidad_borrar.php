<?php 
include("conexion.php");

header("Content-Type: application/json; charset=UTF-8");
$data = json_decode($_POST["data"], false);
$con= conectar_con();

$sql= "DELETE FROM cerrado_res WHERE ID_CERR = ?";
$id=$data->id;
$stmt = $con->prepare($sql);
if ($stmt == false) {
        echo -1;
}
else{
    $stmt->bind_param("i",$id);
    $ok = $stmt->execute();
    if(!$ok){
        echo -2;
    }
    else{
       echo 'ok'; 
    }
}

?>