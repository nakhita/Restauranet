<?php
include("../../conexion.php");

header("Content-Type: application/json; charset=UTF-8");

if(!isset($_GET["idreserva"]) || !isset($_GET["estado"]) ) {
  echo '{}';
  return;
}

$idreserva = $_GET["idreserva"];
$estado = $_GET["estado"];
$con= conectar_con();

$sql= "UPDATE reservas SET estado=? WHERE idreserva=?";

$stmt = $con->prepare($sql);
if ($stmt == false) {
  echo $con->error;
  return;
}

$stmt->bind_param("ii",$estado,$idreserva);
$ok = $stmt->execute();
if(!$ok){
  echo $con->error;
  return;
}

echo '{}';
?>