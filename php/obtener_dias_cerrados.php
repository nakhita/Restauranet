<?php
include("conexion.php");
include("sesion.php");

header("Content-Type: application/json; charset=UTF-8");
if(isset($_GET["id"])) {
  $id = $_GET["id"]; 
}

$dias_cerrados= array();
$con= conectar_con();

$stmt = $con->prepare("SELECT ID_CERR,fecha,inicio,fin,dia_completo FROM cerrado_res WHERE ID_RES = ?");
$stmt->bind_param("i", $id);
$stmt->execute();

$result = $stmt->get_result();
if($result->num_rows === 0) exit('{}');
$ultima_fecha = 0;
$rangos = array();
while($row = $result->fetch_object()) {
  if($ultima_fecha != $row->fecha) {
    $dia_cerrado = new stdClass;
    $dia_cerrado->fecha = $row->fecha;
    $dia_cerrado->cerrarTodoElDia = $row->dia_completo;
    $rangos = array();
    $ids = array();
    $dia_cerrado->ids = $ids;
    $dias_cerrados[] = $dia_cerrado;
  }
  $rango = new stdClass;
  $rango->desde = $row->inicio;
  $rango->hasta = $row->fin;
  $rangos[] = $rango;
  $dia_cerrado->ids[] = $row->ID_CERR;
  $dia_cerrado->rangos = $rangos;
  
  $ultima_fecha = $row->fecha;
}
echo json_encode($dias_cerrados);
$stmt->close();

?>
