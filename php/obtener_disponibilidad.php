<?php
include("conexion.php");
include("sesion.php");

header("Content-Type: application/json; charset=UTF-8");
if(isset($_GET["id"])) {
  $id = $_GET["id"];
} else {
  return;
}

$disponibilidades = array();
$con = conectar_con();

$stmt = $con->prepare("SELECT dia,inicio,fin FROM horario_res WHERE ID_RES = ? order by dia");
$stmt->bind_param("i", $id);
$stmt->execute();

$result = $stmt->get_result();
if($result->num_rows === 0) exit('{}');
$ultimoDia = 0;
$idRango = 1;
$dias = array();
$horario = new stdClass;
while($row = $result->fetch_object()) {
  if($ultimoDia != $row -> dia) {
    $dia = new stdClass;
    $dia->id = $row->dia;
    $dias[] = $dia;
    $idRango = 1;
  }
  $rango = new stdClass;
  $rango->id = $idRango++;
  $rango->desde = $row->inicio;
  $rango->hasta = $row->fin;
  $dia->rangos[] = $rango;
  $ultimoDia = $dia->id;
}
$stmt->close();
$horario->dias = $dias;

$stmt = $con->prepare("SELECT horas, personas FROM promedio_reserva WHERE ID_RES = ?");
$stmt->bind_param("i", $id);
$stmt->execute();

$result = $stmt->get_result();
if($result->num_rows === 0) exit('{}');
while($row = $result->fetch_object()) {
  $horario->tiempo = $row->horas;
  $horario->mesas = $row->personas;
}
$stmt->close();
$horario->dias = $dias;

echo json_encode($horario);


?>