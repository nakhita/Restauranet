<?php 
include("conexion.php");

header("Content-Type: application/json; charset=UTF-8");
$id = $_GET["id"];
$con= conectar_con();
$sql= "DELETE FROM cerrado_res WHERE ID_RES = ?";

$stmt = $con->prepare($sql);
if ($stmt == false) {
  echo $con->error;
  return;
}
$stmt->bind_param("i",$id);
$ok = $stmt->execute();
if(!$ok){
  echo $con -> error;
  return;
}
$stmt->close();

$sql= "DELETE FROM promedio_reserva WHERE ID_RES = ?";

$stmt = $con->prepare($sql);
if ($stmt == false) {
  echo $con->error;
  return;
}
$stmt->bind_param("i",$id);
$ok = $stmt->execute();
if(!$ok){
  echo $con -> error;
  return;
}
$stmt->close();

$sql= "DELETE FROM horario_res WHERE ID_RES = ?";

$stmt = $con->prepare($sql);
if ($stmt == false) {
  echo $con->error;
  return;
}
$stmt->bind_param("i",$id);
$ok = $stmt->execute();
if(!$ok){
  echo $con -> error;
  return;
}
$stmt->close();

$sql= "DELETE FROM calificaciones WHERE idreserva IN (SELECT idreserva FROM reservas WHERE ID_RES = ?)";

$stmt = $con->prepare($sql);
if ($stmt == false) {
  echo $con->error;
  return;
}
$stmt->bind_param("i",$id);
$ok = $stmt->execute();
if(!$ok){
  echo $con -> error;
  return;
}
$stmt->close();


$sql= "DELETE FROM reservas WHERE ID_RES = ?";

$stmt = $con->prepare($sql);
if ($stmt == false) {
  echo $con->error;
  return;
}
$stmt->bind_param("i",$id);
$ok = $stmt->execute();
if(!$ok){
  echo $con -> error;
  return;
}
$stmt->close();

$sql= "DELETE FROM direccion WHERE ID_DIR = ?";

$stmt = $con->prepare($sql);
if ($stmt == false) {
  echo $con->error;
  return;
}
$stmt->bind_param("i",$id);
$ok = $stmt->execute();
if(!$ok){
  echo $con -> error;
  return;
}
$stmt->close();

$sql= "DELETE FROM restaurante WHERE ID_RES = ?";
$stmt = $con->prepare($sql);
if ($stmt == false) {
  echo $con -> error;
  return;
}
$stmt->bind_param("i",$id);
$ok = $stmt->execute();
if(!$ok){
  echo $con -> error;
  return;
}
$stmt->close();

die(header("Location: ../Lista_Sucursales.html"));
?>