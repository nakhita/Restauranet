<?php 
include("conexion.php");

header("Content-Type: application/json; charset=UTF-8");
$id = $_GET["id"];
$con= conectar_con();
$sql= "DELETE FROM direccion WHERE ID_DIR = ?";

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

$sql= "DELETE FROM restaurante WHERE ID_RES = ?";
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
die(header("Location: ../Lista_Sucursales.html"));
?>